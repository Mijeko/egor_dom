<script lang="ts">
import {defineComponent} from 'vue'
import ClaimList from "@/components/profile/order/claim-list.vue";
import type ClaimDto from "@/dto/entity/ClaimDto.ts";
import Profile from "@/layouts/profile.vue";

export default defineComponent({
  name: "orders",
  components: {ClaimList},
  layout: [Profile],
  props: {
    orders: {
      type: Array as PropType<ClaimDto[]>,
      default: () => []
    }
  }
})
</script>

<template>
  {{orders}}
  <ClaimList
    :claims="orders"
  />
</template>

<style scoped>

</style>
