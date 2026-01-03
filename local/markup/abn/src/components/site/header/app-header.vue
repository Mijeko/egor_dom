<script lang="ts">
import {defineComponent} from 'vue'
import CurrentCity from "@/components/site/header/current-city.vue";
import FastSearch from "@/components/site/header/fast-search.vue";
import Cabinet from "@/components/site/cabinet.vue";
import type BxUserDto from "@/dto/bitrix/BxUserDto.ts";

export default defineComponent({
  name: "AppHeader",
  components: {Cabinet, FastSearch, CurrentCity},
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
  <header class="container header">
    <a href="/" class="logo">
      <img class="logo__image" src="@/assets/images/logo.svg" alt="logo">
    </a>

    <CurrentCity/>

    <MenuBx
      typeMenu="top"
    >
      <template #items="{items}">

        <ul class="menu-header">
          <li class="menu-header__item" v-for="item in items">
            <a class="menu-header__link" :href="item.url">{{ item.title }}</a>
          </li>
        </ul>

      </template>
    </MenuBx>

    <FastSearch/>

    <Cabinet
      :user
    />


  </header>
</template>

<style lang="scss">
@use "@/styles/system/variable" as *;

.header {
  margin-top: 30px !important;
  margin-bottom: 70px !important;
  border: 1px solid #cacaca;
  border-radius: 50px;
  padding: 15px 35px !important;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 50px;
}


.menu-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 35px;

  &__item {
    font-family: var(--font-family);
    font-weight: 500;
    font-size: 14px;
    line-height: 120%;
    color: $menu-blacked;

  }

  &__link {
    font-family: var(--font-family);
    font-weight: 500;
    font-size: 14px;
    line-height: 120%;
    color: $menu-blacked;
    text-decoration: none;
  }
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
