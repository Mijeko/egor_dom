<script lang="ts">
import {defineComponent} from 'vue'
import AppHeader from "@/components/site/header/app-header.vue";
import AppFooter from "@/components/site/footer/AppFooter.vue";

export default defineComponent({
  name: "default",
  components: {AppFooter, AppHeader}
})
</script>

<template>

  <div class="stronger">
    <AppHeader/>


    <div class="page-content">
      <slot/>
    </div>

    <AppFooter/>
  </div>
</template>

<style lang="scss">
@use '@/styles/system/full-width-page' as *;
</style>
