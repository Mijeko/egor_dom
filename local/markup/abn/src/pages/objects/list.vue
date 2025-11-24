<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import BuildObjectList from "@/components/objects/BuildObjectList.vue";
import type BuildObjectDto from "@/dto/entity/BuildObjectDto.ts";

export default defineComponent({
  name: "list",
  components: {BuildObjectList},
  props: {
    buildObjects: {
      type: Array as PropType<BuildObjectDto[]>
    }
  },
})
</script>

<template>
  <BuildObjectList
    :buildObjects
  />
</template>

<style scoped>

</style>
