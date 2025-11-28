<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import type BuildObjectDto from "@/dto/entity/BuildObjectDto.ts";
import CatalogFilter from "@/components/filter/catalog-filter.vue";

export default defineComponent({
  name: "list",
  components: {CatalogFilter},
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

      <div class="catalog container">

        <BuildObjectItem
          v-for="obj in buildObjects"
          :buildObject="obj"
        />

      </div>
    </section>
  </section>

</template>

<style lang="scss">
@use '@/styles/system/variable' as *;

.catalog-page {
  &-body {
    display: flex;
    align-items: flex-start;
    justify-content: center;
    gap: 30px;
    margin-top: 40px;
  }
}

.catalog {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  gap: 30px;

  // @over
  margin: 0 !important;

  .build-object-card {
    max-width: calc(33% - 20px);
    width: 100%;
  }
}

</style>
