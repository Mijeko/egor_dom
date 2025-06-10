<script lang="ts">
import {defineComponent} from 'vue'

export default defineComponent({
  name: "ProfileEditForm",
  data: () => ({
    valid: false,
    firstname: '',
    lastname: '',
    nameRules: [
      (value: string) => {
        if (value) return true

        return 'Name is required.'
      },
      (value: string) => {
        if (value?.length <= 10) return true

        return 'Name must be less than 10 characters.'
      },
    ],
    email: '',
    emailRules: [
      (value: string) => {
        if (value) return true

        return 'E-mail is required.'
      },
      (value: string) => {
        if (/.+@.+\..+/.test(value)) return true

        return 'E-mail must be valid.'
      },
    ],
  }),
})
</script>

<template>
  <v-form v-model="valid">
    <v-text-field
        v-model="firstname"
        :counter="10"
        :rules="nameRules"
        label="First name"
        required
    ></v-text-field>
    <v-text-field
        v-model="lastname"
        :counter="10"
        :rules="nameRules"
        label="Last name"
        required
    ></v-text-field>
    <v-text-field
        v-model="email"
        :rules="emailRules"
        label="E-mail"
        required
    ></v-text-field>
  </v-form>

  <v-btn
      class="me-4"
      type="submit"
  >
    Изменить
  </v-btn>
</template>

<style scoped>

</style>
