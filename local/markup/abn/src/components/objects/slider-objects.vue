<script lang="ts">
import {defineComponent} from 'vue'
import type BuildObjectDto from "@/dto/entity/BuildObjectDto.ts";
import {Swiper, SwiperSlide} from "swiper/vue";
import {Navigation} from "swiper/modules";
import type {NavigationOptions} from "swiper/types";

export default defineComponent({
  name: "SliderObjects",
  components: {SwiperSlide, Swiper},
  data: function () {
    return {
      modules: [Navigation],
      navigation: {
        nextEl: '.developer-slider-next',
        prevEl: '.developer-slider-prev',
      } as NavigationOptions,
    };
  },
  props: {
    buildObjectList: {
      type: Array as PropType<BuildObjectDto[]>,
      default: () => [],
    }
  }
})
</script>

<template>
  <swiper
    class="slider-objects"
    :space-between="30"
    :slides-per-view="3"
    :navigation
    :modules
  >
    <swiper-slide
      v-for="object in buildObjectList"
    >
      <BuildObjectItem
        :buildObject="object"
      />
    </swiper-slide>


    <div class="slider-objects-prev">
      <svg width="12" height="10" viewBox="0 0 12 10" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M6.75 0.75L10.75 4.75L6.75 8.75M0.75 0.750001L4.75 4.75L0.75 8.75" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
    </div>
    <div class="slider-objects-next">
      <svg width="12" height="10" viewBox="0 0 12 10" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M6.75 0.75L10.75 4.75L6.75 8.75M0.75 0.750001L4.75 4.75L0.75 8.75" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
    </div>
  </swiper>
</template>

<style lang="scss">
.slider-objects {
  width: 100%;
}
</style>
