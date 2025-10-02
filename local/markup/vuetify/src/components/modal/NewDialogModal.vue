<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import ChatService from "@/service/Chat/ChatService.ts";
import type SearchUserRequestDto from "@/dto/request/SearchUserRequest.ts";
import type SearchUserResponseDto from "@/dto/response/SearchUserResponseDto.ts";
import {da} from "vuetify/locale";
import type BxUserDto from "@/dto/bitrix/BxUserDto.ts";
import type FindDialogRequestDto from "@/dto/request/FindDialogRequestDto.ts";
import {useUserStore} from "@/store.ts";
import type FindChatResponseDto from "@/dto/response/FindChatResponseDto.ts";

export default defineComponent({
  name: "NewDialogModal",
  props: {
    modelValue: {
      type: Boolean,
      default: false
    },
    message: {
      type: String as PropType<any>,
    },
  },
  data: function () {
    return {
      currentUser: null as BxUserDto | null,
      users: null as BxUserDto[] | null,
      service: null as ChatService | null,
      isValid: false,
      isMessageValid: false,
      timer: 0,
      form: {
        source: null,
      },
      messageForm: {
        chatId: null as number | null,
        userId: null as number | null,
        text: null,
      },
      validate: {
        source: [
          (value: any) => {

            if (!value || value.length <= 0) {
              return false;
            }

            return true;
          }
        ]
      },
      validateMessageForm: {
        userId: [
          (value: number) => {

            if (!value || value <= 0) {
              return false;
            }

            return true;
          }
        ],
        text: [
          (value: any) => {

            if (!value || value.length <= 0) {
              return false;
            }

            return true;
          }
        ]
      },
    };
  },
  created(): any {
    this.service = new ChatService();
    let userStore = useUserStore();
    let user = userStore.getUser;

    if (user) {
      this.currentUser = user;
    }
  },
  methods: {
    searchUser() {
      if (!this.isValid) {
        return;
      }

      if (this.timer > 0) {
        clearTimeout(this.timer);
      }

      this.timer = setTimeout(() => {

        let body: SearchUserRequestDto = {
          source: String(this.form.source),
        };

        this.service?.searchUser(body).then((r: SearchUserResponseDto) => {
          let {data} = r;
          let {users} = data;

          if (users) {
            this.users = users;
          }
        });
      }, 1000);

    },
    startMessage(userId: number) {

      let body: FindDialogRequestDto = {
        userId: Number(this.currentUser?.id),
        acceptUserId: userId,
      };


      this.service?.findDialog(body).then((response: FindChatResponseDto) => {

        let {data, status} = response;
        let {chat} = data;

        if (status !== 'success') {
          return;
        }

        if (chat) {
          this.messageForm.chatId = chat.id;
        }

        this.messageForm.userId = userId;
      });


    },
    sendMessage() {
      if (!this.isMessageValid) {
        return;
      }

      this.$emit('update:message', {
        message: this.messageForm.text,
        userId: this.messageForm.userId,
        chatId: this.messageForm.chatId
      });
    },
  },
  computed: {
    showModalComputed: {
      get(): boolean {
        return this.modelValue;
      },
      set(value: boolean) {
        this.$emit('update:modelValue', value);
      }
    }
  }
})
</script>

<template>
  <v-dialog max-width="500" v-model="showModalComputed">

    <v-card title="Новый диалог">

      <v-card-text>

        <v-form v-model="isValid">
          <v-text-field
            placeholder="Номер телефона или e-mail или Фио"
            v-model="form.source"
            :rules="validate.source"
            @change="searchUser"
            @keyup.prevent="searchUser"
          />
        </v-form>

        <v-divider v-if="users" class="mb-4"/>

        <v-row
          v-for="user in users"
          class="mb-1 stream-chat"
        >
          <v-col cols="2">
            <v-avatar :image="user.avatar?.src"></v-avatar>
          </v-col>
          <v-col cols="8">
            <strong>{{ user.name }}</strong>
          </v-col>

          <v-col cols="2">
            <v-btn @click="startMessage(user.id)">+</v-btn>
          </v-col>
        </v-row>

        <v-divider v-if="messageForm.userId" class="mt-4"/>

        <v-form v-model="isMessageValid" @submit.prevent="sendMessage" v-if="messageForm.userId">
          <v-textarea v-model="messageForm.text"></v-textarea>
          <v-btn type="submit">Отправить</v-btn>
        </v-form>

        {{ messageForm }}

      </v-card-text>


    </v-card>

  </v-dialog>


</template>

<style scoped>

</style>
