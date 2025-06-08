<script lang="ts">
import {defineComponent} from "vue";
import RegisterService from "../service/Register/RegisterService.ts";
import type RegisterRequestDto from "@/Dto/RegisterRequestDto.ts";

export default defineComponent({
  methods: {
    submitForm: function () {
      if (this.valid) {

        let body: RegisterRequestDto = {
          email: this.form.email,
          phone: this.form.phone,
          password: this.form.password
        };

        let service = new RegisterService();
        service.execute(body)
          .then((response: any) => response.json())
          .then((data: object) => {
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
          (value: string) => {
            if (value) return true

            return 'Телефон обязателен.'
          },
          (value: string) => {
            if (value?.length <= 11) return true

            return 'Телефон должен быть 11 символов.'
          },
        ],
        email: [
          (value: string) => {
            if (value) return true

            return 'Email обязателен.'
          },
          (value: string) => {
            if (/.+@.+\..+/.test(value)) return true

            return 'Неккоректное значение email.'
          },
        ],
      },
    }
  },
})
</script>

<template>

  <v-form v-model="valid" @submit.prevent="submitForm">
    <v-container>

      <h1 style="margin-bottom: 30px; text-align: center;">АБН - регистрация</h1>

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
            v-model="form.email"
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
