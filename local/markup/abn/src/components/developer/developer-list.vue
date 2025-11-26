<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import type DeveloperListItemDto from "@/dto/entity/DeveloperListItemDto.ts";
import BuildObjectItem from "@/components/objects/build-object-item.vue";

import {Swiper, SwiperSlide} from 'swiper/vue';


export default defineComponent({
  name: "DeveloperList",
  components: {BuildObjectItem, Swiper, SwiperSlide},
  props: {
    developers: {
      type: Array as PropType<DeveloperListItemDto[]>,
      default: () => []
    }
  }
})
</script>

<template>


  <section class="developer-list" v-if="developers.length > 0">
    <div class="developer-card" v-for="developer in developers">

      <div class="developer-card-description">
        <img
          class="developer-card-description__logo"
          v-if="developer.picture?.src"
          :src="developer.picture.src"
          :alt="developer.name"
        >

        <div class="developer-card-description__text" v-if="developer.description">
          {{ developer.description }}
        </div>
      </div>


      <div
        v-if="developer.buildObjects && developer.buildObjects.length > 0"
        class="developer-object-list"
      >
        <swiper class="mySwiper" :space-between="30" :slides-per-view="4">
          <swiper-slide
            v-for="object in developer.buildObjects"
          >
            <BuildObjectItem
              :buildObject="object"
            />
          </swiper-slide>
        </swiper>
      </div>

    </div>
  </section>

</template>

<style lang="scss">

.developer {
  &-list {
    display: flex;
    flex-direction: column;
    gap: 20px;
  }

  &-card {
    &-description {
      &__logo {
      }

      &__text {
      }
    }
  }

  &-object-list {

  }
}

</style>
