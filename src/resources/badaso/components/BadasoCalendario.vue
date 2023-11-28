<template>
  <vs-row>   
    <vs-col vs-lg="12" >
      <vs-card >
        <vue-cal
          :style="{ height:'375px'}"
          locale="pt-br"
          :time="false" 
          hide-view-selector
          active-view="month"
          class="vuecal--blue-theme"
          events-count-on-year-view
          :disable-views="['week']"
          :events="events"
          :split-days="splitDays"
          :sticky-split-labels="stickySplitLabels"
          :min-split-width="minSplitWidth"
          :on-event-dblclick="onEventClick"
        >
        </vue-cal>
        <div slot="footer">
         
        <vs-row vs-justify="flex-end">
          <vs-button color="success" icon="add" 
          :to="{
                name:'CrudGeneratedAdd',
                params:{
                  slug: table,
                },
              }"></vs-button>
          <vs-button color="primary" icon="aspect_ratio" @click="popupActivoExpande=true"></vs-button>
          <vs-popup fullscreen title="Calendário" :active.sync="popupActivoExpande" :style="{ MarginTop:'150px'}">
            <vs-row>   
              <vs-col vs-lg="2" >
                <vue-cal
                  xsmall
                  :time="false"
                  hide-view-selector
                  events-count-on-year-view
                  active-view="month"
                  locale="pt-br"
                  :disable-views="['week', 'day']"
                  @cell-focus="selectedDate = $event"
                  class="vuecal--blue-theme vuecal--rounded-theme"
                  style="max-height: 400px"
                  :events="events">
                </vue-cal>
              </vs-col>

              <vs-col vs-lg="10" >
                <vue-cal
                  hide-view-selector
                  active-view="week"
                  locale="pt-br"
                  events-on-month-view = "short" 
                  :disable-views="['years', 'year', 'month']"
                  :selected-date="selectedDate"
                  class="vuecal--blue-theme"
                  :events="events"
                  :split-days="splitDays"
                  :sticky-split-labels="stickySplitLabels"
                  :min-split-width="minSplitWidth"
                  :on-event-dblclick="onEventClick"
                >
                </vue-cal>
              </vs-col>

            </vs-row>
          </vs-popup>
        </vs-row>
      </div>
      </vs-card>
    </vs-col>
  </vs-row>
</template>

<script>
import * as _ from "lodash";

export default {
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
    popupActivoExpande:false,
    events:[],
    stickySplitLabels: true,
    minSplitWidth: 0,
    splitDays: [],
    selectedDate: null,
  }),
  watch: {
    
  },
  mounted() {
    this.getEntity();
  },
  methods: {
    async getEntity() {
      this.$openLoader();
      try {
        const response = await this.$api.badasoDashboard.table({ nome: this.nome,});
  
        this.$closeLoader();
        this.data = response.data;
        this.events = response.data.data;
        this.splitDays = response.data.splits;
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
    onEventClick (event,e) {
     
      var mId ;
      var mTable;
       
      if(event.model!=null||event.model!=''|| event.model!=undefined){
        mId= event.model.split("/")[1];
        mTable= event.model.split("/")[0];
      }else{
        mId= event.id;
        mTable= this.table;
      }

      this.$router.push({
        name: "CrudGeneratedRead",
        params: {
          id: mId,
          slug: mTable,
        },
      });

      // Prevent navigating to narrower view (default vue-cal behavior).
      e.stopPropagation()
    },
  },
};
</script>

<style >

   
  /* You can easily set a different style for each split of your days. */
  
  .vuecal__cell-split.cla1 {
    background-color: rgba(255, 255, 255, 0.5);
  }
  .vuecal__cell-split.cla2 {
    background-color: rgba(221, 238, 255, 0.5);
  }
  .vuecal__cell-split.split-label {
    color: rgba(0, 0, 0, 0.1);
    font-size: 26px;
  }

  /* Different color for different event types. */
  .vuecal__event.leisure {
    background-color: rgba(253, 156, 66, 0.9);
    border: 1px solid rgb(233, 136, 46);
    color: #fff;
  }
  .vuecal__event.health {
    background-color: rgba(164, 230, 210, 0.9);
    border: 1px solid rgb(144, 210, 190);
    color: #fff;
  }
  .vuecal__event.sport {
    background-color: rgba(255, 102, 102, 0.9);
    border: 1px solid rgb(235, 82, 82);
    color: #fff;
  }
  
</style>
 
