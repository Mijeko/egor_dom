<script lang="ts">
import {defineComponent} from 'vue'
import type AuthorizeDto from "@/dto/AuthorizeDto.ts";
import UserService from "@/service/User/UserService.ts";

export default defineComponent({
  name: "Auth",
  data: () => {
    return {
      form: {
        phone: '',
        password: '',
      }
    };
  },
  methods: {
    auth: function () {
      let service = new UserService();

      service.authorize({
        phone: this.form.phone,
        password: this.form.password,
      } as AuthorizeDto)
        .then((data: any) => {
          let {result} = data;
          let {success, redirect} = result;

          if (success) {
            if (redirect) {
              window.location.href = redirect;
            }
          }
        });


      return true;
    }
  }
})
</script>

<template>
  <v-form @submit.prevent="auth">
    <v-text-field v-model="form.phone" label="Номер телефона"/>
    <v-text-field v-model="form.password" type="password" label="Пароль"/>
    <v-btn type="submit">Войти</v-btn>
  </v-form>
</template>

<style scoped>

</style>
