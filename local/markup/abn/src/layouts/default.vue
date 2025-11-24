<script lang="ts">
import {defineComponent} from 'vue'

export default defineComponent({
  name: "default"
})
</script>

<template>

  <div class="stronger">
<!--    <AppHeader/>-->


    <div class="page-content">

      <div class="container">
        <slot/>
      </div>
    </div>

<!--    <AppFooter/>-->
  </div>
</template>

<style scoped>

</style>
