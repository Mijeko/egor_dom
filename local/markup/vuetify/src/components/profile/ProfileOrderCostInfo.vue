<script lang="ts">
import {defineComponent, type PropType} from 'vue'

export default defineComponent({
  name: "ProfileOrderCostInfo",
  props: {
    items: {
      type: Array as PropType<string[]>,
      default: []
    }
  },
})
</script>

<template>
  <v-card title="Информация о сделках" v-if="items.length > 0">
    <v-divider/>

    <v-card-text>
      <div class="mb-3" v-for="item in items" v-html="item"></div>
    </v-card-text>
    <v-divider/>

    <v-card-actions>
      <v-btn href="orders/">Подробнее</v-btn>
    </v-card-actions>
  </v-card>
</template>

<style scoped>

</style>
