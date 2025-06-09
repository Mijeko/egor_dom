<script>
import {defineComponent} from 'vue'

export default defineComponent({
  name: "Developers",
  props: {
    developers: []
  }
})
</script>

<template>
  <v-app>
    <v-container>
      Застройщики

      <v-card v-for="developer in developers">
        <v-card-text>{{ developer.name }}</v-card-text>
      </v-card>
    </v-container>
  </v-app>
</template>

<style scoped>

</style>
