<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import type AsideMenuItemDto from "@/dto/present/AsideMenuItemDto.ts";
import type BxUserDto from "@/dto/bitrix/BxUserDto.ts";
import {useUserStore} from "@/store.ts";

export default defineComponent({
  name: "ProfileAsideMenu",
  props: {
    items: {
      type: Array as PropType<AsideMenuItemDto[]>,
      default: []
    },
  },
  data: function () {
    return {
      user: {} as BxUserDto
    };
  },
  mounted(): any {
    let userStore = useUserStore();
    let user = userStore.getUser;
    console.log(user);
    if (user) {
      this.user = user;
    }
  }
})
</script>

<template>

  <v-card
    elevation="0"
  >
    <v-list>
      <v-list-item
        :prepend-avatar="String(user.avatar?.src)"
        :subtitle="user.email"
        :title="user.name"
      >
        <template v-slot:append>
          <v-btn
            icon="mdi-menu-down"
            size="small"
            variant="text"
          ></v-btn>
        </template>
      </v-list-item>
    </v-list>

    <v-divider></v-divider>

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
        :href="item.href"
      >
        <template v-slot:prepend>
          <v-icon :icon="item.icon"></v-icon>
        </template>

        <v-list-item-title v-text="item.title"></v-list-item-title>
      </v-list-item>
    </v-list>
  </v-card>


  <!--  <v-list nav tile>-->
  <!--    <v-list-item v-for="menuItem in items" link :to="menuItem.href">-->
  <!--      &lt;!&ndash;      <v-icon color="black">$badgeAccountHorizontalOutline</v-icon>&ndash;&gt;-->
  <!--      <v-icon color="black">+</v-icon>-->
  <!--      <v-list-item-title>{{ menuItem.title }}</v-list-item-title>-->
  <!--    </v-list-item>-->
  <!--  </v-list>-->
</template>

<style scoped>

</style>
