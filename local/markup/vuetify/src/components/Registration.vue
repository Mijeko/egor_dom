<script lang="ts">
import {defineComponent} from 'vue'
import ValidateLegalData from "@/core/validate/ValidateLegalData.ts";
import ValidatePersonalData from "@/core/validate/ValidatePersonalData.ts";
import UserService from "@/service/User/UserService.ts";
import type RegisterAgentResponseDto from "@/dto/response/RegisterAgentResponseDto.ts";
import AlertService from "@/service/AlertService.ts";
import type RegisterStudentRequestDto from "@/dto/request/RegisterStudentRequestDto.ts";
import type RegisterStudentResponseDto from "@/dto/response/RegisterStudentResponseDto.ts";
import CoreHelper from "@/service/CoreHelper.ts";
import type RegisterSimpleAgentRequestDto from "@/dto/request/RegisterSimpleAgentRequestDto.ts";
import type {ComponentControllerApiErrorDto} from "@/dto/response/ComponentControllerApiResponseDto.ts";

export default defineComponent({
  name: "Registration",
  data: () => {
    return {
      isFindByInn: 0,
      isFindByBik: false,
      timer: 0,
      tab: null,
      isFormStudentValid: false,
      formStudentValidateRules: {
        email: [
          (value: string) => {
            if (value.length <= 0) {
              return 'Заполните email';
            }

            if (!CoreHelper.emailIsValid(value)) {
              return 'Неверный формат email';
            }

            return true;
          }
        ],
        phone: [
          (value: string) => {
            if (value.length <= 0) {
              return 'Заполните номер телефона';
            }

            return true;
          },
          ...ValidatePersonalData.phone
        ],
        password: ValidatePersonalData.password,
      },
      isFormAgentValid: false,
      formAgentValidateRules: {
        email: [
          (value: string) => {
            if (value.length <= 0) {
              return 'Заполните email';
            }

            if (!CoreHelper.emailIsValid(value)) {
              return 'Неверный формат email';
            }

            return true;
          }
        ],
        phone: [
          (value: string) => {
            if (value.length <= 0) {
              return 'Заполните номер телефона';
            }

            return true;
          },
          ...ValidatePersonalData.phone
        ],
        password: ValidatePersonalData.password,
        inn: ValidateLegalData.inn,
        kpp: ValidateLegalData.kpp,
        ogrn: ValidateLegalData.ogrn,
        bik: ValidateLegalData.bik,
        currAcc: ValidateLegalData.currAcc,
        corrAcc: ValidateLegalData.corrAcc,
        bankName: [
          (value: string) => {
            if (value.length <= 0) {
              return 'Заполните наименование банка';
            }

            return true;
          },
          ...ValidateLegalData.bankName
        ],
        postAddress: [
          (value: string) => {
            if (value.length <= 0) {
              return 'Заполните почтовый адрес';
            }

            return true;
          },
          ...ValidateLegalData.postAddress
        ],
        legalAddress: [
          (value: string) => {
            if (value.length <= 0) {
              return 'Заполните юиридический адрес';
            }

            return true;
          },
          ...ValidateLegalData.legalAddress
        ],
      },
      formStudent: {
        phone: '',
        email: '',
        password: '',
      },
      formAgent: {
        phone: '',
        email: '',
        password: '',
      },
      isPostIdenticalLegalAddress: false,
    };
  },
  methods: {
    registrationStudent: function () {
      if (!this.isFormStudentValid) {
        return;
      }
      let userService = new UserService();
      let body: RegisterStudentRequestDto = {
        email: this.formStudent.email,
        phone: this.formStudent.phone,
        password: this.formStudent.password
      };

      userService.registrationStudent(body)
          .then((response: RegisterStudentResponseDto) => {
            let {status, data} = response;
            let {redirect} = data;

            if (status === 'success' && redirect) {
              window.location.href = redirect;
            }
          }, function (errorResponse: ComponentControllerApiErrorDto) {
            let {data} = errorResponse;
            let {ajaxRejectData} = data;
            let {error} = ajaxRejectData;

            if (error.message) {
              AlertService.showErrorAlert('Регистрация', error.message);
            }
          });
    },
    registrationAgent: function () {
      if (!this.isFormAgentValid) {
        return;
      }
      let api = new UserService();
      let body: RegisterSimpleAgentRequestDto = {
        phone: this.formAgent.phone,
        email: this.formAgent.email,
        password: this.formAgent.password,
      };
      api.registrationAgent(body)
          .then((response: RegisterAgentResponseDto) => {
            let {status, data} = response;
            let {redirect} = data;

            if (status === 'success' && redirect) {
              window.location.href = redirect;
            }
          }, function (errorResponse: ComponentControllerApiErrorDto) {
            let {data} = errorResponse;
            let {ajaxRejectData} = data;
            let {error} = ajaxRejectData;

            if (error.message) {
              AlertService.showErrorAlert('Регистрация', error.message);
            }
          });
    },
  },
})
</script>

<template>

  <v-card class="mt-16 " :border="false" elevation="0">
    <h1 class="text-center">Регистрация</h1>
    <v-tabs
        align-tabs="center"
        v-model="tab"

        color="deep-purple-accent-4"
    >
      <v-tab value="student">Как ученик</v-tab>
      <v-tab value="agent">Как агент</v-tab>
    </v-tabs>


    <v-tabs-window v-model="tab">
      <v-tabs-window-item value="student" class="pa-3">
        <v-form @submit.prevent="registrationStudent" v-model="isFormStudentValid">
          <v-text-field
              v-model="formStudent.phone"
              :rules="formStudentValidateRules.phone"
              return-masked-value
              mask="+# (###) ### ####"
              label="Номер телефона"
          />
          <v-text-field
              v-model="formStudent.email"
              :rules="formStudentValidateRules.email"
              label="E-mail адрес"
          />
          <v-text-field
              v-model="formStudent.password"
              :rules="formStudentValidateRules.password"
              type="password"
              label="Пароль"
          />

          <v-row>
            <v-col cols="6" md="2">
              <v-btn type="submit">Зарегистрироваться</v-btn>
            </v-col>
            <v-col cols="6" md="2">
              <a href="/">Войти на сайт</a>
            </v-col>
          </v-row>
        </v-form>
      </v-tabs-window-item>

      <v-tabs-window-item value="agent" class="pa-3">
        <v-form @submit.prevent="registrationAgent" v-model="isFormAgentValid">

          <v-text-field
              v-model="formAgent.phone"
              :rules="formAgentValidateRules.phone"
              return-masked-value
              mask="+# (###) ### ####"
              label="Телефон"
          />

          <v-text-field
              v-model="formAgent.email"
              :rules="formAgentValidateRules.email"
              label="E-Mail адрес"
          />

          <v-text-field
              type="password"
              v-model="formAgent.password"
              :rules="formAgentValidateRules.password"
              label="Пароль"
          />


          <v-row>
            <v-col cols="6" md="2">
              <v-btn type="submit">Зарегистрироваться</v-btn>
            </v-col>
            <v-col cols="6" md="2">
              <a href="/">Войти на сайт</a>
            </v-col>
          </v-row>
        </v-form>
      </v-tabs-window-item>
    </v-tabs-window>
  </v-card>


</template>

<style scoped>

</style>
