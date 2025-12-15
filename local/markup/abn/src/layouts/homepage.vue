<script lang="ts">
import {defineComponent} from 'vue'

export default defineComponent({
  name: "Homepage",
  props: {
    user:{}
  },
  created(): any {
    console.log(this.$props);
  }
})
</script>

<template>

</template>

<style lang="scss">

</style>
