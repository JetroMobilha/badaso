<template>
  <vs-col :vs-lg="size" vs-xs="12" class="badaso-select-multiple__container">
    <label class="typo__label">{{ label }}</label>
    <multiselect 
      v-model="value" 
      :options="options"  
      :placeholder="placeholder" 
      :label="coluna" 
      track-by="id"
      @select="compoGerarSelecionado"
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
  data: () => ({}),
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
    value: {
      type: Array,
      default: () => {
        return [];
      },
    },
    items: {
      type: Array,
      required: true,
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
      default: "nome",
    },
    tipo: {
      type: String,
      default:null,
    },
    slug: {
      type: String,
      default:"",
    },
  },
  methods: {
    satinize(item) {
      return item;
    },
    handleInput(val) {
      this.$emit("input", val);
    },
    compoGerarSelecionado(selectedOption, id){
      this.handleInput(selectedOption[this.coluna]);
    },
    async getRelation(searchQuery) {
      try {
        
        this.isLoading = true;
        const response = await this.$api.badasoEntity.relation({
          slug: this.slug,
          query:searchQuery,
          tipo:this.tipo,
          coluna:this.coluna
        });
        
        this.options = response.data;
        this.isLoading = false;
      } catch (error) {
        this.isLoading = false;
      }
    },
  },
};
</script>
