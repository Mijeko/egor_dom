<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import type DeveloperListItemDto from "@/dto/entity/DeveloperListItemDto.ts";
import BuildObjectItem from "@/components/objects/build-object-item.vue";

import Swiper from "swiper";
import { Navigation, Pagination } from 'swiper/modules';

export default defineComponent({
  name: "DeveloperList",
  components: {BuildObjectItem},
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
    <div class="developer-item" v-for="developer in developers">

      <div class="developer-description">
        <img
          class="developer-description__logo"
          v-if="developer.picture?.src"
          :src="developer.picture.src"
          :alt="developer.name"
        >

        <div class="developer-description__text" v-if="developer.description">
          {{ developer.description }}
        </div>
      </div>


      <div class="developer-object-list" v-if="developer.buildObjects && developer.buildObjects.length > 0">

        <v-carousel :touch="true" :show-arrows="developer.buildObjects.length > 1" :hide-delimiters="true">
          <v-carousel-item
            v-for="object in developer.buildObjects.slice(0, 10)"
          >
            <BuildObjectItem
              :buildObject="object"
            />
          </v-carousel-item>
        </v-carousel>

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


  .developer-item {
    .developer {
      &-description {
        &__logo {
        }

        &__text {
        }
      }

      &-object {
        &-list {

        }
      }
    }
  }
}
</style>
