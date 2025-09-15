<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import Table from "@/components/system/Table.vue";

export default defineComponent({
  name: "ManagerList",
  components: {Table},
  props: {
    tableParams: {
      type: Object as PropType<any>
    }
  },
  mounted(): any {
    console.log('ListManager', this.tableParams);
  }
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
