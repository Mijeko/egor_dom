<script lang="ts">
import {defineComponent} from 'vue'

export default defineComponent({
  name: "ItemWithIcon",
  props: {
    iconSrc: {
      type: String,
      default: null,
    }
  }
})
</script>

<template>
  <div class="developer-page-statistic-item">
    <div class="block-with-icon">
      <div class="block-with-icon-icon-wrap">
        <img :src="iconSrc" alt="Иконка">
      </div>
      <div class="block-with-icon-text">
        <slot/>
      </div>
    </div>
  </div>
</template>

<style lang="scss">

</style>
