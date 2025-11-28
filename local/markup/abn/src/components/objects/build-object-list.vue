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

  <div class="catalog container">
    <BuildObjectItem
      v-for="object in buildObjectList"
      :build-object="object"
    />
  </div>

</template>

<style lang="scss">
.catalog {
  display: flex;
  flex-wrap: wrap;
  gap: 30px;
  margin-left: 0 !important;

  .build-object-card {
    max-width: 31%;
    width: 100%;
  }
}
</style>
