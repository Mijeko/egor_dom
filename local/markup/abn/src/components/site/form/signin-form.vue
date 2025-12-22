<script lang="ts">
import {defineComponent} from 'vue'
import ModernInput from "@/components/site/form/modern/modern-input.vue";
import ModernPassword from "@/components/site/form/modern/modern-password.vue";

export default defineComponent({
  name: "SigninForm",
  data: function () {
    return {

    };
  },
  components: {ModernPassword: ModernPassword, ModernInput: ModernInput},
  methods: {
    submitForm() {
    },
  }
})
</script>

<template>
  <v-card title="Войти на сайт">

    <v-form @submit.prevent="submitForm">
      <ModernInput/>
      <ModernPassword/>
    </v-form>

    <v-btn>Войти</v-btn>

  </v-card>
</template>

<style scoped>

</style>
