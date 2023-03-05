<template>
  <vs-row>   
    <vs-col vs-lg="12" >
      <vs-card >
        <vue-cal
          :style="{ height:'375px'}"
          locale="pt-br"
          active-view="month"
          class="vuecal--blue-theme"
        >
        </vue-cal>
      </vs-card>
      <div slot="footer">
        <vs-row vs-justify="flex-end">
          <vs-button type="gradient" color="danger" icon="favorite"></vs-button>
          <vs-button color="primary" icon="turned_in_not"></vs-button>
          <vs-button color="rgb(230,230,230)" color-text="rgb(50,50,50)" icon="settings"></vs-button>
        </vs-row>
      </div>
    </vs-col>
  </vs-row>
</template>

<script>
import * as _ from "lodash";
import downloadExcel from "vue-json-excel";
import jsPDF from "jspdf";
import "jspdf-autotable";
export default {
  components: { downloadExcel },
  name: "BadasoCalendario",
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
  }),
  watch: {
    
  },
  mounted() {
    //this.getEntity();
  },
  methods: {
    async getEntity() {
      this.$openLoader();
      try {
        const response = await this.$api.badasoDashboard.table({
          nome: this.nome,
        });
        const {
          data: { dataType },
        } = await this.$api.badasoTable.getDataType({
          slug: this.nome,
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
        this.prepareExcelExporter();
      } catch (error) {
        if (error.status == 503) {
          this.showMaintenancePage = true;
        }
        this.$closeLoader();
        this.$vs.notify({
          title: this.$t("alert.danger"),
          text: error.message,
          color: "danger",
        });
      }
    }, 
  },
  computed: {
    isOnline: {
      get() {
        const isOnline = this.$store.getters["badaso/getGlobalState"].isOnline;
        return isOnline;
      },
    },
  },
};
</script>
 
