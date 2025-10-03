<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import WsChatService from "@/service/Chat/WsChatService.ts";

import type ChatMessageDto from "@/dto/request/ChatMessageDto.ts";
import type ChatDto from "@/dto/entity/ChatDto.ts";
import type BxUserDto from "@/dto/bitrix/BxUserDto.ts";
import {useUserStore} from "@/store.ts";
import NewDialogModal from "@/components/modal/NewDialogModal.vue";
import type ChatMemberDto from "@/dto/entity/ChatMemberDto.ts";

export default defineComponent({
  name: "Stream",
  components: {NewDialogModal},
  props: {
    chats: {
      type: Array as PropType<ChatDto[]>,
      default: [],
    }
  },
  data: function () {
    return {
      modal: {
        newDialogModal: false
      },
      chatsData: null as ChatDto[] | null,
      currentUser: null as BxUserDto | null,
      currentDialog: null as ChatDto | null,
      service: null as WsChatService | null,
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
      },
      newMessage: null,
    };
  },
  methods: {
    accepted(members: ChatMemberDto[]): ChatMemberDto | null {

      let memberList: ChatMemberDto[] = members.filter((member: ChatMemberDto) => {
        return member.userId !== this.currentUser?.id;
      });

      if (memberList.length == 1) {
        let acceptMember = memberList.shift();
        if (acceptMember) {
          return acceptMember;
        }
      }

      return null;

    },
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

      (this.service as WsChatService).sendMessage(
        {
          chatId: this.currentDialog?.id,
          sendUserId: this.currentUser?.id,
          acceptUserId: this.currentDialog?.acceptUserId,
          message: String(this.form.message)
        } as ChatMessageDto
      );

    },
    newDialogModal() {
      this.modal.newDialogModal = true;
    },
  },
  created(): any {
    console.log(this.chats);


    this.service = new WsChatService({
      host: "ws://dom.local/ws/",
      callback: (e: any) => {
        let data: any = null;
        try {
          data = JSON.parse(e.data);
        } catch (err) {
          data = e.data;
        }

        let chats: ChatDto[] = data?.chats as ChatDto[];

        chats = chats.filter((chat: ChatDto) => {

          let chatIdList = chat.members.map((member: ChatMemberDto) => {
            return member.userId;
          });

          return chatIdList.includes(Number(this.currentUser?.id));
        });

        if (chats) {
          this.chatsComputed = chats;
        }

        this.form.message = null;

      }
    });

    let userStore = useUserStore();
    let user = userStore.getUser;

    if (user) {
      this.currentUser = user;
    }
  },
  computed: {
    chatsComputed: {
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
    newMessage: {
      handler: function (newValue: { message: string, userId: number, chatId: number }, oV) {
        (this.service as WsChatService).sendMessage(
          {
            sendUserId: this.currentUser?.id,
            acceptUserId: newValue.userId,
            message: String(newValue.message),
            chatId: Number(newValue.chatId),
          } as ChatMessageDto
        );
      },
      deep: true,
    },
    chatsComputed: {
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

      <v-btn @click.prevent="newDialogModal" class="mb-4">Новый диалог</v-btn>
      <v-divider class="mb-6"/>
      <NewDialogModal
        v-model="modal.newDialogModal"
        v-model:message="newMessage"
      />

      <v-row
        v-for="chat in chatsComputed"
        :class="`mb-1 stream-chat` + (isCheck(chat.id) ? 'active':'')"
        @click.prevent="selectDialog(chat)"
      >
        <v-col cols="2">
          <v-avatar
            v-if="accepted(chat.members)"
            :image="accepted(chat.members)?.avatar?.src ?? ''"
          />
        </v-col>
        <v-col cols="10">
          <strong>{{ (accepted(chat.members) as BxUserDto)?.name }}</strong>
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
    min-height: 300px;
    max-height: 300px;
  }
}
</style>
