<script>
import {defineComponent} from 'vue'

export default defineComponent({
  name: "ListClaims",
  props: {
    claims: []
  }
})
</script>

<template>
  <v-app>
    <v-card v-for="claim in claims">
      <v-card-text>{{ claim.name }}</v-card-text>
    </v-card>
  </v-app>
</template>

<style scoped>

</style>
