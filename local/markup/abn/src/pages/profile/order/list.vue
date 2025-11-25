<script lang="ts">
import {defineComponent} from 'vue'
import ClaimList from "@/components/profile/order/claim-list.vue";
import type ClaimDto from "@/dto/entity/ClaimDto.ts";

export default defineComponent({
  name: "orders",
  components: {ClaimList},
  props: {
    orders: {
      type: Array as PropType<ClaimDto[]>,
      default: () => []
    }
  }
})
</script>

<template>
  <ClaimList
    :claims="orders"
  />
</template>

<style scoped>

</style>
