<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import DeveloperList from "@/components/developer/developer-list.vue";
import type DeveloperListItemDto from "@/dto/entity/DeveloperListItemDto.ts";
import DeveloperSearch from "@/components/developer/developer-search.vue";

export default defineComponent({
  name: "list",
  components: {DeveloperSearch, DeveloperList},
  props: {
    developers: {
      type: Array as PropType<DeveloperListItemDto[]>
    }
  }
})
</script>

<template>
  <div class="developer-list-page">
    <h1 class="developer-list-page__title">Застройщики</h1>
    <DeveloperSearch/>
    <DeveloperList
      :developers
    />
  </div>
</template>

<style lang="scss">
@use '@/styles/system/variable' as *;

.developer-list-page {
  //display: flex;
  //flex-direction: column;
  //align-items: center;

  &__title {
    font-family: var(--second-family);
    font-weight: 300;
    font-size: 30px;
    line-height: 140%;
    text-transform: uppercase;
    text-align: center;
    color: $bo-color-name;
  }
}
</style>
