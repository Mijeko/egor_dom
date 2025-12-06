<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import ManagerList from "@/components/profile/manager/manager-list.vue";
import Profile from "@/layouts/profile.vue";

export default defineComponent({
  name: "list",
  components: {ManagerList},
  layout: [Profile],
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
