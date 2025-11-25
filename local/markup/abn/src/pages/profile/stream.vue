<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import Chat from "@/components/profile/chat/chat.vue";
import type ChatDto from "@/dto/entity/ChatDto.ts";

export default defineComponent({
  name: "stream",
  components: {Chat},
  props: {
    chats: {
      type: Array as PropType<ChatDto[]>,
      default: [],
    }
  },
})
</script>

<template>
  <Chat
    :chats
  />
</template>

<style scoped>

</style>
