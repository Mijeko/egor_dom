<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import ChatService from "@/service/Chat/ChatService.ts";

import type ChatMessageDto from "@/dto/request/ChatMessageDto.ts";
import type ChatDto from "@/dto/entity/ChatDto.ts";
import type BxUserDto from "@/dto/bitrix/BxUserDto.ts";
import {useUserStore} from "@/store.ts";

export default defineComponent({
  emits: ['update:chats'],
  name: "Stream",
  props: {
    chats: {
      type: Array as PropType<ChatDto[]>,
      default: [],
    }
  },
  data: function () {
    return {
      chatsData: null as ChatDto[] | null,
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
    isCheck(id: number) {
      return this.currentDialog?.id === id;
    },
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
          this.chatsComp = chats;
        }

      }
    });

    let userStore = useUserStore();
    let user = userStore.getUser;

    if (user) {
      this.currentUser = user;
    }
  },
  computed: {
    chatsComp: {
      get(): ChatDto[] {
        if (this.chatsData) {
          return this.chatsData;
        }

        return this.chats;
      },
      set(chats: ChatDto[]) {
        this.chatsData = chats;
      },
    }
  },
  watch: {
    chatsComp: {
      handler: function (nV, oV) {
        if (this.currentDialog) {

          let chat = nV.filter((d: any) => {
            return this.currentDialog?.id === d?.id;
          }).shift();

          if (chat) {
            this.currentDialog = chat;
          }

        }
      },
      deep: true,
    },
  }
})
</script>

<template>
  <div class="stream">
    <div class="stream-aside">
      <v-row
        v-for="chat in chatsComp"
        :class="`mb-1 stream-chat` + (isCheck(chat.id) ? 'active':'')"
        @click.prevent="selectDialog(chat)"
      >
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

  &-chat {
    cursor: pointer;
    transition: 0.4s ease all;

    &.active, &:hover {
      background: rgba(0, 0, 0, 0.02);
    }
  }

  &-aside {
    padding: 15px;
    max-width: 30%;
    width: 100%;
    border-right: 1px grey solid;
  }

  &-body {
    width: 100%;
  }

  &-messages {
    overflow-y: scroll;
    max-height: 300px;
  }
}
</style>
