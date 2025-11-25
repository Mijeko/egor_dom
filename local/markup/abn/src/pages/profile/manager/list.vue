<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import ManagerList from "@/components/profile/manager/manager-list.vue";

export default defineComponent({
  name: "list",
  components: {ManagerList},
  props: {
    tableParams: {
      type: Object as PropType<any>
    }
  }
})
</script>

<template>
  <ManagerList
    :tableParams
  />
</template>

<style scoped>

</style>
