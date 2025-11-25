<script lang="ts">
import {defineComponent} from 'vue'

export interface MenuItem {
  name: string
  link: string
}

export default defineComponent({
  name: "MenuHeader",
  computed: {
    items(): MenuItem[] {
      return [
        {
          link: '/objects/',
          name: 'Объекты'
        },
        {
          link: '/developers/',
          name: 'Застройщики'
        },
        {
          link: '/faq/',
          name: 'Помощь'
        },
      ];
    }
  }
})
</script>

<template>
  <ul class="menu-header">
    <li class="menu-header__item" v-for="item in items">
      <a class="menu-header__link" :href="item.link">{{ item.name }}</a>
    </li>
  </ul>
</template>

<style lang="scss">
@use "@/styles/system/variable" as *;

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
</style>
