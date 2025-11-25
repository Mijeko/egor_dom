<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import ClaimDetail from "@/components/profile/order/claim-detail.vue";
import type ClaimDto from "@/dto/entity/ClaimDto.ts";

export default defineComponent({
  name: "detail",
  components: {ClaimDetail},
  props: {
    claim: {
      type: Object as PropType<ClaimDto>,
      default: null
    },
  },
})
</script>

<template>
  <ClaimDetail
    :claim
  />
</template>

<style scoped>

</style>
