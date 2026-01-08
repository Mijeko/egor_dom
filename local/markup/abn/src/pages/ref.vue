<script lang="ts">
import {defineComponent} from 'vue'
import SignupRefForm from "@/components/site/form/signup-ref-form.vue";

export default defineComponent({
  name: "Ref",
  components: {SignupRefForm},
})
</script>

<template>
  <section class="referral-registration container">
    <h1 class="page-title h1 referral-registration-title">Регистрация</h1>
    <SignupRefForm/>
  </section>
</template>

<style lang="scss">
.referral-registration {
  &-title {
margin-bottom: 30px!important;
  }
}
</style>
