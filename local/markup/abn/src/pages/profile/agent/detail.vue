<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import AgentEdit from "@/components/profile/agent/agent-edit.vue";
import type BxUserDto from "@/dto/bitrix/BxUserDto.ts";
import type ClaimDto from "@/dto/entity/ClaimDto.ts";
import Profile from "@/layouts/profile.vue";

export default defineComponent({
  name: "detail",
  components: {AgentEdit},
  layout: [Profile],
  props: {
    agent: {
      type: Object as PropType<BxUserDto>,
      default: null
    },
    orders: {
      type: Array as PropType<ClaimDto[]>,
      default: null
    }
  },
})
</script>

<template>
  <AgentEdit
    :agent
    :orders
  />
</template>

<style scoped>

</style>
