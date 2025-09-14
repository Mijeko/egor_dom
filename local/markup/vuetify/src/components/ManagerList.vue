<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import type BxUserDto from "@/dto/bitrix/BxUserDto.ts";

export default defineComponent({
  name: "ManagerList",
  props: {
    managers: {
      type: Array as PropType<BxUserDto[]>,
      default: [],
    }
  },
  mounted(): any {
    console.log(this.managers);
  }
})
</script>

<template>
  <v-card class="pa-3 mb-3 mt-3" v-if="managers.length > 0" title="Менеджеры">
    <v-divider/>

    <v-card-text>
      <div class="mb-3" v-for="manager in managers">
        <v-avatar
          size="36px"
        >
          <v-img
            v-if="manager.avatar"
            alt="Avatar"
            src="https://avatars0.githubusercontent.com/u/9064066?v=4&s=460"
          ></v-img>

        </v-avatar>
      </div>
    </v-card-text>

    <v-divider/>

    <v-card-actions>
      <v-btn>Посмотреть всё</v-btn>
    </v-card-actions>

  </v-card>
</template>

<style scoped>

</style>
