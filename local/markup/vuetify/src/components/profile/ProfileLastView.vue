<script lang="ts">
import {defineComponent} from 'vue'

export default defineComponent({
  name: "ProfileLastView",
  data: function () {
    return {
      items: [
        'Трёшка',
        'Двушка',
        'Однушка',
      ]
    }
  }
})
</script>

<template>
  <v-card title="Просмотренные квартиры" v-if="items.length > 0">
    <v-divider/>

    <v-card-text>
      <div class="mb-3" v-for="item in items" v-html="item"></div>
    </v-card-text>
    <v-divider/>

    <v-card-actions>
      <v-btn>Посмотреть всё</v-btn>
    </v-card-actions>
  </v-card>
</template>

<style scoped>

</style>
