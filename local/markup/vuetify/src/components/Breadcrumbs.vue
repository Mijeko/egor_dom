<script>
import {defineComponent} from 'vue'

export default defineComponent({
  name: "Breadcrumbs",
  props: {
    items: []
  },
})
</script>

<template>
  <v-breadcrumbs :items="items" class="mb-5 px-0 pt-0">
    <template v-slot:prepend>
      <v-icon icon="$vuetify" size="small"></v-icon>
    </template>
  </v-breadcrumbs>
</template>

<style scoped>

</style>
