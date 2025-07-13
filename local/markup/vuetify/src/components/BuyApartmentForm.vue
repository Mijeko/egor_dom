<script lang="ts">
import {defineComponent} from 'vue'
import CraftApi from "@/service/CraftApi.ts";
import type ClaimCreateRequestDto from "@/dto/request/ClaimCreateRequestDto.ts";
import AlertService from "@/service/AlertService.ts";
import {useUserStore} from "@/store.ts";
import type BxUserDto from "@/dto/bitrix/BxUserDto.ts";
import ValidateLegalData from "@/core/validate/ValidateLegalData.ts";

export default defineComponent({
  name: "BuyApartmentForm",
  data: function () {
    return {
      form: {
        email: '',
        phone: '',
        client: '',
        bik: '',
        kpp: '',
        inn: '',
        ogrn: '',
        currAccount: '',
        corrAccount: '',
        legalAddress: '',
        postAddress: '',
        bankName: '',
      },
      user: {} as BxUserDto,
      isFormValid: false,
      validate: {
        phone: [
          (value: string) => {
            if (!value || value.length <= 0) {
              return 'Заполните телефон';
            }

            return true;
          },
        ],
        email: [
          (value: string) => {
            if (!value || value.length <= 0) {
              return 'Заполните email';
            }

            return true;
          },
        ],
        client: [
          (value: string) => {
            if (!value || value.length <= 0) {
              return 'Заполните фио';
            }

            return true;
          },
        ],
        inn: ValidateLegalData.inn,
        bik: ValidateLegalData.bik,
        ogrn: ValidateLegalData.ogrn,
        kpp: ValidateLegalData.kpp,
        currAcc: ValidateLegalData.currAcc,
        corrAcc: ValidateLegalData.corrAcc,
        postAddress: ValidateLegalData.postAddress,
        legalAddress: ValidateLegalData.legalAddress,
        bankName: ValidateLegalData.bankName,
      },
    };
  },
  props: {
    apartmentId: {
      type: Number,
      default: 0,
    },
  },
  mounted(): any {
    let userStore = useUserStore();
    this.user = userStore.getUser;

    this.form.email = this.user.email ?? '';
    this.form.client = this.user.fullName ?? '';
    this.form.inn = this.user.inn ?? '';
    this.form.bik = this.user.bik ?? '';
    this.form.kpp = this.user.kpp ?? '';
    this.form.ogrn = this.user.ogrn ?? '';
    this.form.currAccount = this.user.currAccount ?? '';
    this.form.corrAccount = this.user.corrAccount ?? '';
    this.form.postAddress = this.user.postAddress ?? '';
    this.form.legalAddress = this.user.legalAddress ?? '';
    this.form.bankName = this.user.bankName ?? '';
  },
  methods: {
    submitForm: function () {

      if (!this.isFormValid) {
        return;
      }

      let api = new CraftApi();


      let body: ClaimCreateRequestDto = {
        apartmentId: this.apartmentId,
        userId: this.user.id,
        email: this.form.email,
        phone: this.form.phone,
        client: this.form.client,
        bik: this.form.bik ?? '',
        kpp: this.form.kpp ?? '',
        inn: this.form.inn ?? '',
        ogrn: this.form.ogrn ?? '',
        currAccount: this.form.currAccount ?? '',
        corrAccount: this.form.corrAccount ?? '',
        legalAddress: this.form.legalAddress ?? '',
        postAddress: this.form.postAddress ?? '',
        bankName: this.form.bankName ?? '',
      };

      api.post('claim.create', api.objectToFormData(body))
        .then((response: any) => response.json())
        .then((response: any) => {

          let {result} = response;
          let {success, error} = result;

          if (success) {
            AlertService.showAlert('Отправка заявки', 'Ваша заявка успаешно отправлена');
            this.$emit('update:modelValue', false);


            this.form.email = '';
            this.form.client = '';
            this.form.inn = '';
            this.form.bik = '';
            this.form.kpp = '';
            this.form.ogrn = '';
            this.form.currAccount = '';
            this.form.corrAccount = '';
            this.form.postAddress = '';
            this.form.legalAddress = '';
            this.form.bankName = '';
          } else if (error) {
            AlertService.showErrorAlert('Отправка заявки', error);
          }

        });
    },
  },
})
</script>

<template>
  <v-form @submit.prevent="submitForm" v-model="isFormValid">

    <v-card-text>
      Заполните недостающие данные и отправьте заявку нажав кнопку "Отправить"
    </v-card-text>

    <v-container>
      <v-row>
        <v-col cols="12">
          <v-text-field type="text" label="Телефон" v-model="form.phone" :rules="validate.phone" required/>
        </v-col>
      </v-row>
      <v-row>
        <v-col cols="12">
          <v-text-field type="text" label="E-Mail" v-model="form.email" :rules="validate.email" required/>
        </v-col>
      </v-row>
      <v-row>
        <v-col cols="12">
          <v-text-field type="text" label="ФИО" v-model="form.client" :rules="validate.client" required/>
        </v-col>
      </v-row>


      <v-card-subtitle>Юридические данные</v-card-subtitle>
      <v-row>
        <v-col cols="12">
          <v-text-field
            :rules="validate.inn"
            type="text"
            label="ИНН"
            v-model="form.inn"
            required
          />
        </v-col>
      </v-row>
      <v-row>
        <v-col cols="12">
          <v-text-field
            type="text"
            label="ОГРН/ОГРНИП"
            v-model="form.ogrn"
            :rules="validate.ogrn"
            required/>
        </v-col>
      </v-row>
      <v-row>
        <v-col cols="12">
          <v-text-field
            type="text"
            label="КПП"
            v-model="form.kpp"
            :rules="validate.kpp"
            required
          />
        </v-col>
      </v-row>
      <v-row>
        <v-col cols="12">
          <v-text-field
            type="text"
            label="БИК"
            v-model="form.bik"
            :rules="validate.bik"
            required
          />
        </v-col>
      </v-row>
      <v-row>
        <v-col cols="12">
          <v-text-field
            type="text"
            label="Расчетный счет"
            v-model="form.currAccount"
            :rules="validate.currAcc"
            required/>
        </v-col>
      </v-row>
      <v-row>
        <v-col cols="12">
          <v-text-field
            type="text"
            label="Корреспондентский счет"
            v-model="form.corrAccount"
            :rules="validate.corrAcc"
            required/>
        </v-col>
      </v-row>
      <v-row>
        <v-col cols="12">
          <v-text-field
            type="text"
            label="Юридический адрес"
            v-model="form.legalAddress"
            :rules="validate.legalAddress"
            required/>
        </v-col>
      </v-row>
      <v-row>
        <v-col cols="12">
          <v-text-field
            type="text"
            label="Почтовый адрес"
            v-model="form.postAddress"
            :rules="validate.postAddress"
            required/>
        </v-col>
      </v-row>
      <v-row>
        <v-col cols="12">
          <v-text-field
            type="text"
            label="Наименование банка"
            v-model="form.bankName"
            :rules="validate.bankName"
            required/>
        </v-col>
      </v-row>
    </v-container>

    <v-card-actions>
      <v-spacer></v-spacer>

      <v-btn type="submit">Отправить</v-btn>

      <v-btn
        text="Отмена"
        @click="$emit('update:modelValue', false)"
      ></v-btn>
    </v-card-actions>
  </v-form>
</template>

<style scoped>

</style>
