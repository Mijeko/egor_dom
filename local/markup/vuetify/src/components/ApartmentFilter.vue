<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import type ApartmentDto from "@/dto/entity/ApartmentDto.ts";

export default defineComponent({
  name: "ApartmentFilter",
  data: function () {
    return {
      filter: {
        price: [] as number[],
        rooms: 1,
        floor: 1,
      },
    };
  },
  watch: {
    'filter.price': function (newVal: any, oldVal: any) {
      let minPrice = newVal[0];
      let maxPrice = newVal[1];

      let filtered = this.apartments.filter((apart: ApartmentDto) => {
        return minPrice < apart.price && apart.price < maxPrice;
      });

      this.$emit('update:filteredApartments', filtered);
    },
    'filter.rooms': function (newVal: any, oldVal: any) {

      let rooms = newVal;

      let filtered = this.apartments.filter((apart: ApartmentDto) => {
        return apart.rooms >= rooms;
      });

      this.$emit('update:filteredApartments', filtered);
    },
    'filter.floor': function (newVal: any, oldVal: any) {

      let floor = newVal;
      let filtered = this.apartments.filter((apart: ApartmentDto) => {
        return apart.floor >= floor;
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
      return this.calcMinPrice();
    },
    maxPrice: function () {
      return this.calcMaxPrice();
    },
  },
  methods: {
    calcMinPrice: function (): number {
      let sortResult = this.apartments.sort((apartmentA: ApartmentDto, apartmentB: ApartmentDto) => {
        if (apartmentA.price > apartmentB.price) {
          return 1;
        }
        return 0;
      });

      return sortResult[0].price;
    },
    calcMaxPrice: function (): number {
      let sortResult = this.apartments.sort((apartmentA: ApartmentDto, apartmentB: ApartmentDto) => {
        if (apartmentA.price < apartmentB.price) {
          return 1;
        }
        return 0;
      });

      return sortResult[0].price;
    },
  },
  mounted(): any {
    this.filter.price[0] = this.calcMinPrice();
    this.filter.price[1] = this.calcMaxPrice();
  }
})
</script>

<template>

  <v-row>
    <v-col cols="6">
      <v-range-slider
        v-model="filter.price"
        :max="maxPrice"
        :min="minPrice"
        :step="1"
        class="align-center"
        hide-details
      >
        <template v-slot:prepend>
          <v-text-field
            v-model="filter.price[0]"
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
            v-model="filter.price[1]"
            density="compact"
            style="width: 170px"
            type="number"
            variant="outlined"
            hide-details
            single-line
          ></v-text-field>
        </template>
      </v-range-slider>
    </v-col>
    <v-col cols="3">
      <v-number-input
        :min="1"
        control-variant="stacked"
        v-model="filter.rooms"
        :reverse="false"
        label="Кол-во комнат"
        :hideInput="false"
        :inset="false"
        variant="outlined"
      ></v-number-input>
    </v-col>
    <v-col cols="3">
      <v-number-input
        :min="1"
        control-variant="stacked"
        v-model="filter.floor"
        :reverse="false"
        label="Этаж"
        :hideInput="false"
        :inset="false"
        variant="outlined"
      ></v-number-input>
    </v-col>
  </v-row>


</template>

<style scoped>

</style>
