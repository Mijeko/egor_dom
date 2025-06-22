<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import type ApartmentDto from "@/dto/entity/ApartmentDto.ts";

export default defineComponent({
  name: "ApartmentList",
  props: {
    apartments: {
      type: Array as PropType<ApartmentDto[]>,
      default: []
    }
  }
})
</script>

<template>


  <v-card v-for="apart in apartments" class="mb-3">
    <v-row>
      <v-col md="9" class="pa-5">
        <v-card-title>{{ apart.name }}</v-card-title>
        <v-card-subtitle>{{ apart.price }}</v-card-subtitle>
      </v-col>
      <v-col md="3" class="pa-5">
        <v-btn>Купить</v-btn>
      </v-col>
    </v-row>
  </v-card>


</template>

<style scoped>

</style>
