<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import Table from "@/components/table.vue";

export default defineComponent({
  name: "StudentList",
  components: {Table},
  props: {
    tableParams: {
      type: Object as PropType<any>
    }
  },
})
</script>


<template>
  <Table
    :header="tableParams?.header"
    :records="tableParams?.records"
  />
</template>

<style scoped>

</style>
