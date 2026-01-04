<script lang="ts">
import {defineComponent} from 'vue'
import ModernInput from "@/components/site/form/modern/modern-input.vue";
import ModernPassword from "@/components/site/form/modern/modern-password.vue";
import ModernPhone from "@/components/site/form/modern/modern-phone.vue";
import UserService from "@/service/User/UserService.ts";
import type AuthorizeDto from "@/dto/request/AuthorizeDto.ts";

export default defineComponent({
  name: "SigninForm",
  data: function () {
    return {
      isFormValid: false,
      form: {
        demo: null,
        phone: null,
        password: null,
      },
      validate: {
        phone: [
          (value: string | null) => {
            if (!value || value.length <= 0) {
              return 'Должно быть заполнено';
            }

            return true;
          }
        ],
        password: [
          (value: string | null) => {
            if (!value || value.length <= 0) {
              return 'Должно быть заполнено';
            }

            return true;
          }
        ]
      },
    };
  },
  components: {ModernPhone, ModernPassword: ModernPassword, ModernInput: ModernInput},
  methods: {
    submitForm() {

      console.log('asdadsads');

      if (!this.isFormValid) {
        return;
      }

      let body: AuthorizeDto = {
        phone: String(this.form.phone),
        password: String(this.form.password),
      };


      console.log('asdadsads 222222');


      let service = new UserService();
      service
        .authorize(body)
        .then((response: any) => {
          let {data} = response;
          let {redirect} = data;

          if (redirect) {
            window.location.href = redirect;
          }
        });
    },
  }
})
</script>

<template>
  <v-form class="signin-form" v-model="isFormValid" @submit.prevent="submitForm">

    <v-text-field

      v-model="form.demo"
      :rules="validate.phone"
    >

    </v-text-field>

    <ModernPhone
      v-model="form.phone"
      :rules="validate.phone"
      label="Номер телефона"
    >
      <template #template="{label, type, value}">

        <label>
          {{ label }}
        </label>

      </template>
    </ModernPhone>


    <ModernPassword
      v-model="form.password"
      :rules="validate.password"
    >

      <template #template="{label, type, value}">
        <label>
          {{ label }}
        </label>
      </template>

    </ModernPassword>

    <v-btn type="submit">Войти</v-btn>
  </v-form>
</template>

<style lang="scss">
.signin-form {
  height: 100%;
}
</style>
