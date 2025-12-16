<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import type BxUserDto from "@/dto/bitrix/BxUserDto.ts";
import {useUserStore} from "@/stores/app.ts";
import type MenuItemDto from "@/dto/present/MenuItemDto.ts";

export default defineComponent({
  name: "ProfileAsideMenu",
  props: {
    items: {
      type: Array as PropType<MenuItemDto[]>,
      default: []
    },
  },
})
</script>

<template>
  <v-card
    elevation="0"
  >
    <v-list
      :lines="false"
      density="compact"
      nav
    >
      <v-list-item
        v-for="(item, i) in items"
        :key="i"
        :value="item"
        color="primary"
        link
        :href="item.url"
        class="profile-aside-menu-item"
      >
        <template v-slot:prepend>
          <v-icon :icon="item.params?.ICON"></v-icon>
        </template>

        <v-list-item-title v-text="item.title"></v-list-item-title>
      </v-list-item>
    </v-list>
  </v-card>
</template>

<style lang="scss">
.profile-aside-menu {
  &-item {
    margin-top: 10px !important;

    .v-list-item__spacer {
      width: 5px !important;
    }

    .v-list-item__prepend {
      margin-right: 10px !important;
    }
  }
}
</style>
