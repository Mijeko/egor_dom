<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import BuildObjectList from "@/components/objects/build-object-list.vue";
import type BuildObjectDto from "@/dto/entity/BuildObjectDto.ts";

export default defineComponent({
  name: "list",
  components: {BuildObjectList},
  props: {
    buildObjects: {
      type: Array as PropType<BuildObjectDto[]>
    }
  },
})
</script>

<template>
  <section class="catalog-page-wrap">
    <aside class="catalog-filter"></aside>

    <div class="catalog-page">
      <h1 class="catalog-page-title">Каталог недвижимости</h1>
      <BuildObjectList
        :buildObjects
      />
    </div>
  </section>
</template>

<style lang="scss">
@use '@/styles/system/variable' as *;

.catalog-page {
  width: 100%;

  &-title {
    margin: auto auto 40px auto;
    font-family: var(--second-family);
    font-weight: 300;
    font-size: 30px;
    line-height: 140%;
    text-transform: uppercase;
    text-align: center;
    color: $bo-color-name;
  }

  &-wrap {
    display: flex;
    gap: 30px;
    padding-left: 100px;
  }
}

.catalog-filter {
  max-width: 250px;
  width: 100%;
  border: 1px red solid;
}
</style>
