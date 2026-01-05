<script lang="ts">
import {defineComponent} from 'vue'
import BaseInput from "@/components/site/form/modern/base-input.vue";
import ModernPassword from "@/components/site/form/modern/modern-password.vue";
import ModernPhone from "@/components/site/form/modern/modern-phone.vue";
import UserService from "@/service/User/UserService.ts";
import type RegisterRequestDto from "@/dto/request/RegisterRequestDto.ts";

export default defineComponent({
  name: "SignupForm",
  data: function () {
    return {
      isFormValid: false,
      form: {
        phone: {},
        password: {},
      },
      validate: {
        phone: [],
        password: []
      },
    };
  },
  components: {ModernPhone, ModernPassword: ModernPassword, ModernInput: BaseInput},
  methods: {
    submitForm() {
      if (!this.isFormValid) {
        return;
      }

      let body: RegisterRequestDto = {};

      let service = new UserService();
      service.register(body).then((response: any) => {

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
    <ModernPassword
      v-model="form.password"
      :rules="validate.password"
      label="Пароль"
    />


    <SButton type="submit">Регистрация</SButton>
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
