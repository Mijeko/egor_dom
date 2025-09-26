<script lang="ts">
import {defineComponent} from 'vue'
import ChatService from "@/service/Chat/ChatService.ts";
import type ChatMessageDto from "@/dto/chat/ChatMessageDto.ts";

export default defineComponent({
  name: "Stream",
  data: function () {
    return {
      service: null as ChatService | null,
      profiles: [
        {name: 'Jonh Derek', avatar: 'https://avatars0.githubusercontent.com/u/9064066?v=4&s=460'},
        {name: 'Jonh Derek', avatar: 'https://avatars0.githubusercontent.com/u/9064066?v=4&s=460'},
        {name: 'Jonh Derek', avatar: 'https://avatars0.githubusercontent.com/u/9064066?v=4&s=460'},
        {name: 'Jonh Derek', avatar: 'https://avatars0.githubusercontent.com/u/9064066?v=4&s=460'},
        {name: 'Jonh Derek', avatar: 'https://avatars0.githubusercontent.com/u/9064066?v=4&s=460'},
      ],
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
    submit() {

      if (!this.isValid) {
        return;
      }

      (this.service as ChatService).sendMessage(
        {
          sendUserId: 1,
          acceptUserId: 2,
          message: String(this.form.message)
        } as ChatMessageDto
      );

    }
  },
  created(): any {
    this.service = new ChatService();
  },
})
</script>

<template>
  <div class="stream">
    <div class="stream-aside">
      <v-row v-for="profile in profiles" class="mb-1">
        <v-col cols="2">
          <v-avatar :image="profile.avatar"></v-avatar>
        </v-col>
        <v-col cols="10">
          <strong>{{ profile.name }}</strong>
        </v-col>
      </v-row>
    </div>
    <div class="stream-body">
      <div class="stream-messages"></div>
      <v-form @submit.prevent="submit" v-model="isValid" class="stream-form">
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
}
</style>
