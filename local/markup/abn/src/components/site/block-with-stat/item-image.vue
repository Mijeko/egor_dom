<script lang="ts">
import {defineComponent} from 'vue'

export default defineComponent({
  name: "item-image",
  props: {
    src: {
      type: String,
      default: null,
    }
  }
})
</script>

<template>
  <div class="developer-page-statistic-item img">
    <img
      :src="src"
      alt=""
      class="developer-page-statistic-item__image"
    >
  </div>
</template>

<style lang="scss">

</style>
