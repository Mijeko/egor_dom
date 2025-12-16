<script lang="ts">
import {defineComponent} from 'vue'

export default defineComponent({
  name: "Homepage",
})
</script>

<template>
  <div class="stronger">
    <div class="page-content">
      <slot/>
    </div>

    <AppFooter/>
  </div>
</template>

<style lang="scss">

</style>
