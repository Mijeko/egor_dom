<script lang="ts">
import {defineComponent, type PropType} from 'vue'

import type BuildObjectDto from "@/dto/entity/BuildObjectDto.ts";

export default defineComponent({
  name: "BuildObjectList",
  props: {
    BuildObjects: {
      type: Array as PropType<BuildObjectDto[]>
    }
  },
  mounted(): any {
    console.log(this.BuildObjects);
  }
})
</script>

<template>
  <v-app>
    <v-card v-for="buildObject in BuildObjects" class="mb-5">
      <v-row>
        <v-col md="3">
          <v-img :src="buildObject?.picture?.src" width="200" height="100" cover></v-img>
        </v-col>
        <v-col md="6">
          <v-card-text>{{ buildObject.name }}</v-card-text>
        </v-col>
        <v-col md="3">
          <v-btn :href="buildObject.detailLink">Посмотреть</v-btn>
        </v-col>
      </v-row>
    </v-card>
  </v-app>
</template>

<style scoped>

</style>
