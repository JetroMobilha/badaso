<template>
  <vs-col :vs-lg="size" vs-xs="12" class="badaso-select-multiple__container">
    <label class="typo__label">{{ label }}</label>
    <multiselect 
      v-model="val" 
      :options="options"  
      :placeholder="placeholder" 
      label="label" 
      :multiple='multiple'
      track-by="value"
      @select="compoGerarSelecionado"
      @remove="compoGerarSelecionado"
      @search-change="getRelation"
      :searchable="true" 
      :loading="isLoading" 
      :internal-search="false" 
    >
    </multiselect>
    <div v-if="additionalInfo" v-html="additionalInfo"></div>
    <div v-if="alert">
      <div v-if="$helper.isArray(alert)">
        <span
          class="badaso-select-multiple__input--error"
          v-for="(info, index) in alert"
          :key="index"
        >
          {{ info }}
        </span>
      </div>
      <div v-else>
        <span
          class="badaso-select-multiple__input--error"
          v-html="alert"
        ></span>
      </div>
    </div>
  </vs-col>
</template>

<script>

export default {
  name: "BadasotMultipleSelect",
  components: {},
  data: () => ({
    val:'',
    options:[],
    isLoading:false,
  }),
  props: {
    size: {
      type: String,
      default: "12",
    },
    label: {
      type: String,
      default: "",
    },
    placeholder: {
      type: String,
      default: "Multiple Select",
    },
    additionalInfo: {
      type: String,
      default: "",
    },
    alert: {
      type: String || Array,
      default: "",
    },
    coluna: {
      type: String,
      required: true,
      default: "nome",
    },
    slug: {
      type: String,
      default:"",
    },
    tableDestino: {
      type: String,
      default:"",
    },
    value: {
      type: String|Number|Array,
      default:"",
    },
    multiple: {
      type: Boolean,
      default:false,
    },
  },
  mounted() {
    this.val=this.value;
    this.getRelation();
  },
  methods: {
     
    handleInput(val) {

      var retornArray=[];
      if (this.multiple) {
        this.val.forEach(element => {
          retornArray.push(element['value']);
        });
        this.$emit("input", retornArray);
      } else {
        
        this.$emit("input", this.val.value);
      }
    },
    compoGerarSelecionado(selectedOption, id){
      this.handleInput(selectedOption[this.coluna]);
    },
    async getRelation(searchQuery) {
      try {
        if(searchQuery==undefined ||searchQuery==null)searchQuery=" "
        this.isLoading = true;
        const response = await this.$api.badasoEntity.relationSlug({
          slug: this.slug,
          query:searchQuery,
          coluna:this.coluna,
          table:this.tableDestino,
        });
        
        this.options = response.data;
        this.isLoading = false;
         
        if (searchQuery==" " && !this.multiple) {
          for (const valu of this.options) {
            if (valu.id==this.value) {
              this.val= valu;
            }
          }
        }

        if (searchQuery==" " && this.multiple) {
          var retornArray=[];
          for (const valu of this.options) {
            for (const valu2 of this.value) {
              if(valu2 ==valu.id)
              retornArray.push(valu);
            }
          }
          this.val =retornArray;
        }
         
      } catch (error) {
        this.isLoading = false;
      }
    },
  },
};
</script>
