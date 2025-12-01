<script lang="ts">
import {defineComponent} from 'vue'
import type BuildObjectDto from "@/dto/entity/BuildObjectDto.ts";

export default defineComponent({
  name: "SliderObjects",
  props: {
    buildObjectList: {
      type: Array as PropType<BuildObjectDto[]>,
      default: () => [],
    }
  }
})
</script>

<template>

</template>

<style lang="scss">

</style>
