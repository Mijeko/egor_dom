<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import StudentList from "@/components/student/StudentList.vue";
import Profile from "@/layouts/profile.vue";

export default defineComponent({
  name: "list",
  components: {StudentList},
  layout: [Profile],
  props: {
    tableParams: {
      type: Object as PropType<any>
    }
  },
})
</script>

<template>
  <StudentList
    :tableParams
  />
</template>

<style scoped>

</style>
