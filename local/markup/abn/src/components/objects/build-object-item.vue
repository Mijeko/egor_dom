<script lang="ts">
import {defineComponent} from 'vue'
import type BuildObjectDto from "@/dto/entity/BuildObjectDto.ts";
import {Swiper, SwiperSlide} from 'swiper/vue';

export default defineComponent({
  name: "BuildObjectItem",
  components: {Swiper, SwiperSlide},
  props: {
    buildObject: Object as PropType<BuildObjectDto>,
    default: () => {
    }
  },
  methods: {
    minPrice(object: BuildObjectDto): number {
      return 0;
    }
  }
})
</script>

<template>
  <div class="build-object-item">
    <div class="build-object-item-slider">

      <swiper class="mySwiper">
        <swiper-slide>Slide 1</swiper-slide>
        <swiper-slide>Slide 2</swiper-slide>
        <swiper-slide>Slide 3</swiper-slide>
        <swiper-slide>Slide 4</swiper-slide>
        <swiper-slide>Slide 5</swiper-slide>
        <swiper-slide>Slide 6</swiper-slide>
        <swiper-slide>Slide 7</swiper-slide>
        <swiper-slide>Slide 8</swiper-slide>
        <swiper-slide>Slide 9</swiper-slide>
      </swiper>


<!--      <v-carousel-->
<!--        v-if="buildObject?.gallery"-->
<!--        :show-arrows="buildObject?.gallery?.length > 1"-->
<!--        :hide-delimiters="true"-->
<!--      >-->
<!--        <v-carousel-item-->
<!--          v-for="galleryItem in buildObject?.gallery"-->
<!--          :src="galleryItem.src"-->
<!--          cover-->
<!--        ></v-carousel-item>-->
<!--      </v-carousel>-->
    </div>
    <div class="build-object-item-name">{{ buildObject?.name }}</div>
    <div class="build-object-item-chars">
      <div class="build-object-item-chars-row">
        <div class="build-object-item-chars-label">Город</div>
        <div class="build-object-item-chars-value">Барнаул</div>
      </div>
      <div class="build-object-item-chars-row">
        <div class="build-object-item-chars-label">Застройщик</div>
        <div class="build-object-item-chars-value">ГК "Ренова"</div>
      </div>
      <div class="build-object-item-chars-row">
        <div class="build-object-item-chars-label">Стоимость</div>
        <div class="build-object-item-chars-value" v-if="buildObject">от {{ minPrice(buildObject) }}</div>
      </div>
    </div>
  </div>
</template>

<style lang="scss">

</style>
