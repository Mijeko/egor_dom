<script>
import {defineComponent} from 'vue'

export default defineComponent({
  name: "BuildObjectsList",
  props: {
    BuildObjects: []
  }
})
</script>

<template>
  <v-app>
    <v-container>
      Квартиры

      <v-card v-for="buildObject in BuildObjects">
        <v-card-text>{{ buildObject.name }}</v-card-text>
      </v-card>
    </v-container>
  </v-app>
</template>

<style scoped>

</style>
