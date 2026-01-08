<script lang="ts">
import {defineComponent} from 'vue';
import ValidatePersonalData from "@/core/validate/validate-personal-data.ts";
import ModernEmail from "@/components/site/form/modern/modern-email.vue";

export default defineComponent({
  name: "SignupRefForm",
  components: {ModernEmail},
  data: () => {
    return {
      form: {
        email: null,
        phone: null,
        password: null,
        agree: false,
      },
      validate: {
        email: ValidatePersonalData.email,
        phone: ValidatePersonalData.phone,
        password: ValidatePersonalData.password,
        agree: ValidatePersonalData.agree
      }
    };
  }
})
</script>

<template>
  <SignupForm class="form-with-ref"/>
</template>

<style lang="scss">
.form-with-ref {
  max-width: 600px;
  margin: auto;
}
</style>
