<script lang="ts">
import {defineComponent, type PropType} from 'vue'

import MainApartmentFilter from "@/components/filter/MainApartmentFilter.vue";
import type ApartmentDto from "@/dto/entity/ApartmentDto.ts";
import type BuildObjectDto from "@/dto/entity/BuildObjectDto.ts";
import type {ApartmentFilterData} from "@/dto/ApartmentFilterData.ts";
import ApartmentFilterService from "@/service/ApartmentFilterService.ts";
import type ApartmentFilterDataResponseDto from "@/dto/response/ApartmentFilterDataResponseDto.ts";

export default defineComponent({
  name: "BuildObjectList",
  components: {MainApartmentFilter},
  data: function () {
    return {
      filterApartmentList: [] as ApartmentDto[],
      filterData: {} as ApartmentFilterData
    };
  },
  props: {
    buildObjects: {
      type: Array as PropType<BuildObjectDto[]>
    }
  },
  beforeCreate(): any {
    ApartmentFilterService.filterData()
      .then((response: ApartmentFilterDataResponseDto) => {
        let {data} = response;
        let {filter} = data;
        this.filterData.propertyList = filter.props;
      });
  },
  mounted(): any {
    console.log(this.buildObjects);
  }
})
</script>

<template>

  <MainApartmentFilter
    v-model="filterApartmentList"
    :filter-data="filterData"
  />

  <v-row>
    <v-col cols="12" sm="6" md="4" lg="3" v-for="buildObject in buildObjects" class="mb-5">
      <v-card>

        <v-carousel :show-arrows="false" :hide-delimiters="true" :touch="true">
          <v-carousel-item
            v-for="(item,i) in buildObject.gallery"
            :key="i"
            :src="item.src"
            cover
          ></v-carousel-item>
        </v-carousel>

        <div class="pa-3">

          <v-card-title>{{ buildObject.name }}</v-card-title>
          <v-card-subtitle>Квартир: {{ buildObject?.countApartments }}</v-card-subtitle>

          <v-btn class="mt-5" :href="buildObject.detailLink">Посмотреть</v-btn>
        </div>

      </v-card>
    </v-col>

  </v-row>


</template>

<style scoped>

</style>
