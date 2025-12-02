<script lang="ts">
import {defineComponent} from 'vue'
import MenuService from "@/service/MenuService.ts";
import type MenuRequestDto from "@/dto/request/MenuRequestDto.ts";

export default defineComponent({
  name: "MenuBx",
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

    MenuService.getMenu(body).then((data: any) => {
      console.log(data);
    });
  }
})
</script>

<template>

</template>

<style lang="scss">

</style>
