<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import ApartmentList from "@/components/ApartmentList.vue";
import type BuildObjectDetailInfo from "@/dto/present/component/buildObjectDetailInfo.ts";
import Map from "@/components/Map.vue";
import ApartmentFilter from "@/components/ApartmentFilter.vue";
import type BuildObjectDto from "@/dto/entity/BuildObjectDto.ts";
import MainApartmentFilter from "@/components/filter/MainApartmentFilter.vue";

export default defineComponent({
  name: "BuildObjectDetail",
  components: {MainApartmentFilter, ApartmentFilter, Map, ApartmentList},
  props: {
    product: {
      type: Object as PropType<BuildObjectDto>
    }
  },
  data: function () {
    return {
      isRunFilter: false,
      filteredApartments: [],
      filterApartmentList: [],
    };
  },
  computed: {
    computedApartments: function () {

      if (this.isRunFilter) {
        return this.filteredApartments;
      }

      return this.product?.apartments;
    },
    buildObjectDetailInfo: function (): BuildObjectDetailInfo[] {
      return [
        {
          title: 'Застройщик',
          value: String(this.product?.developer?.name),
        },
        {
          title: 'Колличество этажей',
          value: String(this.product?.floors),
        },
        {
          title: 'Адрес',
          value: `${this.product?.location?.country}, ${this.product?.location?.localityName}, ${this.product?.location?.address}`
        },
        {
          title: 'Тип дома',
          value: String(this.product?.type)
        }
      ]
    }
  },
})
</script>

<template>
  <v-row>
    <v-col cols="12" md="8" class="px-2">
      <v-carousel>
        <v-carousel-item
          v-for="galleryItem in product?.gallery"
          :src="galleryItem.src"
          cover
        ></v-carousel-item>
      </v-carousel>
    </v-col>
    <v-col cols="12" md="4" class="px-2">
      <v-card v-for="info in buildObjectDetailInfo"
              :title="String(info.title)"
              :subtitle="String(info.value)"
              class="mb-3"
      ></v-card>
    </v-col>
  </v-row>

  <v-divider class="mt-15 mb-15"/>

  <h2>Объект на карте</h2>
  <v-row>
    <v-col cols="12">
      <Map
        :apartment-list="product?.apartments"
        :lat="Number(product?.location?.latitude)"
        :lon="Number(product?.location?.longitude)"
      />
    </v-col>
  </v-row>

  <v-divider class="mt-15 mb-15"/>

  <v-row>
    <v-col cols="12">
      <v-row>
        <v-col>
          <h2 class="pt-2">Купить квартиру</h2>
        </v-col>
      </v-row>
      <v-row>
        <v-col>
          <MainApartmentFilter
            v-model="filterApartmentList"
          />
        </v-col>
      </v-row>

      <ApartmentList
        v-if="product?.apartments"
        :apartments="computedApartments"
      />
    </v-col>
  </v-row>
</template>

<style scoped>

</style>
