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
    <v-row>
      <v-col>
        <v-avatar :image="user.avatar"/>
      </v-col>
      <v-col>
        <v-card-title>{{ user.fullName }}</v-card-title>
        <v-card-subtitle>{{ user.email }}</v-card-subtitle>
      </v-col>
      <v-col>
        <v-btn href="settings/">Редактировать</v-btn>
      </v-col>
    </v-row>
  </v-card>
</template>

<style scoped>

</style>
