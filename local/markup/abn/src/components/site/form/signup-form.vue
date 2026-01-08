<script lang="ts">
import {defineComponent} from 'vue'
import BaseInput from "@/components/site/form/modern/base-input.vue";
import ModernPassword from "@/components/site/form/modern/modern-password.vue";
import ModernPhone from "@/components/site/form/modern/modern-phone.vue";
import UserService from "@/service/User/UserService.ts";
import type RegisterRequestDto from "@/dto/request/RegisterRequestDto.ts";
import WithSocial from "@/components/site/with-social.vue";
import ValidatePersonalData from "@/core/validate/validate-personal-data.ts";
import ModernEmail from "@/components/site/form/modern/modern-email.vue";

export default defineComponent({
  name: "SignupForm",
  components: {ModernEmail, WithSocial, ModernPhone, ModernPassword: ModernPassword, ModernInput: BaseInput},
  data: function () {
    return {
      isFormValid: false,
      form: {
        phone: null,
        email: null,
        password: null,
        agree: false,
      },
      validate: {
        phone: ValidatePersonalData.phone,
        email: ValidatePersonalData.email,
        password: ValidatePersonalData.password,
        agree: ValidatePersonalData.agree,
      },
    };
  },
  methods: {
    submitForm() {
      if (!this.isFormValid) {
        return;
      }

      let body: RegisterRequestDto = {
        phone: String(this.form.phone),
        email: String(this.form.email),
        password: String(this.form.password),
      };

      let service = new UserService();
      service.register(body).then((response: any) => {
        console.log(response);
      });
    },
  }
})
</script>

<template>
  <v-form class="signup-form" v-model="isFormValid" @submit.prevent="submitForm">
    <ModernPhone
      v-model="form.phone"
      :rules="validate.phone"
      label="Номер телефона"
    />

    <ModernEmail
      v-model="form.email"
      :rules="validate.email"
      label="E-Mail адрес"
    />

    <ModernPassword
      v-model="form.password"
      :rules="validate.password"
      label="Пароль"
    />

    <Agree v-model="form.agree" :rules="validate.agree" />

    <SButton type="submit">Зарегистрироваться</SButton>

    <WithSocial/>
  </v-form>
</template>

<style lang="scss">
.signup-form {
  height: 100%;
  display: flex;
  flex-direction: column;
  gap: 15px;
}
</style>
