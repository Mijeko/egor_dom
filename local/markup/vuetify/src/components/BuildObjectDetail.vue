<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import type BuildObjectDetailDto from "@/dto/present/BuildObjectDetailDto.ts";
import ApartmentList from "@/components/ApartmentList.vue";
import type BuildObjectDetailInfo from "@/dto/present/component/buildObjectDetailInfo.ts";
import Map from "@/components/Map.vue";
import ApartmentListFilter from "@/components/ApartmentListFilter.vue";

export default defineComponent({
  name: "BuildObjectDetail",
  components: {ApartmentListFilter, Map, ApartmentList},
  props: {
    product: {
      type: Object as PropType<BuildObjectDetailDto>
    }
  },
  data: function () {
    return {
      filteredApartments: [],
    };
  },
  computed: {
    computedApartments: function () {

      if (this.filteredApartments && this.filteredApartments.length > 0) {
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
  mounted(): any {
    console.log(this.product);
  }
})
</script>

<template>
  <v-row>
    <v-col md="8" class="px-2">

      <v-carousel>
        <v-carousel-item
          v-for="galleryItem in product?.gallery"
          :src="galleryItem.src"
          cover
        ></v-carousel-item>
      </v-carousel>

    </v-col>
    <v-col md="4" class="px-2">
      <v-card v-for="info in buildObjectDetailInfo"
              :title="String(info.title)"
              :subtitle="String(info.value)"
              class="mb-3"
      ></v-card>
    </v-col>
  </v-row>

  <v-row>
    <v-col cols="12">
      <Map
        :apartment-list="product?.apartments"
        :lat="Number(product?.location?.latitude)"
        :lon="Number(product?.location?.longitude)"
      />
    </v-col>
  </v-row>

  <v-row>
    <v-col cols="12">
      <v-row>
        <v-col cols="2">
          <h3>Купить квартиру</h3>
        </v-col>
        <v-col cols="10">
          <ApartmentListFilter
            :filtered-apartments="filteredApartments"
            @update:filteredApartments="filteredApartments = $event"
            :apartments="product?.apartments"
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
