<script lang="ts">
import {defineComponent} from 'vue'
import type AuthorizeDto from "@/dto/request/AuthorizeDto.ts";
import UserService from "@/service/User/UserService.ts";
import AlertService from "@/service/AlertService.ts";
import ValidatePersonalData from "@/core/validate/ValidatePersonalData.ts";

export default defineComponent({
  name: "Auth",
  data: () => {
    return {
      form: {
        phone: '',
        password: '',
      },
      isValid: false,
      validate: {
        phone: ValidatePersonalData.phone,
        password: [
          (value: string) => {
            if (value.length <= 0) {
              return 'Введите пароль';
            }
            return true;
          }
        ],
      },
    };
  },
  methods: {
    auth: function () {

      if (!this.isValid) {
        return;
      }

      let service = new UserService();
      service.authorize({
        phone: this.form.phone,
        password: this.form.password,
      } as AuthorizeDto)
        .then((response: any) => {
          let {data} = response;
          let {success, redirect, error} = data;

          if (success) {
            if (redirect) {
              window.location.href = redirect;
            }
          } else if (!success && error) {
            AlertService.showErrorAlert('Авторизация', error);
          }
        });


      return true;
    }
  }
})
</script>

<template>
  <v-form @submit.prevent="auth" v-model="isValid">
    <v-text-field
      v-model="form.phone"
      :rules="validate.phone"
      label="Номер телефона"
    />
    <v-text-field
      v-model="form.password"
      :rules="validate.password"
      type="password"
      label="Пароль"
    />
    <v-row>
      <v-col cols="2">
        <v-btn type="submit">Войти</v-btn>
      </v-col>
      <v-col cols="2">
        <a href="?register=yes">Регистрация</a>
      </v-col>
    </v-row>
  </v-form>
</template>

<style scoped>

</style>
