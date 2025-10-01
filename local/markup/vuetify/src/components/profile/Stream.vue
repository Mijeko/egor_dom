<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import ChatService from "@/service/Chat/ChatService.ts";

import type ChatMessageDto from "@/dto/request/ChatMessageDto.ts";
import type ChatDto from "@/dto/entity/ChatDto.ts";
import type BxUserDto from "@/dto/bitrix/BxUserDto.ts";
import {useUserStore} from "@/store.ts";

export default defineComponent({
  emits: ['update:chats', 'update:tt'],
  name: "Stream",
  props: {
    tt: {
      type: Number,
      default: 1,
    },
    chats: {
      type: Array as PropType<ChatDto[]>,
      default: [],
    }
  },
  data: function () {
    return {
      currentUser: null as BxUserDto | null,
      currentDialog: null as ChatDto | null,
      service: null as ChatService | null,
      isValid: false,
      form: {
        message: null,
      },
      validate: {
        message: [
          (value: string) => {
            if (value && value.length > 0) {
              return true;
            }

            return 'Введите текст сообщения';
          }
        ]
      }
    };
  },
  methods: {
    selectDialog(chat: ChatDto) {
      this.currentDialog = chat;
    },
    submit() {

      if (!this.isValid) {
        return;
      }

      (this.service as ChatService).sendMessage(
        {
          sendUserId: this.currentUser?.id,
          acceptUserId: this.currentDialog?.acceptUserId,
          message: String(this.form.message)
        } as ChatMessageDto
      );

    }
  },
  created(): any {
    this.service = new ChatService({
      host: "ws://dom.local/ws/",
      callback: (e: any) => {
        let data: any = null;
        try {
          data = JSON.parse(e.data);
        } catch (err) {
          data = e.data;
        }

        let chats: ChatDto[] = data?.chats as ChatDto[];

        if (chats) {
          console.log('emit');
          this.$emit('update:tt', 1212121212122112);
          this.$emit('update:chats', chats);
        }

      }
    });

    let userStore = useUserStore();
    let user = userStore.getUser;

    if (user) {
      this.currentUser = user;
    }
  },
  watch: {
    tt: {
      handler: function (nV, oV) {
        console.log('tt changed');
      },
      deep: true,
    },
    chats: {
      handler: function (nV, oV) {
        console.log('chats cnahged');
      },
      deep: true,
    },
  }
})
</script>

<template>
  <div class="stream">
    <div class="stream-aside">
      {{ tt }}
      <v-row v-for="chat in chats" class="mb-1" @click.prevent="selectDialog(chat)">
        <v-col cols="2">
          <v-avatar :image="chat.acceptMember.avatar"></v-avatar>
        </v-col>
        <v-col cols="10">
          <strong>{{ chat.acceptMember.name }}</strong>
        </v-col>
      </v-row>
    </div>
    <div class="stream-body">
      <div class="stream-messages">
        <v-row v-for="message in currentDialog?.messages">
          <v-col>{{ message.text }}</v-col>
        </v-row>
      </div>
      <v-form v-if="currentDialog !== null" @submit.prevent="submit" v-model="isValid" class="stream-form">
        <v-textarea v-model="form.message" :rules="validate.message"></v-textarea>
        <v-btn type="submit">Отправить</v-btn>
      </v-form>
    </div>
  </div>
</template>

<style lang="scss">
.stream {
  display: flex;
  gap: 10px;

  &-aside {
    max-width: 30%;
    width: 100%;
    border-right: 1px grey solid;
  }

  &-body {
    width: 100%;
  }

  &-messages {
    overflow: scroll;
    max-height: 300px;
  }
}
</style>
