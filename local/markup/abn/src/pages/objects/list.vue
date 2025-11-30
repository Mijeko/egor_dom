<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import type BuildObjectDto from "@/dto/entity/BuildObjectDto.ts";
import CatalogFilter from "@/components/filter/catalog-filter.vue";
import Pagination from "@/components/site/pagination.vue";
import type ApartmentDto from "@/dto/entity/ApartmentDto.ts";

export default defineComponent({
  name: "list",
  components: {Pagination, CatalogFilter},
  props: {
    buildObjects: {
      type: Array as PropType<BuildObjectDto[]>
    }
  },
  computed: {
    apartmentList(): ApartmentDto[] {


      let res: ApartmentDto[] = [];

      this.buildObjects?.forEach((objectDto: BuildObjectDto, index, array) => {
        if (objectDto.apartments) {
          res.push(...objectDto.apartments);
        }
      });

      return res;
    }
  }
})
</script>

<template>


  <section class="catalog-page">
    <div class="catalog-page-header">
      <h1 class="page-title h1">Каталог недвижимости</h1>
    </div>
    <div class="catalog-page-body">

      <CatalogFilter/>

      <div class="catalog-container container">
        <div class="catalog">
          <BuildObjectItem
            v-for="obj in buildObjects"
            :buildObject="obj"
          />

        </div>

        <Pagination/>

        <div class="map-objects container">
          <Map
            :apartmentList="apartmentList"
          />
        </div>
      </div>
    </div>


  </section>

</template>

<style lang="scss">
@use '@/styles/system/variable' as *;

.map-objects {
  width: 100%;
  height: 500px;
  overflow: hidden;
  border-radius: 20px;
  margin-top: 60px !important;
}

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
