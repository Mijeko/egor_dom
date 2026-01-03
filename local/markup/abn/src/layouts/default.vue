<script lang="ts">
import {defineComponent} from 'vue'
import AppHeader from "@/components/site/header/app-header.vue";
import AppFooter from "@/components/site/footer/AppFooter.vue";
import type BxUserDto from "@/dto/bitrix/BxUserDto.ts";

export default defineComponent({
  name: "default",
  components: {AppFooter, AppHeader},
  props: {
    user: {
      type: Object as PropType<BxUserDto>,
      default: () => {
        return {};
      }
    }
  },
})
</script>

<template>

  <div class="stronger">
    <AppHeader
      :user
    />

    <div class="page-content">
      <slot/>
    </div>

    <AppFooter/>
  </div>
</template>

<style lang="scss">
@use '@/styles/system/full-width-page' as *;
</style>
