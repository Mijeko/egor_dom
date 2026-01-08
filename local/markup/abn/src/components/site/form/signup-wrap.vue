<script lang="ts">
import {defineComponent} from 'vue';

export default defineComponent({
  name: "SignupWrap",
})
</script>

<template>
  <section class="referral-registration container">
    <h1 class="page-title h1 referral-registration-title">Регистрация</h1>
    <SignupForm class="short-auth-form"/>
  </section>
</template>

<style lang="scss">

.referral-registration {
  &-title {
    margin-bottom: 30px !important;
  }
}

.short-auth-form {
  max-width: 600px;
  margin: auto;
}
</style>
