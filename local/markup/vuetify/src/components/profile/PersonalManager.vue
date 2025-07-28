<script lang="ts">
import {defineComponent} from 'vue'

export default defineComponent({
  name: "PersonalManager"
})
</script>

<template>
  <v-card>
    <v-row>
      <v-col>
        <v-img/>
      </v-col>
      <v-col>
        <v-card-title>Елизавета Николаевна</v-card-title>
        <v-card-title>Ваш персональный менеджер</v-card-title>
      </v-col>
      <v-col>
        <v-btn elevation="0" variant="tonal">Связаться</v-btn>
      </v-col>
    </v-row>
  </v-card>
</template>

<style scoped>

</style>
