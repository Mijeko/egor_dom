<script lang="ts">
import {defineComponent, type PropType} from 'vue'

import type BuildObjectDto from "@/dto/entity/BuildObjectDto.ts";
import type BuildObjectDetailDto from "@/dto/present/BuildObjectDetailDto.ts";
import MainApartmentFilter from "@/components/filter/MainApartmentFilter.vue";

export default defineComponent({
  name: "BuildObjectList",
  components: {MainApartmentFilter},
  props: {
    BuildObjects: {
      type: Array as PropType<BuildObjectDetailDto[]>
    }
  },
  mounted(): any {
    console.log(this.BuildObjects);
  }
})
</script>

<template>

  <MainApartmentFilter/>

  <v-row>
    <v-col cols="12" sm="3" v-for="buildObject in BuildObjects" class="mb-5">
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
          <v-card-subtitle>Квартир: {{ buildObject?.apartments?.length }}</v-card-subtitle>

          <v-btn class="mt-5" :href="buildObject.detailLink">Посмотреть</v-btn>
        </div>

      </v-card>
    </v-col>

  </v-row>


</template>

<style scoped>

</style>
