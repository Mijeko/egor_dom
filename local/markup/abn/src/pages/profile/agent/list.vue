<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import AgentList from "@/components/profile/agent/agent-list.vue";

export default defineComponent({
  name: "list",
  components: {AgentList},
  props: {
    tableParams: {
      type: Object as PropType<any>
    }
  }
})
</script>

<template>
  <AgentList
    :table-params
  />
</template>

<style scoped>

</style>
