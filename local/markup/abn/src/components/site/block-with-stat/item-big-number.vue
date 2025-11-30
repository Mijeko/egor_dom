<script lang="ts">
import {defineComponent} from 'vue'

export default defineComponent({
  name: "ItemBigNumber"
})
</script>

<template>
  <div class="developer-page-statistic-item">
    <div class="block-with-stat">
      <div class="block-with-stat-heading">
        <slot name="heading"/>
      </div>

      <div class="block-with-stat-text">
        <slot name="text" />
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>
