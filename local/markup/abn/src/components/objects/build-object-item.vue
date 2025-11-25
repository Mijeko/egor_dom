<script lang="ts">
import {defineComponent} from 'vue'
import type BuildObjectDto from "@/dto/entity/BuildObjectDto.ts";

export default defineComponent({
  name: "BuildObjectItem",
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
      <v-carousel
        v-if="buildObject?.gallery"
        :show-arrows="buildObject?.gallery?.length > 1"
        :hide-delimiters="true"
      >
        <v-carousel-item
          v-for="galleryItem in buildObject?.gallery"
          :src="galleryItem.src"
          cover
        ></v-carousel-item>
      </v-carousel>
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
