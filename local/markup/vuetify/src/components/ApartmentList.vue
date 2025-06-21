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
  Квартирки

  <v-card v-for="apart in apartments">
    {{ apart.name }}
  </v-card>
</template>

<style scoped>

</style>
