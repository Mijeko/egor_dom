<script lang="ts">
import {defineComponent} from 'vue'
import type BuildObjectDto from "@/dto/entity/BuildObjectDto.ts";
import type DeveloperDto from "@/dto/entity/DeveloperDto.ts";
import type ApartmentDto from "@/dto/entity/ApartmentDto.ts";
import {Swiper, SwiperSlide} from 'swiper/vue';
import {Pagination} from 'swiper/modules';
import Price from "@/core/price.ts";

export default defineComponent({
  name: "BuildObjectItem",
  computed: {
    Price() {
      return Price
    }
  },
  data: function () {
    return {
      modules: [Pagination],
    };
  },
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


    <swiper
      class="build-object-card-slider"
      v-if="buildObject?.gallery"
      :pagination="true"
      :modules
    >
      <swiper-slide v-for="(image,index) in buildObject.gallery" class="build-object-card-slider-slide">
        <img :src="image.src" :alt="`${buildObject.name} ${index}`" class="build-object-card-slider-slide__image">
      </swiper-slide>
    </swiper>

    <div class="build-object-card-name">{{ buildObject?.name }}</div>

    <div class="build-object-card-body">
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
          <div class="build-object-card-chars-value" v-if="buildObject">от {{ Price.format(minPrice(buildObject)) }}</div>
        </div>
      </div>
    </div>

  </div>
</template>

<style lang="scss">

@use '@/styles/system/variable' as *;

.build-object-card {

  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: flex-start;
  padding: 5px 5px 20px 5px;
  box-shadow: 0 -10px 30px 0 rgba(89, 89, 89, 0.1);
  background: #fff;
  border-radius: 30px;

  //border: 1px red solid;

  &-slider {
    width: 100%;
    margin-bottom: 30px;

    &-slide {
      padding-bottom: 85%;
      border-radius: 30px;
      overflow: hidden;
      position: relative;

      &__image {
        width: 100%;
        height: 100%;
        position: absolute;
        object-fit: cover;
      }
    }

    .swiper-pagination-bullet {
      background-color: rgba(255, 255, 255, 0.5);
      opacity: 1;

      &.swiper-pagination-bullet-active {
        background-color: rgba(255, 255, 255, 1);
        opacity: 1;
      }
    }
  }

  &-name {
    font-family: var(--second-family);
    font-weight: 400;
    font-size: 14px;
    line-height: 120%;
    text-transform: uppercase;
    color: $bo-color-name;
    margin-bottom: 17px;

  }

  &-body {
    width: 100%;
    padding: 0 45px;
  }

  &-chars {
    display: flex;
    flex-direction: column;
    width: 100%;

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
