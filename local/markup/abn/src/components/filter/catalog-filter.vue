<script lang="ts">
import {defineComponent} from 'vue'
import ListWithSearch from "@/components/filter/part/list-with-search.vue";
import FilterCheckbox from "@/components/filter/part/filter-checkbox.vue";

export default defineComponent({
  name: "CatalogFilter",
  components: {FilterCheckbox, ListWithSearch},
  data: () => {
    return {
      form: {
        city: [],
      }
    };
  }
})
</script>

<template>


  <aside class="catalog-filter">
    <ListWithSearch
      label="Город"
    >

      <FilterCheckbox
        v-model="form.city"
        :values="[
  {
    value:1,
    label:'Барнаул',
  },
  {
    value:2,
    label:'Новосибирск',
  },
  {
    value:3,
    label:'Красноярск',
  },
]"
      />

    </ListWithSearch>


    <ListWithSearch
      label="Застройщик"
    />


    <ListWithSearch
      label="Отделка"
    />
  </aside>


</template>

<style lang="scss">

@use '@/styles/system/variable' as *;

.catalog-filter {
  max-width: 250px;
  width: 100%;
  background: $filter-bg;
  border-radius: 15px;
  padding: 20px 20px 35px 20px;
}
</style>
