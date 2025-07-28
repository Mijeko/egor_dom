<script lang="ts">
import {defineComponent} from 'vue'
import type AuthorizeDto from "@/dto/request/AuthorizeDto.ts";
import UserService from "@/service/User/UserService.ts";
import AlertService from "@/service/AlertService.ts";
import ValidatePersonalData from "@/core/validate/ValidatePersonalData.ts";
import MaskInput from "@/components/part/form/MaskInput.vue";

export default defineComponent({
  name: "Auth",
  components: {MaskInput},
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
  <div class="mt-16 w-75 w-md-50 ml-auto mr-auto">
    <h1 class="mb-3">Войти на сайт</h1>
    <v-form @submit.prevent="auth" v-model="isValid">

      <MaskInput
        v-model="form.phone"
        :rules="validate.phone"
        label="Номер телефона"
      />

<!--      <v-text-field-->
<!--        v-model="form.phone"-->
<!--        :rules="validate.phone"-->
<!--        label="Номер телефона"-->
<!--      />-->
      <v-text-field
        v-model="form.password"
        :rules="validate.password"
        type="password"
        label="Пароль"
      />
      <v-row>
        <v-col cols="6" md="2">
          <v-btn type="submit">Войти</v-btn>
        </v-col>
        <v-col cols="6" md="2">
          <a href="?register=yes">Регистрация</a>
        </v-col>
      </v-row>
    </v-form>
  </div>
</template>

<style scoped>

</style>
