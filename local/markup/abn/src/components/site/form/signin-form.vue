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
        phone: {},
        password: {},
      },
      validate: {
        phone: [],
        password: []
      },
    };
  },
  components: {ModernPhone, ModernPassword: ModernPassword, ModernInput: ModernInput},
  methods: {
    submitForm() {
      if (!this.isFormValid) {
        return;
      }

      let body: AuthorizeDto = {
        phone: String(this.form.phone),
        password: String(this.form.password),
      };

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
  <v-card title="Войти на сайт">
    <v-card-text>

      <v-form v-model="isFormValid" @submit.prevent="submitForm">
        <ModernPhone
          v-model="form.phone"
          :rules="validate.phone"
        />
        <ModernPassword
          v-model="form.password"
          :rules="validate.password"
        />
        <v-btn type="submit">Войти</v-btn>
      </v-form>

    </v-card-text>
  </v-card>
</template>

<style scoped>

</style>
