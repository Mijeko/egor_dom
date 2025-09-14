<script lang="ts">
import {defineComponent} from 'vue'
import {useUserStore} from "@/store.ts";
import type BxUserDto from "@/dto/bitrix/BxUserDto.ts";

export default defineComponent({
  name: "ProfileShortInfo",
  data: function () {
    return {
      user: {} as BxUserDto
    };
  },
  mounted(): any {
    let userStore = useUserStore();
    let user = userStore.getUser;
    if (user) {
      this.user = user;
    }
  }
})
</script>

<template>
  <v-card class="mb-3" v-if="user.id">
    <v-row class="pa-4">
      <v-col cols="1" >
        <v-avatar size="80" :image="String(user.avatar?.src)"/>
      </v-col>
      <v-col cols="8">
        <v-card-title>{{ user.fullName }}</v-card-title>
        <v-card-subtitle v-if="user.position">{{ user.position }}</v-card-subtitle>
      </v-col>
      <v-col cols="3">
        <v-btn href="settings/" class="mt-5">Редактировать</v-btn>
      </v-col>
    </v-row>
  </v-card>
</template>

<style scoped>

</style>
