<template>
  <div>
    <vs-table v-model="selected" :data="data" stripe multiple>
      <template slot="header">
        <vs-row class="badaso-server-side-table__header">
          <vs-col vs-lg="6" vs-md="6" vs-sm="6" vs-xs="12"  v-if="label!=''">
          <div class="badaso-table__header-dropdown">
            <h3><b>{{label}}</b></h3>
          </div>
        </vs-col>
          <vs-col vs-lg="6" vs-md="6" vs-sm="6" vs-xs="12">
            <div class="badaso-server-side-table__header-search">
              <input
                type="text"
                class="badaso-server-side-table__input-search"
                v-on:keyup.enter="handleSearch"
              />
              <vs-icon icon="search"></vs-icon>
            </div>
          </vs-col>
        </vs-row>
      </template>
      <template slot="thead"><slot name="thead" /></template>
      <slot name="tbody" />
    </vs-table>
    <div class="badaso-server-side-table__pagination">
      <vs-row
        class="badaso-server-side-table__pagination-container"
        vs-justify="space-between"
        vs-type="flex"
        vs-w="12"
      >
        <vs-col
          class="badaso-server-side-table__pagination-item"
          vs-type="flex"
          vs-justify="flex-start"
          vs-align="center"
          vs-lg="6"
          vs-md="12"
          vs-sm="12"
          vs-xs="12"
        >
          <span class="vs-pagination-desc">
            {{ descriptionTitle }}: {{ paginationData.from }} -
            {{ paginationData.to }} {{ descriptionConnector }}
            {{ paginationData.total }}
          </span>
        </vs-col>
        <vs-col
          class="badaso-server-side-table__pagination-item"
          vs-type="flex"
          vs-justify="flex-end"
          vs-align="center"
          vs-lg="6"
          vs-md="12"
          vs-sm="12"
          vs-xs="12"
        >
          <vs-pagination :total="totalItem" v-model="page"></vs-pagination>
        </vs-col>
      </vs-row>
    </div>
  </div>
</template>

<script>
export default {
  name: "BadasoWidgetTableServe",
  props: {
    paginationData: {},
    data: {
      type: Array,
      // eslint-disable-next-line vue/require-valid-default-prop
      default: [],
    },
    description: {
      default: true,
      type: Boolean,
    },
    descriptionItems: {
      default: () => [10, 50, 100, 200],
      type: Array,
    },
    descriptionTitle: {
      default: "Registries",
      type: String,
    },
    label: {
      default: "",
      type: String,
    },
    descriptionConnector: {
      default: "of",
      type: String,
    },
    descriptionBody: {
      type: String,
    },
  },
  data: () => ({
    selected: [],
    limit: 10,
    page: 1,
    currentSortKey: null,
    currentSortType: null,
  }),
  computed: {
    totalItem() {
      return this.paginationData.total > 0
        ? Math.ceil(this.paginationData.total / this.limit)
        : 1;
    },
  },
  watch: {
    page: function (to, from) {
      this.$emit("changePage", to);
    },
    limit: function (to, from) {
      this.$emit("changeLimit", to);
    },
    selected: function (to, from) {
      this.$emit("select", to);
    },
  },
  mounted() {},
  destroyed() {},
  methods: {
    handleSearch(e) {
      this.$emit("search", e);
    },
    handleSort(key, sortType) {
      this.currentSortKey = key;
      this.currentSortType = sortType;
      this.$emit("sort", key, sortType);
    },
  },
};
</script>
