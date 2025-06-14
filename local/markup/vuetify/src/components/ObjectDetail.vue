<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import type BuildObjectDetail from "@/dto/BuildObjectDetail.ts";

export default defineComponent({
  name: "ObjectDetail",
  props: {
    product: {
      type: Object as PropType<BuildObjectDetail>
    }
  }
})
</script>

<template>
  <v-row>
    <v-col md="8">

    </v-col>
    <v-col md="4">

    </v-col>
  </v-row>
</template>

<style scoped>

</style>
