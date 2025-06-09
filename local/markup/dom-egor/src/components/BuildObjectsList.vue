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
        <v-row>
          <v-col md="3">
            <v-img src=""></v-img>
          </v-col>
          <v-col md="6">
            <v-card-text>{{ buildObject.name }}</v-card-text>
          </v-col>
          <v-col md="3">
            <v-btn>Купить</v-btn>
          </v-col>
        </v-row>
      </v-card>
    </v-container>
  </v-app>
</template>

<style scoped>

</style>
