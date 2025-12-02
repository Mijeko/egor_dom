<script lang="ts">
import {defineComponent} from 'vue'
import MenuService from "@/service/MenuService.ts";
import type MenuRequestDto from "@/dto/request/MenuRequestDto.ts";
import type MenuItemDto from "@/dto/present/MenuItemDto.ts";
import type MenuResponseDto from "@/dto/response/MenuResponseDto.tsx";

export default defineComponent({
  name: "MenuBx",
  data: () => {
    return {
      items: [] as MenuItemDto[]
    };
  },
  props: {
    typeMenu: {
      type: String,
      default: null,
    }
  },
  created(): any {
    let body: MenuRequestDto = {
      typeMenu: this.typeMenu,
      dir: window.location.pathname,
    };

    MenuService.getMenu(body).then((response: MenuResponseDto) => {
      if (response.data) {
        this.items = response.data;
      }
    });
  }
})
</script>

<template>
  <slot name="items" :items="items"></slot>
</template>

<style lang="scss">

</style>
