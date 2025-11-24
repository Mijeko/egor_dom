<script lang="ts">
import {defineComponent} from 'vue'
import ReviewsAsShorts from "@/components/Content/Reviews/ReviewsAsShorts.vue";
import ProductCarousel from "@/components/Catalog/ProductCarousel.vue";
import CategoryShadow from "@/components/Catalog/CategoryShadow.vue";
import type ReviewShort from "@/dto/entity/ReviewShort.ts";

export default defineComponent({
  name: "index",
  components: {CategoryShadow, ProductCarousel, ReviewsAsShorts},
  props: {
    reviewsShort: {
      type: Array as PropType<ReviewShort[]>,
      default: () => []
    }
  }
})
</script>

<template>
  <MainSlider
    :items="[
      {
        id:1,
        image:'',
        name:'test 1',
      },
      {
        id:2,
        image:'',
        name:'test 2',
      },
      {
        id:3,
        image:'',
        name:'test 3',
      },
    ]"
  />


  <CategoryShadow

  />


  <ProductCarousel

  />

  <ReviewsAsShorts
    :reviewsShort
  />
</template>

<style lang="scss">

</style>
