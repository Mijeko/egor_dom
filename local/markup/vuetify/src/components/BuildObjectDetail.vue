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
