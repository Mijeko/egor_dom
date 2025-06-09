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
        <v-row>
          <v-col md="3">
            <v-img :src="developer.picture"></v-img>
          </v-col>
          <v-col md="9">
            <v-card-text>{{ developer.name }}</v-card-text>
          </v-col>
        </v-row>
      </v-card>
    </v-container>
  </v-app>
</template>

<style scoped>

</style>
