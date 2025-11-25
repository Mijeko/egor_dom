<script lang="ts">
import {defineComponent} from 'vue'
import CurrentCity from "@/components/site/header/current-city.vue";
import FastSearch from "@/components/site/header/fast-search.vue";
import Cabinet from "@/components/site/cabinet.vue";
import MenuHeader from "@/components/site/header/menu-header.vue";

export default defineComponent({
  name: "AppHeader",
  components: {MenuHeader, Cabinet, FastSearch, CurrentCity}
})
</script>

<template>

  <header class="container header">
    <a href="/" class="logo">
      <img class="logo__image" src="@/assets/images/logo.svg" alt="logo">
    </a>

    <CurrentCity/>

    <MenuHeader

    />

    <FastSearch/>

    <Cabinet/>


  </header>
</template>

<style lang="scss">
.header {
  margin-top: 30px !important;
  border: 1px solid #cacaca;
  border-radius: 50px;
  padding: 15px 35px !important;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 50px;
}

.logo {
  max-width: 168px;
  width: 100%;
  padding-bottom: 4%;
  position: relative;

  &__image {
    width: 100%;
    height: 100%;
    display: block;
    object-fit: cover;
    position: absolute;
  }
}
</style>
