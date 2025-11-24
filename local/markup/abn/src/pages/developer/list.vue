<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import DeveloperList from "@/components/developer/DeveloperList.vue";
import DeveloperListItemDto from "@/dto/entity/DeveloperListItemDto.ts";

export default defineComponent({
  name: "list",
  components: {DeveloperList},
  props: {
    developers: {
      type: Array as PropType<DeveloperListItemDto[]>
    }
  }
})
</script>

<template>
  <DeveloperList
    :developers
  />
</template>

<style scoped>

</style>
