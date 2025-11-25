<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import type BxUserDto from "@/dto/bitrix/BxUserDto.ts";
import ManagerEdit from "@/components/profile/manager/manager-edit.vue";

export default defineComponent({
  name: "detail",
  components: {ManagerEdit},
  props: {
    manager: {
      type: Object as PropType<BxUserDto>,
      default: () => {
      }
    }
  }
})
</script>

<template>
  <ManagerEdit
    :manager
  />
</template>

<style scoped>

</style>
