<script>
import {defineComponent} from "vue";
import CraftApi from "@/service/CraftApi.js";

export default defineComponent({
  methods: {
    submitForm: function (event) {
      if (this.valid) {
        CraftApi.post('user.register', new FormData(event.target))
          .then(response => response.json())
          .then(data => {
            console.log(data)
          });
      }
    },
  },
  data: function () {
    return {
      valid: false,
      firstname: '',
      lastname: '',
      form: {
        phone: '',
        email: '',
        password: '',
      },
      validate: {
        phone: [
          value => {
            if (value) return true

            return 'Телефон обязателен.'
          },
          value => {
            if (value?.length <= 11) return true

            return 'Телефон должен быть 11 символов.'
          },
        ],
        email: [
          value => {
            if (value) return true

            return 'Email обязателен.'
          },
          value => {
            if (/.+@.+\..+/.test(value)) return true

            return 'Неккоректное значение email.'
          },
        ],
      },
      email: '',
    }
  },
})
</script>

<template>

  <v-form v-model="valid" @submit.prevent="submitForm">
    <v-container>

      <h1 style="margin-bottom: 30px; text-align: center;">Dom Egor регистрация</h1>

      <v-row>
        <v-col
          cols="12"
          md="12"
        >
          <v-text-field
            v-model="form.phone"
            :counter="11"
            :rules="validate.phone"
            label="Номер телефона"
            required
          ></v-text-field>
        </v-col>

        <v-col
          cols="12"
          md="12"
        >
          <v-text-field
            v-model="email"
            :rules="validate.email"
            label="E-mail"
            required
          ></v-text-field>
        </v-col>


        <v-col
          cols="12"
          md="12"
        >
          <v-text-field
            v-model="form.password"
            :counter="10"
            label="Пароль"
            required
          ></v-text-field>
        </v-col>
      </v-row>

      <v-btn class="mt-2" type="submit" block>Зарегистрироваться</v-btn>
    </v-container>

  </v-form>

</template>

<style scoped>

</style>
