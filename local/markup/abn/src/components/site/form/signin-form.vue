<script lang="ts">
import {defineComponent} from 'vue'
import BaseInput from "@/components/site/form/modern/base-input.vue";
import ModernPassword from "@/components/site/form/modern/modern-password.vue";
import ModernPhone from "@/components/site/form/modern/modern-phone.vue";
import UserService from "@/service/User/UserService.ts";
import type AuthorizeDto from "@/dto/request/AuthorizeDto.ts";
import Agree from "@/components/site/form/element/agree.vue";

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
        agree: [
          (value: boolean) => {
            if (!value) {
              return 'Необходимо дать свое согласие';
            }

            return true;
          }
        ],
        phone: [
          (value: string | null) => {
            if (!value || value.length <= 0) {
              return 'Должно быть заполнено';
            }

            return true;
          }
        ],
        password: [
          (value: string | null) => {
            if (!value || value.length <= 0) {
              return 'Должно быть заполнено';
            }

            return true;
          }
        ]
      },
    };
  },
  components: {Agree, ModernPhone, ModernPassword: ModernPassword, ModernInput: BaseInput},
  methods: {
    submitForm() {

      console.log('asdadsads');

      if (!this.isFormValid) {
        return;
      }

      let body: AuthorizeDto = {
        phone: String(this.form.phone),
        password: String(this.form.password),
      };


      console.log('asdadsads 222222');


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


    <div class="signin-with-social">
      <div class="signin-with-social-line-wrap">
        <div class="signin-with-social-line-text">или</div>
        <div class="signin-with-social-line"></div>
      </div>


      <div class="signin-with-social-list">
        <div class="signin-with-social-item">
          <v-icon icon="$googleIcon" size="medium" color="white"/>
        </div>
        <div class="signin-with-social-item">
          <v-icon icon="$peopleList" size="medium" color="white"/>
        </div>
        <div class="signin-with-social-item">
          <v-icon icon="$peopleList" size="medium" color="white"/>
        </div>
        <div class="signin-with-social-item">
          <v-icon icon="$peopleList" size="medium" color="white"/>
        </div>
      </div>
    </div>

    <!--    <v-btn type="submit">Войти</v-btn>-->
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
    padding-top: 25px;
  }

  &-with-social {
    margin-top: 30px;

    &-line {

      width: 100%;
      height: 1px;
      background: $gray-color;
      //background: $menu-blacked;
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
      border: 1px $footer-short solid;
      border-radius: 5px;
      padding: 5px;
      width: 40px;
      height: 40px;
      overflow: hidden;
      cursor: pointer;
      background: $about-text-border;
      //background: #e6f2ff;
      //background: $about-text-border;

      display: flex;
      align-items: center;
      justify-content: center;
    }
  }
}
</style>
