<template>
  <vs-row>   
    <vs-col vs-lg="12">
      <vs-card :style=" $constants.DESKTOP ==viewType?{ height:'380px'}:{ height:'445px'}">
        <badaso-widget-table
            v-model="selected"
            pagination
            :max-items="descriptionItems[0]"
            search
            :data="records"
            :label="label"
            stripe
            description
            :description-items="descriptionItems"
            :description-title="$t('crudGenerated.footer.descriptionTitle')"
            :description-connector="$t('crudGenerated.footer.descriptionConnector')"
            :description-body="$t('crudGenerated.footer.descriptionBody')"
            >
            <template slot="thead">
              <vs-th
                v-for="(dataRow, index) in getRowBrowse(dataType.dataRows)"
                :key="index"
                :sort-key="$caseConvert.stringSnakeToCamel(dataRow.field)"
              >
                <template v-if="dataRow.browse == 1">
                  {{ dataRow.displayName }}
                </template>
              </vs-th>
            </template>

            <template slot-scope="{ data }">
              <vs-tr
                :data="record"
                :key="index"
                v-for="(record, index) in data"
              >
                <template >
                  <vs-td :style="{ padding:'7px'}"
                    v-for="(dataRow, indexColumn) in getRowBrowse(dataType.dataRows)"
                    :key="indexColumn"
                    :data="data[index][$caseConvert.stringSnakeToCamel(dataRow.field)]"
                  >
                    <template>
                      <p @click="readItem(data[index].id)"
                        v-if="dataRow.type == 'radio' || dataRow.type == 'select'"
                      >
                        {{ bindSelection(dataRow.details.items,record[$caseConvert.stringSnakeToCamel(dataRow.field)])}}
                      </p>
                      <div @click="readItem(data[index].id)"
                        v-else-if="dataRow.type == 'select_multiple' || dataRow.type == 'checkbox'"
                        class="crud-generated__item--select-multiple"
                      >
                        <p
                          v-for="(selected,indexSelected) in stringToArray(record[$caseConvert.stringSnakeToCamel(dataRow.field)])"
                          :key="indexSelected"
                        >
                          {{ bindSelection(dataRow.details.items, selected) }}
                        </p>
                      </div>
                      <span v-else-if="dataRow.type == 'relation'" @click="readItem(data[index].id)">
                        
                        {{truncarTexto(displayRelationData(record, dataRow),20)}} 
                      </span>
                      <span @click="readItem(data[index].id)" v-else>{{truncarTexto(removeTags(record[$caseConvert.stringSnakeToCamel(dataRow.field)]),20)}}</span>
                    </template>
                  </vs-td>
                </template>
              </vs-tr>
            </template>
        </badaso-widget-table>
      </vs-card>
    </vs-col>
  </vs-row>
</template>

