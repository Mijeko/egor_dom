<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import type DeveloperListItemDto from "@/dto/entity/DeveloperListItemDto.ts";
import BuildObjectItem from "@/components/objects/build-object-item.vue";

import {Swiper, SwiperSlide} from 'swiper/vue';
import {Navigation} from 'swiper/modules';
import type {NavigationOptions} from "swiper/types";


export default defineComponent({
  name: "DeveloperList",
  components: {BuildObjectItem, Swiper, SwiperSlide},
  props: {
    developers: {
      type: Array as PropType<DeveloperListItemDto[]>,
      default: () => []
    }
  },
  data: function () {
    return {
      modules: [Navigation],
      navigation: {
        nextEl: '.developer-slider-next',
        prevEl: '.developer-slider-prev',
      } as NavigationOptions,
    };
  }
})
</script>

<template>


  <section class="developer-list" v-if="developers.length > 0">
    <div class="developer-card" v-for="developerItem in developers">

      <div class="developer-card-description">
        <img
          class="developer-card-description__logo"
          v-if="developerItem.developer.picture?.src"
          :src="developerItem.developer.picture.src"
          :alt="developerItem.developer.name"
        >

        <div class="developer-card-description__text" v-if="developerItem.developer.description">
          {{ developerItem.developer.description }}
        </div>
      </div>


      <div
        v-if="developerItem.buildObjects && developerItem.buildObjects.length > 0"
        class="developer-object-list"
      >
        <swiper
          class="developer-slider"
          :space-between="30"
          :slides-per-view="3"
          :navigation
          :modules
        >
          <swiper-slide
            v-for="object in developerItem.buildObjects"
          >
            <BuildObjectItem
              :buildObject="object"
            />
          </swiper-slide>


          <div class="developer-slider-prev">
            <svg width="12" height="10" viewBox="0 0 12 10" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M6.75 0.75L10.75 4.75L6.75 8.75M0.75 0.750001L4.75 4.75L0.75 8.75" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
          <div class="developer-slider-next">
            <svg width="12" height="10" viewBox="0 0 12 10" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M6.75 0.75L10.75 4.75L6.75 8.75M0.75 0.750001L4.75 4.75L0.75 8.75" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
        </swiper>
      </div>

    </div>
  </section>

</template>

<style lang="scss">
@use '@/styles/system/variable' as *;

.developer {
  &-list {
    display: flex;
    flex-direction: column;
    gap: 20px;
  }

  &-slider {
    padding-bottom: 70px;

    &-prev, &-next {
      position: absolute;
      top: auto;
      bottom: 0;
      padding: 16px 25px;
      border: 1px solid #f9f9f9;
      border-radius: 50px;
      cursor: pointer;

      &.swiper-button-disabled {
        background: #f6f6f6;

        svg {
          path {
            stroke: #cacaca;
          }
        }
      }

      &:not(.swiper-button-disabled) {
        box-shadow: 0 0 20px 0 rgba(139, 139, 139, 0.1);
        background: #9fccff;
      }
    }

    &-prev {
      left: 45%;
      transform: translateX(-45%);

      svg {
        transform: rotate(180deg);
      }
    }

    &-next {
      right: 45%;
      transform: translateX(45%);
    }
  }

  &-card {
    &-description {
      display: flex;
      flex-direction: column;
      gap: 10px;
      margin-bottom: 40px;

      &__logo {
        max-width: 130px;
        object-fit: contain;
        display: block;
      }

      &__text {
        font-family: var(--font-family);
        font-weight: 400;
        font-size: 14px;
        line-height: 170%;
        text-transform: uppercase;
        color: $bo-color-name;
      }
    }
  }

  &-object-list {

  }
}

</style>
