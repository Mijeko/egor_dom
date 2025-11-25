<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import type {ClaimStatus} from "@/dto/entity/ClaimDto.ts";

export default defineComponent({
  name: "ClaimStatus",
  props: {
    status: {
      type: Object as PropType<ClaimStatus>,
      default: null
    }
  }
})
</script>

<template>
  <v-chip :base-color="status.color" variant="outlined" :prepend-icon="status.icon">
    {{ status.label }}
  </v-chip>
</template>

<style scoped>

</style>
