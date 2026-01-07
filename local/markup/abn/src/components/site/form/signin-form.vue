<script lang="ts">
import {defineComponent} from 'vue'
import BaseInput from "@/components/site/form/modern/base-input.vue";
import ModernPassword from "@/components/site/form/modern/modern-password.vue";
import ModernPhone from "@/components/site/form/modern/modern-phone.vue";
import UserService from "@/service/User/UserService.ts";
import type AuthorizeDto from "@/dto/request/AuthorizeDto.ts";
import Agree from "@/components/site/form/element/agree.vue";
import WithSocial from "@/components/site/with-social.vue";
import ValidatePersonalData from "@/core/validate/validate-personal-data.ts";

export default defineComponent({
  name: "SigninForm",
  data: function () {
    return {
      isFormValid: false,
      form: {
        agree: false,
        phone: null,
        password: null,
      },
      validate: {
        phone: ValidatePersonalData.phone,
        email: ValidatePersonalData.email,
        password: ValidatePersonalData.password,
        agree: ValidatePersonalData.agree,
      },
    };
  },
  components: {WithSocial, Agree, ModernPhone, ModernPassword: ModernPassword, ModernInput: BaseInput},
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
  <v-form class="signin-form" v-model="isFormValid" @submit.prevent="submitForm">

    <ModernPhone
      v-model="form.phone"
      :rules="validate.phone"
      label="Номер телефона"
    />

    <ModernPassword
      v-model="form.password"
      :rules="validate.password"
      label="Пароль"
    />

    <Agree v-model="form.agree" :rules="validate.agree">
      Я согласен с политикой конфидициальности и офертой
    </Agree>

    <SButton type="submit">Авторизоваться</SButton>

    <WithSocial/>
  </v-form>
</template>

<style lang="scss">
@use '@/styles/system/variable' as *;

.signin {
  &-form {
    height: 100%;
    display: flex;
    flex-direction: column;
    gap: 15px;
  }

  &-with-social {
    margin-top: 30px;

    &-line {

      width: 100%;
      height: 1px;
      background: $gray-color;
      position: absolute;
      top: 50%;
      left: 0;
      transform: translate(0px, -50%);

      &-wrap {
        position: relative;
        height: 40px;
      }

      &-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 33;
        background: $white-color;
        //background: $button-color;
        //color: $white-color;
        font-size: 12px;
        padding: 3px 7px;
        border-radius: 10px;
      }
    }

    &-list {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      margin-top: 20px;
    }

    &-item {
      border: 1px $bo-color-name solid;
      border-radius: 5px;
      padding: 5px;
      width: 40px;
      height: 40px;
      overflow: hidden;
      cursor: pointer;
      background: $white-color;

      display: flex;
      align-items: center;
      justify-content: center;

      .v-icon {
        color: $button-color !important;
        //color: $personal-reward-bg !important;
      }
    }
  }
}
</style>
