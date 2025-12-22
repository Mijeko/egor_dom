<script lang="ts">
import {defineComponent} from 'vue'
import ModernInput from "@/components/site/form/modern/modern-input.vue";
import ModernPassword from "@/components/site/form/modern/modern-password.vue";
import ModernPhone from "@/components/site/form/modern/modern-phone.vue";

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
  components: {ModernPhone, ModernPassword: ModernPassword, ModernInput: ModernInput},
  methods: {
    submitForm() {
      if (!this.isFormValid) {
        return;
      }
    },
  }
})
</script>

<template>
  <v-card title="Войти на сайт">

    <v-form v-model="isFormValid" @submit.prevent="submitForm">
      <ModernPhone
        v-model="form.phone"
        :rules="validate.phone"
      />
      <ModernPassword
        v-model="form.password"
        :rules="validate.password"
      />
      <v-btn>Регистрация</v-btn>
    </v-form>

  </v-card>
</template>

<style scoped>

</style>
