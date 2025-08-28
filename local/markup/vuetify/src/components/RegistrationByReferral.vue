<script lang="ts">
import {defineComponent} from 'vue'
import PhoneInput from "@/components/html/PhoneInput.vue";
import CoreHelper from "@/service/CoreHelper.ts";
import ValidatePersonalData from "@/core/validate/ValidatePersonalData.ts";
import UserService from "@/service/User/UserService.ts";
import type RegisterByReferralRequestDto from "@/dto/request/RegisterByReferralRequestDto.ts";
import type RegisterStudentResponseDto from "@/dto/response/RegisterStudentResponseDto.ts";
import type {ComponentControllerApiErrorDto} from "@/dto/response/ComponentControllerApiResponseDto.ts";
import AlertService from "@/service/AlertService.ts";
import type RegisterByReferralResponseDto from "@/dto/response/RegisterByReferralResponseDto.ts";

export default defineComponent({
  name: "RegistrationByReferral",
  components: {PhoneInput},
  data: function () {
    return {
      isFormValid: false,
      form: {
        phone: '',
        email: '',
        password: '',
      },
      formRules: {
        email: [
          (value: string) => {
            if (value.length <= 0) {
              return 'Заполните email';
            }

            if (!CoreHelper.emailIsValid(value)) {
              return 'Неверный формат email';
            }

            return true;
          }
        ],
        phone: [
          (value: string) => {
            if (value.length <= 0) {
              return 'Заполните номер телефона';
            }

            return true;
          },
          ...ValidatePersonalData.phone
        ],
        password: ValidatePersonalData.password,
      },
    }
  },
  props: {
    referralCode: String,
  },
  methods: {
    doRegistration: function () {

      let body: RegisterByReferralRequestDto = {
        code: String(this.referralCode),
        phone: String(this.form.phone),
        email: String(this.form.email),
        password: String(this.form.password),
      }

      let service = new UserService();
      service.registerByReferral(body)
        .then((response: RegisterByReferralResponseDto) => {
          let {status, data} = response;
          let {redirect} = data;

          if (status === 'success' && redirect) {
            window.location.href = redirect;
          }
        }, function (errorResponse: ComponentControllerApiErrorDto) {
          let {data} = errorResponse;
          let {ajaxRejectData} = data;
          let {error} = ajaxRejectData;

          if (error.message) {
            AlertService.showErrorAlert('Регистрация', error.message);
          }
        });
    }
  }
})
</script>

<template>
  <v-form @submit.prevent="doRegistration" v-model="isFormValid">

    <PhoneInput
      v-model="form.phone"
      :rules="formRules.phone"
      label="Номер телефона"
    />
    <v-text-field
      v-model="form.email"
      :rules="formRules.email"
      label="E-mail адрес"
    />
    <v-text-field
      v-model="form.password"
      :rules="formRules.password"
      type="password"
      label="Пароль"
    />

    <v-row>
      <v-col cols="12">
        <v-btn type="submit">Зарегистрироваться</v-btn>
      </v-col>
    </v-row>
  </v-form>
</template>

<style scoped>

</style>
