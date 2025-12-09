<script lang="ts">
import {defineComponent} from 'vue'
import type BuildObjectDto from "@/dto/entity/BuildObjectDto.ts";
import type DeveloperDto from "@/dto/entity/DeveloperDto.ts";
import {Swiper, SwiperSlide} from 'swiper/vue';
import {Pagination} from 'swiper/modules';
import Price from "@/core/price.ts";
import type BxImage from "@/dto/bitrix/BxImage.ts";
import BuildObjectService from "@/service/BuildObjectService.ts";
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

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
      return BuildObjectService.minPrice(object);
    },
    gallery(obj: BuildObjectDto): BxImage[] {

      if (!obj.gallery) {
        return [];
      }

      let gallery: BxImage[] = obj.gallery;

      gallery = gallery.filter((img: BxImage) => {
        return img?.src && typeof img?.src === 'string';
      });

      return gallery;
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
      <swiper-slide v-for="(image,index) in gallery(buildObject)" class="build-object-card-slider-slide">
        <img
          v-if="image.src"
          :src="image.src"
          :alt="`${buildObject.name} ${index}`"
          class="build-object-card-slider-slide__image"
        >
      </swiper-slide>
    </swiper>

    <a
      :href="buildObject.detailLink"
      class="build-object-card-name"
    >
      {{ buildObject?.name }}
    </a>

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
    text-decoration: none;
    display: block;
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
