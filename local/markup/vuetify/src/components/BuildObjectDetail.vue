<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import type BuildObjectDetail from "@/dto/BuildObjectDetail.ts";
import ApartmentList from "@/components/ApartmentList.vue";

export default defineComponent({
  name: "BuildObjectDetail",
  components: {ApartmentList},
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
      1
    </v-col>
    <v-col md="4">
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
