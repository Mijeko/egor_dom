<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import AgentList from "@/components/profile/agent/agent-list.vue";
import Profile from "@/layouts/profile.vue";

export default defineComponent({
  name: "list",
  components: {AgentList},
  layout: [Profile],
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