<script>
import * as _ from "lodash";
export default {
  components: {},
  name: "BadasoTableDashBoard",
  props: {
    nome:'',
    label:'',
    icon:'',
    type:'',
    table:'',
  },
  data: () => ({
    errors: {},
    data: {},
    descriptionItems: [6],
    selected: [],
    records: [],
    dataType: [],
    willDeleteId: null,
    isCanAdd: false,
    isCanEdit: false,
    isCanRead: false,
    isCanSort: false,
    totalItem: 0,
    filter: "",
    page: 1,
    limit: 10,
    orderField: "",
    orderDirection: "",
    rowPerPage: null,
    fieldsForExcel: {},
    fieldsForPdf: [],
    idsOfflineDeleteRecord: [],
    maintenanceDialog: false,
    isMaintenance: false,
    showMaintenancePage: false,
    isShowDataRecycle: false,
    widgettable:'',
    windowWidth: window.innerWidth,
    viewType: "",
    activeLoading:false,
    types:[
      'default',
      'point',
      'radius',
      'corners',
      'border',
      'sound',
      'material',
    ],
  }),
  watch: {
    $route: function (to, from) {
      this.getEntity();
    },
  },
  mounted() {
    if (this.$route.query.search || this.$route.query.page) {
      this.filter = this.$route.query.search;
      this.page = this.$route.query.page;
      this.show = this.$route.query.show;
    }
    this.getEntity();
    this.$nextTick(() => {
      window.addEventListener("resize", this.handleWindowResize);
    });

    this.setViewType();
    this.types.forEach((type)=>{
      console.log(type)
      this.$vs.loading({
        container: `#loading-${type}`,
        type,
        text:type
      })
    })
  },
  beforeDestroy() {
    window.removeEventListener("resize", this.handleWindowResize);
  },
  methods: {
    truncarTexto(texto, limite) {
      if (texto.length > limite) {
        return texto.substring(0, limite) + '...';
      } else {
        return texto;
      }
    },
    removeTags(html) {
      return html.replace(/<[^>]*>/g, '');
    },
    openLoading(type){
      this.activeLoading = true
      this.$vs.loading({
        type:type,
      })
      setTimeout( ()=> {
        this.activeLoading = false
        this.$vs.loading.close()
      }, 3000);
    },
    handleWindowResize(event) {
      //window.innerWidth
      this.windowWidth = event.currentTarget.innerWidth;
      this.setViewType();
    },
    setViewType() {
      if (this.windowWidth < 768) {
        this.viewType = this.$constants.MOBILE;
      } else {
        this.viewType = this.$constants.DESKTOP;
      }
    },
    async getEntity() {
      this.$openLoader();
      try {
        const response = await this.$api.badasoDashboard.table({
          nome: this.nome,
        });
        const {
          data: { dataType },
        } = await this.$api.badasoTable.getDataType({
          slug: this.table,
        });
        this.$closeLoader();
        this.data = response.data;
        this.records = response.data.data;
        this.totalItem =
          response.data.total > 0
            ? Math.ceil(response.data.total / this.limit)
            : 1;
        this.dataType = dataType;
        const dataRows = this.dataType.dataRows.map((data) => {
          try {
            data.details = JSON.parse(data.details);
          } catch (error) {}
          return data;
        });
        this.dataType.dataRows = JSON.parse(JSON.stringify(dataRows));
        const addFields = dataRows.filter((row) => row.add);
        const editFields = dataRows.filter((row) => row.edit);
        const readFields = dataRows.filter((row) => row.read);
        this.isCanAdd = addFields.length > 0;
        this.isCanEdit = editFields.length > 0;
        this.isCanRead = readFields.length > 0;
        if (this.dataType.orderColumn && this.dataType.orderDisplayColumn) {
          this.isCanSort = true;
        }
      } catch (error) {
        this.$closeLoader();
        this.$vs.notify({
          title: this.$t("alert.danger"),
          text: error.message,
          color: "danger",
        });
      }
    },
    getRowBrowse(dataRows) {
      if(dataRows!=undefined){
        return dataRows.filter(data => data.browse == 1);
      }else{
        return [];
      }
    },
    bindSelection(items, value) {
      const selected = _.find(items, ["value", value]);
      if (selected) {
        return selected.label;
      } else {
        return value;
      }
    },
    stringToArray(str) {
      if (str) {
        return str.split(",");
      } else {
        return [];
      }
    },
    handleSearch(e) {
      this.filter = e.target.value;
      this.page = 1;
      this.$router.replace({ 
        query: { 
          search: this.filter,
          page: this.page,
          show: this.limit
        } 
      })
      .catch(err=>{
        console.log(err);
      });
      this.getEntity();
    },
    handleChangePage(page) {
      this.page = page;
      this.$router.replace({
        query: {
          search: this.filter,
          page: this.page,
          show: this.limit
        }
      })
      .catch(err => { 
        console.log(err);
       });;
      this.getEntity();
    },
    handleChangeLimit(limit) {
      this.page = 1;
      this.limit = limit;
      this.$router.replace({
        query: {
          search: this.filter,
          page: this.page,
          show: this.limit
        }
      })
      .catch(err => { 
        console.log(err);
      });
      this.getEntity();
    },
    handleSort(field, direction) {
      this.orderField = field;
      this.orderDirection = direction;
      this.getEntity();
    },
    handleSelect(data) {
      this.selected = data;
    },
    displayRelationData(record, dataRow) {
      if (dataRow.relation) {
        const relationType = dataRow.relation.relationType;
        const table = this.$caseConvert.stringSnakeToCamel(
          dataRow.relation.destinationTable
        );

        this.$caseConvert.stringSnakeToCamel(
          dataRow.relation.destinationTableColumn
        );

        const displayColumn = this.$caseConvert.stringSnakeToCamel(
          dataRow.relation.destinationTableDisplayColumn
        );
        if (relationType == "has_many") {
          const list = record[table];
          const flatList = list.map((ls) => {
            return ls[displayColumn];
          });
          return flatList.join(", ");
        }else if(relationType == "belongs_to"){
          const list = record[table];
          let field = this.$caseConvert.stringSnakeToCamel(dataRow.field)
          const flatList = list.map((ls) => {
            if(ls.id == record[field]){
              return ls[displayColumn];
            }
            return null
          });
          return flatList.join(",").replace(",", "");
        }  else if (relationType == "belongs_to_many") {
          let field = this.$caseConvert.stringSnakeToCamel(dataRow.field)
          const lists = record[field]
          let flatList = []
          Object.keys(lists).forEach(function (ls, key) {
            flatList.push(lists[ls][displayColumn]);
          });
          return flatList.join(",").replace(",", ", ");
        } 
      } else {
        return null;
      }
    },
    readItem(mId) {
      this.$router.push({
        name:'CrudGeneratedRead',
        params:{
          id: mId,
          slug: this.table,
        },
      });
    },
  },
};
</script>

<style scoped>
  .vs-con-table table {
    font-size: .75rem;
    width: 100%;
    border-collapse: collapse;
}

th {
    padding: 0px 0px; 
    padding-top: 0px;
    padding-bottom: 0px;
    border: 0;
    text-align: left;
    font-size: .75rem;
}

th :deep(.sort-th), th :deep(.vs-table-text)  {
    padding: 3px;
    white-space: nowrap; /* impede a quebra de linha */
    overflow: hidden; /* oculta o texto que passa da largura do elemento */
    text-overflow: ellipsis; /* adiciona reticências (...) ao final do texto oculto */
}

.vs-table--tbody-table .tr-values td {
     padding: 2px;
}

.vs-table--tbody-table .tr-values td span {
  white-space: nowrap; /* impede a quebra de linha */
  overflow: hidden; /* oculta o texto que passa da largura do elemento */
  text-overflow: ellipsis; /* adiciona reticências (...) ao final do texto oculto */
}
</style>
