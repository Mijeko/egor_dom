<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import type ManagerEditDescriptionItemDto from "@/dto/present/component/ManagerEditDescriptionItemDto.ts";

export default defineComponent({
  name: "GuestUserInformation",
  props: {
    profileName: {
      type: String,
    },
    profileAvatar: {
      type: String,
    },
    listInfo: {
      type: Array as PropType<ManagerEditDescriptionItemDto[]>
    }
  }
})
</script>

<template>
  <v-card>
    <v-img
      :src="profileAvatar"
      class="align-end"
      gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5)"
      height="400px"
      cover
    >
      <v-card-title class="text-white" v-text="profileName"></v-card-title>
    </v-img>
  </v-card>

  <v-card class="mt-5">
    <v-list lines="two">
      <v-list-item
        :key="index"
        :title="item.label"
        :subtitle="item.value"
        v-for="(item,index) in listInfo"
      ></v-list-item>
    </v-list>
  </v-card>
</template>

<style scoped>

</style>
