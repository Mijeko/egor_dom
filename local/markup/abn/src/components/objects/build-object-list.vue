<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import type ApartmentDto from "@/dto/entity/ApartmentDto.ts";
import type BuildObjectDto from "@/dto/entity/BuildObjectDto.ts";
import type {ApartmentFilterData} from "@/dto/ApartmentFilterData.ts";
import MainApartmentFilter from "@/components/filter/main-apartment-filter.vue";

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
  computed: {
    buildObjectList: function (): BuildObjectDto[] {

      if (this.filterApartmentList.length > 0) {

        let objects: null[] | BuildObjectDto[] = this.filterApartmentList.map(function (apartment: ApartmentDto) {
          return apartment.buildObject;
        });

        objects = objects.filter(n => n);

        let _idObjects: number[] = [];

        objects = objects.filter(function (buildObject: BuildObjectDto) {

          let buildObjectId: number = buildObject.id;

          if (_idObjects.includes(buildObjectId)) {
            return null;
          }
          _idObjects.push(buildObjectId);
          return buildObject;
        });

        objects = objects.filter(n => n);

        objects = objects.map((buildObject: BuildObjectDto) => {

          let _apartments = this.filterApartmentList.filter((apartment: ApartmentDto) => {
            return apartment.buildObjectId === buildObject.id;
          });


          if (_apartments.length > 0) {
            buildObject.apartments = _apartments;
          }

          buildObject.countApartments = buildObject.apartments?.length;

          return buildObject;
        });


        return objects as BuildObjectDto[];

      }

      return this.buildObjects as BuildObjectDto[];
    }
  }
})
</script>

<template>

  <MainApartmentFilter
    v-model="filterApartmentList"
  />

  <v-row>
    <v-col cols="12" sm="6" md="4" lg="3" v-for="buildObject in buildObjectList" class="mb-5">
      <v-card>

        <v-carousel :show-arrows="false" :hide-delimiters="true" :touch="true">
          <v-carousel-item
            v-for="(item,i) in buildObject.gallery"
            :key="i"
            :src="item?.src"
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
