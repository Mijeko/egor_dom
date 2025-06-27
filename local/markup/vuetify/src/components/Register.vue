<script lang="ts">
import {defineComponent} from 'vue'
import DaDataApi from "@/service/DaDataApi.ts";
import type DaDataSuggestionsCompanyInnDto from "@/dto/response/api/dadata/DaDataSuggestionsCompanyInnDto.ts";
import ValidateLegalData from "@/core/validate/ValidateLegalData.ts";
import {th} from "vuetify/locale";

export default defineComponent({
  name: "Register",
  data: () => {
    return {
      isFindById: false,
      timer: 0,
      tab: null,
      isFormStudentValid: false,
      formStudentValidateRules: [],
      isFormAgentValid: false,
      formAgentValidateRules: {
        inn: ValidateLegalData.inn,
        kpp: ValidateLegalData.kpp,
        ogrn: ValidateLegalData.ogrn,
        currAcc: ValidateLegalData.currAcc,
        corrAcc: ValidateLegalData.corrAcc,
        bankName: ValidateLegalData.bankName,
        postAddress: ValidateLegalData.postAddress,
        legalAddress: ValidateLegalData.legalAddress,
      },
      formStudent: {
        phone: '',
        password: '',
      },
      formAgent: {
        phone: '',
        password: '',
        inn: '',
        kpp: '',
        ogrn: '',
        bik: '',
        currAcc: '',
        corrAcc: '',
        bankName: '',
        legalAddress: '',
        postAddress: '',
      },
      isPostIdenticalLegalAddress: false,
    };
  },
  methods: {
    registrationStudent: function () {
      return true;
    },
    registrationAgent: function () {
      return true;
    },
    handleLegalAddress(event: any) {
      let value = event.target.value;
      if (this.isPostIdenticalLegalAddress) {
        this.formAgent.postAddress = value;
      }
    },
    handleInputInn(event: any) {

      let inputInn = event.target.value;

      if (this.timer) {
        clearTimeout(this.timer);
      }


      this.timer = setTimeout(() => {
        let api = new DaDataApi();
        api.suggestionsCompany(inputInn)
          .then((response: DaDataSuggestionsCompanyInnDto) => {

            if (response.suggestions.length == 1) {
              this.isFindById = true;
              this.formAgent.ogrn = response.suggestions[0].data.ogrn ?? '';
              this.formAgent.kpp = response.suggestions[0].data.kpp ?? '';
              this.formAgent.legalAddress = response.suggestions[0].data.address.value ?? '';
            }

          });

      }, 300)

    },
  },
  watch: {
    isPostIdenticalLegalAddress: function (newValue: boolean, oldValue: boolean) {
      if (newValue) {
        this.formAgent.postAddress = this.formAgent.legalAddress;
      } else {
        this.formAgent.postAddress = '';
      }
    }
  },
})
</script>

<template>

  <v-card>
    <v-tabs
      align-tabs="center"
      v-model="tab"

      color="deep-purple-accent-4"
    >
      <v-tab value="student">Как ученик</v-tab>
      <v-tab value="agent">Как агент</v-tab>
    </v-tabs>


    <v-tabs-window v-model="tab">
      <v-tabs-window-item value="student">
        <v-form @submit.prevent="registrationStudent">
          <v-text-field v-model="formStudent.phone" label="Номер телефона"/>
          <v-text-field v-model="formStudent.password" type="password" label="Пароль"/>

          <v-divider/>

          <v-btn type="submit">Зарегистрироваться</v-btn>
        </v-form>
      </v-tabs-window-item>

      <v-tabs-window-item value="agent">
        <v-form @submit.prevent="registrationAgent" v-model="isFormAgentValid">
          <v-text-field v-model="formAgent.inn" label="ИНН" @input.prevent="handleInputInn"/>


          <v-row v-if="isFindById">
            <v-col cols="12">
              <v-row>
                <v-col cols="12">
                  <v-card-text class="text-center">
                    Мы нашли вас.<br>Измените информацию, если не является верной
                  </v-card-text>
                </v-col>
              </v-row>

              <v-row>
                <v-col cols="12">
                  <v-text-field v-model="formAgent.phone" label="Телефон"/>
                </v-col>
              </v-row>

              <v-row>
                <v-col cols="12">
                  <v-text-field v-model="formAgent.password" label="Пароль"/>
                </v-col>
              </v-row>

              <v-row>
                <v-col cols="12">
                  <v-text-field v-model="formAgent.inn" :rules="formAgentValidateRules.inn" label="ИНН"/>
                </v-col>
              </v-row>

              <v-row>
                <v-col cols="12">
                  <v-text-field v-model="formAgent.kpp" :rules="formAgentValidateRules.kpp" label="КПП"/>
                </v-col>
              </v-row>

              <v-row>
                <v-col cols="12">
                  <v-text-field v-model="formAgent.ogrn" :rules="formAgentValidateRules.ogrn" label="ОГРН/ОГРНИП"/>
                </v-col>
              </v-row>

              <v-row>
                <v-col cols="12">
                  <v-text-field
                    v-model="formAgent.currAcc"
                    :rules="formAgentValidateRules.currAcc"
                    label="Расчетный счет"
                  />
                </v-col>
              </v-row>

              <v-row>
                <v-col cols="12">
                  <v-text-field
                    v-model="formAgent.corrAcc"
                    :rules="formAgentValidateRules.corrAcc"
                    label="Кореспондентский счет"
                  />
                </v-col>
              </v-row>

              <v-row>
                <v-col cols="12">
                  <v-text-field
                    v-model="formAgent.bankName"
                    :rules="formAgentValidateRules.bankName"
                    label="Наименование банка"
                  />
                </v-col>
              </v-row>

              <v-row>
                <v-col cols="12">
                  <v-text-field
                    v-model="formAgent.legalAddress"
                    :rules="formAgentValidateRules.legalAddress"
                    @input="handleLegalAddress"
                    label="Юридический адрес"
                  />
                </v-col>
              </v-row>

              <v-row>
                <v-col cols="12">
                  <v-text-field
                    v-model="formAgent.postAddress"
                    :rules="formAgentValidateRules.postAddress"
                    label="Почтовый адрес"
                  />
                  <v-checkbox v-model="isPostIdenticalLegalAddress" label="Совпадает с юридическим адресом"/>
                </v-col>
              </v-row>


            </v-col>
          </v-row>

          <v-divider/>

          <v-btn type="submit">Зарегистрироваться</v-btn>
        </v-form>
      </v-tabs-window-item>
    </v-tabs-window>
  </v-card>


</template>

<style scoped>

</style>
