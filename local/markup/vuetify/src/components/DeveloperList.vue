<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import type DeveloperListItemDto from "@/dto/entity/DeveloperListItemDto.ts";

export default defineComponent({
  name: "DeveloperList",
  mounted() {
  },
  props: {
    developers: {
      type: Array as PropType<DeveloperListItemDto[]>
    }
  }
})
</script>

<template>
  <v-app>
    <v-card v-for="developer in developers" class="mb-2">
      <v-row class="pa-2">
        <v-col md="2" sm="4">
          <v-img :src="developer?.picture?.src" width="200" height="100%" cover></v-img>
        </v-col>
        <v-col md="10" sm="8">
          <v-card-text class="pb-1 text-subtitle-1 font-weight-bold">{{ developer.name }}</v-card-text>
          <v-row>
            <v-col sm="12" md="4" class="pb-sm-0">
              <v-card-text class="pt-2 pb-sm-0">Объектов в продаже: {{ developer.buildObjectsCount }}</v-card-text>
            </v-col>
            <v-col sm="12" md="8" class="pl-sm-7">
              <v-btn :href="`/developers/${developer.id}/`">смотреть</v-btn>
            </v-col>
          </v-row>
        </v-col>
      </v-row>
    </v-card>
  </v-app>
</template>

<style scoped>

</style>
