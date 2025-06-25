<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import type BxUserDto from "@/dto/bitrix/BxUserDto.ts";
import {useUserStore} from "@/store.ts";

export default defineComponent({
  name: "Init",
  props: {
    user: {
      type: Object as PropType<BxUserDto>
    }
  },
  mounted(): any {
    let store = useUserStore();
    store.updateInfo(this.user as BxUserDto);
  },
})
</script>

<template>

</template>

<style scoped>

</style>
