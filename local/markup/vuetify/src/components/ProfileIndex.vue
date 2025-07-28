<script lang="ts">
import {defineComponent} from 'vue'
import ShortOrderInfo from "@/components/profile/ShortOrderInfo.vue";
import PersonalManager from "@/components/profile/PersonalManager.vue";

export default defineComponent({
  name: "ProfileIndex",
  components: {PersonalManager, ShortOrderInfo}
})
</script>

<template>

  <PersonalManager/>
  <v-divider></v-divider>

  <ShortOrderInfo/>
  <v-divider></v-divider>

  немного про настройки
  <v-divider></v-divider>

  немного про обучение
</template>

<style scoped>

</style>
