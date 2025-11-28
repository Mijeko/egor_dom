<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import type BuildObjectDto from "@/dto/entity/BuildObjectDto.ts";
import CatalogFilter from "@/components/filter/catalog-filter.vue";
import Pagination from "@/components/site/pagination.vue";

export default defineComponent({
  name: "list",
  components: {Pagination, CatalogFilter},
  props: {
    buildObjects: {
      type: Array as PropType<BuildObjectDto[]>
    }
  },
})
</script>

<template>


  <section class="catalog-page">
    <section class="catalog-page-header">
      <h1 class="page-title h1">Каталог недвижимости</h1>
    </section>
    <section class="catalog-page-body">

      <CatalogFilter/>

      <div class="catalog-container container">
        <div class="catalog">
          <BuildObjectItem
            v-for="obj in buildObjects"
            :buildObject="obj"
          />

        </div>

        <Pagination/>
      </div>
    </section>
  </section>

</template>

<style lang="scss">
@use '@/styles/system/variable' as *;

.catalog-page {
  margin-bottom: 60px;

  &-body {
    display: flex;
    align-items: flex-start;
    justify-content: center;
    gap: 30px;
    margin-top: 40px;
  }
}

.catalog {
  width: 100%;
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  gap: 30px;
  margin-bottom: 30px;


  &-container {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    justify-content: flex-start;
    // @over
    margin: 0 !important;
  }

  .build-object-card {
    max-width: calc(33% - 20px);
    width: 100%;
  }
}

</style>
