<script lang="ts">
import {defineComponent} from 'vue'
import type BuildObjectDto from "@/dto/entity/BuildObjectDto.ts";
import {Swiper, SwiperSlide} from 'swiper/vue';
import type DeveloperDto from "@/dto/entity/DeveloperDto.ts";
import type ApartmentDto from "@/dto/entity/ApartmentDto.ts";

export default defineComponent({
  name: "BuildObjectItem",
  components: {Swiper, SwiperSlide},
  props: {
    buildObject: {
      type: Object as PropType<BuildObjectDto>,
      default: () => {
      }
    },
    developer: {
      type: Object as PropType<DeveloperDto>,
      default: () => {
      }
    }
  },
  methods: {
    minPrice(object: BuildObjectDto): number {

      if (!object.apartments || object.apartments.length <= 0) {
        return 0;
      }

      let apartment: ApartmentDto | null | undefined = null;
      let apartmentList: ApartmentDto[] = object.apartments;

      apartment = apartmentList.sort((a: ApartmentDto, b: ApartmentDto) => a.price - b.price).shift();

      if (!apartment) {
        return 0;
      }

      return apartment.price;
    }
  }
})
</script>

<template>
  <div class="build-object-card">
    <div class="build-object-card-slider">

      <swiper :space-between="30" class="mySwiper" v-if="buildObject?.gallery">
        <swiper-slide v-for="(image,index) in buildObject.gallery">
          <img :src="image.src" :alt="`${buildObject.name} ${index}`">
        </swiper-slide>
      </swiper>

    </div>
    <div class="build-object-card-name">{{ buildObject?.name }}</div>

    <div class="build-object-card-chars">
      <div class="build-object-card-chars-row">
        <div class="build-object-card-chars-label">Город</div>
        <div class="build-object-card-chars-value">Барнаул</div>
      </div>
      <div class="build-object-card-chars-row" v-if="developer && developer.name">
        <div class="build-object-card-chars-label">Застройщик</div>
        <div class="build-object-card-chars-value">{{ developer.name }}</div>
      </div>
      <div class="build-object-card-chars-row">
        <div class="build-object-card-chars-label">Стоимость</div>
        <div class="build-object-card-chars-value" v-if="buildObject">от {{ minPrice(buildObject) }}</div>
      </div>
    </div>

  </div>
</template>

<style lang="scss">

@use '@/styles/system/variable' as *;

.build-object-card {

  border: 1px red solid;

  &-slider {
  }

  &-name {
    font-family: var(--second-family);
    font-weight: 400;
    font-size: 14px;
    line-height: 120%;
    text-transform: uppercase;
    color: $bo-color-name;
  }

  &-chars {
    display: flex;
    flex-direction: column;

    &-row {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
    }

    &-label {
      font-weight: 500;
      font-size: 14px;
      line-height: 170%;
      color: $bo-char-label;
    }

    &-value {
      font-weight: 400;
      font-size: 14px;
      line-height: 170%;
      text-align: right;
      color: $bo-color-name;

      b {
        font-weight: 600;
      }
    }
  }
}
</style>
