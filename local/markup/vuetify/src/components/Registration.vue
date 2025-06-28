<script lang="ts">
import {defineComponent} from 'vue'
import DaDataApi from "@/service/DaDataApi.ts";
import type DaDataSuggestionsCompanyDto from "@/dto/response/api/dadata/company/DaDataSuggestionsCompanyDto.ts";
import ValidateLegalData from "@/core/validate/ValidateLegalData.ts";
import type DaDataSuggestionsBankDto from "@/dto/response/api/dadata/bank/DaDataSuggestionsBankDto.ts";
import ValidatePersonalData from "@/core/validate/ValidatePersonalData.ts";
import UserService from "@/service/User/UserService.ts";
import type RegisterAgentResponseDto from "@/dto/response/RegisterAgentResponseDto.ts";
import type RegisterAgentRequestDto from "@/dto/request/RegisterAgentRequestDto.ts";
import AlertService from "@/service/AlertService.ts";

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
        phone: [
          (value: string) => {
            if (value.length <= 0) {
              return 'Заполните номер телефона';
            }

            return true;
          },
          ...ValidatePersonalData.phone
        ],
        password: [
          (value: string) => {
            if (value.length <= 0) {
              return 'Заполните пароль';
            }

            return true;
          }
        ],
      },
      isFormAgentValid: false,
      formAgentValidateRules: {
        email: [
          (value: string) => {
            if (value.length <= 0) {
              return 'Заполните email';
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
        password: [
          (value: string) => {
            if (value.length <= 0) {
              return 'Заполните пароль';
            }

            return true;
          }
        ],
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
        password: '',
      },
      formAgent: {
        phone: '',
        email: '',
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
      if (!this.isFormStudentValid) {
        return;
      }
      // let api = new UserService();
      // api.registrationStudent();
    },
    registrationAgent: function () {
      if (!this.isFormAgentValid) {
        return;
      }
      let api = new UserService();
      let body: RegisterAgentRequestDto = {
        phone: this.formAgent.phone,
        password: this.formAgent.password,
        inn: this.formAgent.inn,
        kpp: this.formAgent.kpp,
        ogrn: this.formAgent.ogrn,
        bik: this.formAgent.bik,
        currAcc: this.formAgent.currAcc,
        corrAcc: this.formAgent.corrAcc,
        bankName: this.formAgent.bankName,
        legalAddress: this.formAgent.legalAddress,
        postAddress: this.formAgent.postAddress,
      };
      api.registrationAgent(body)
        .then((response: RegisterAgentResponseDto) => {
          let {result} = response;
          let {success, error} = result;

          if (!success) {
            AlertService.showErrorAlert('Регистрация', error);
          } else {
            window.location.href = '/';
          }
        });
    },
    handleLegalAddress(event: any) {
      let value = event.target.value;
      if (this.isPostIdenticalLegalAddress) {
        this.formAgent.postAddress = value;
      }
    },
    handleInputInn(event: any) {

      let value = event.target.value;

      if (this.timer) {
        clearTimeout(this.timer);
      }


      this.timer = setTimeout(() => {
        let api = new DaDataApi();
        api.suggestionsCompany(value)
          .then((response: DaDataSuggestionsCompanyDto) => {

            if (response.suggestions.length == 1) {
              this.isFindByInn = 1;
              this.formAgent.ogrn = response.suggestions[0].data.ogrn ?? '';
              this.formAgent.kpp = response.suggestions[0].data.kpp ?? '';
              this.formAgent.legalAddress = response.suggestions[0].data.address.value ?? '';
            } else {
              this.isFindByInn = 2;
            }

          });

      }, 300)

    },
    handleInputBik(event: any) {

      let value = event.target.value;

      if (this.timer) {
        clearTimeout(this.timer);
      }

      this.timer = setTimeout(() => {
        let api = new DaDataApi();
        api.suggestionsBank(value)
          .then((response: DaDataSuggestionsBankDto) => {

            if (response.suggestions.length == 1) {
              this.isFindByBik = true;
              this.formAgent.corrAcc = response.suggestions[0].data.correspondent_account ?? '';
              this.formAgent.bankName = response.suggestions[0].data.name.payment ?? '';
            } else {
              this.isFindByBik = true;
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
        <v-form @submit.prevent="registrationStudent" v-model="isFormStudentValid">
          <v-text-field
            v-model="formStudent.phone"
            :rules="formStudentValidateRules.phone"
            return-masked-value
            mask="+# (###) ### ####"
            label="Номер телефона"
          />
          <v-text-field
            v-model="formStudent.password"
            :rules="formStudentValidateRules.password"
            type="password"
            label="Пароль"
          />

          <v-divider/>

          <v-btn type="submit">Зарегистрироваться</v-btn>
        </v-form>
      </v-tabs-window-item>

      <v-tabs-window-item value="agent">
        <v-form @submit.prevent="registrationAgent" v-model="isFormAgentValid">
          <v-text-field v-model="formAgent.inn" label="ИНН" @input.prevent="handleInputInn"/>


          <v-row v-if="isFindByInn > 0">
            <v-col cols="12">
              <v-row>
                <v-col cols="12">
                  <v-card-text class="text-center" v-if="isFindByInn=1">
                    Найдена инфомация о вас.<br>Измените или дополните информацию
                  </v-card-text>
                  <v-card-text class="text-center" v-else-if="isFindByInn=2">
                    Мы не нашли инфомацию о вас.<br>Заполните всю информацию
                  </v-card-text>
                </v-col>
              </v-row>

              <v-row>
                <v-col cols="12">
                  <v-text-field
                    v-model="formAgent.phone"
                    :rules="formAgentValidateRules.phone"
                    return-masked-value
                    mask="+# (###) ### ####"
                    label="Телефон"
                  />
                </v-col>
              </v-row>

              <v-row>
                <v-col cols="12">
                  <v-text-field
                    v-model="formAgent.email"
                    :rules="formAgentValidateRules.email"
                    label="E-Mail адрес"
                  />
                </v-col>
              </v-row>

              <v-row>
                <v-col cols="12">
                  <v-text-field
                    v-model="formAgent.password"
                    :rules="formAgentValidateRules.password"
                    label="Пароль"
                  />
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

              <v-row>
                <v-col cols="12">
                  <v-text-field
                    v-model="formAgent.bik"
                    :rules="formAgentValidateRules.bik"
                    @input="handleInputBik"
                    label="БИК"
                  />
                </v-col>
              </v-row>

              <v-row v-if="isFindByBik">
                <v-col cols="12">
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
