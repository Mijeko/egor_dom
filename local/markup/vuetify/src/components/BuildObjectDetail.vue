<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import type BuildObjectDetailDto from "@/dto/present/BuildObjectDetailDto.ts";
import ApartmentList from "@/components/ApartmentList.vue";
import type BuildObjectDetailInfo from "@/dto/present/component/buildObjectDetailInfo.ts";

export default defineComponent({
  name: "BuildObjectDetail",
  components: {ApartmentList},
  props: {
    product: {
      type: Object as PropType<BuildObjectDetailDto>
    }
  },
  computed: {
    buildObjectDetailInfo: function (): BuildObjectDetailInfo[] {
      return [
        {
          title: 'Застройщик',
          value: String(this.product?.developer?.name),
        },
        {
          title: 'Колличество этажей',
          value: String(this.product?.floors),
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
      <h3>Купить квартиру</h3>
      <ApartmentList
        v-if="product?.apartments"
        :apartments="product?.apartments"
      />
    </v-col>
  </v-row>
</template>

<style scoped>

</style>
