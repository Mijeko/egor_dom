<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import type ApartmentDto from "@/dto/entity/ApartmentDto.ts";

export default defineComponent({
  name: "ApartmentListFilter",
  data: function () {
    return {
      range: []
    };
  },
  watch: {
    range: function (oldVal: any, newVal: any) {
      let minPrice = newVal[0];
      let maxPrice = newVal[1];

      let filtered = this.apartments.filter((apart: ApartmentDto) => {
        return minPrice < apart.price && apart.price < maxPrice;
      });

      this.$emit('update:filteredApartments', filtered);
    },
  },
  props: {
    filteredApartments: {
      type: Array as PropType<ApartmentDto[]>,
      default: []
    },
    apartments: {
      type: Array as PropType<ApartmentDto[]>,
      default: []
    }
  },
  computed: {
    minPrice: function () {
      let sortResult = this.apartments.sort((apartmentA: ApartmentDto, apartmentB: ApartmentDto) => {
        if (apartmentA.price > apartmentB.price) {
          return 1;
        }
        return 0;
      });

      return sortResult[0].price;

    },
    maxPrice: function () {
      let sortResult = this.apartments.sort((apartmentA: ApartmentDto, apartmentB: ApartmentDto) => {
        if (apartmentA.price < apartmentB.price) {
          return -1;
        }
        return 0;
      });

      return sortResult[0].price;
    },
  }
})
</script>

<template>

  <v-range-slider
    v-model="range"
    :max="maxPrice"
    :min="minPrice"
    :step="1"
    class="align-center"
    hide-details
  >
    <template v-slot:prepend>
      <v-text-field
        v-model="range[0]"
        density="compact"
        style="width: 170px"
        type="number"
        variant="outlined"
        hide-details
        single-line
      ></v-text-field>
    </template>
    <template v-slot:append>
      <v-text-field
        v-model="range[1]"
        density="compact"
        style="width: 170px"
        type="number"
        variant="outlined"
        hide-details
        single-line
      ></v-text-field>
    </template>
  </v-range-slider>

</template>

<style scoped>

</style>
