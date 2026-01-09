<script lang="ts">
import {defineComponent} from 'vue'

export default defineComponent({
  name: "BlockParams",
  props: {
    label: {
      type: String,
      default: () => null
    }
  }
})
</script>

<template>
  <v-divider>{{ label }}</v-divider>
  <slot></slot>
  <v-divider></v-divider>
</template>

<style lang="scss">

</style>
