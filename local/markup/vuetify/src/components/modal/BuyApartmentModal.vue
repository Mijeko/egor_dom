<script lang="ts">
import {defineComponent} from 'vue'
import {useUserStore} from "@/store.ts";
import type BxUserDto from "@/dto/bitrix/BxUserDto.ts";
import CraftApi from "@/service/CraftApi.ts";
import type ClaimCreateRequestDto from "@/dto/request/ClaimCreateRequestDto.ts";
import {el, th} from "vuetify/locale";
import AlertService from "@/service/AlertService.ts";

export default defineComponent({
  name: "BuyApartmentModal",
  data: function () {
    return {
      form: {
        email: '',
        phone: '',
        client: '',
        bik: 0,
        kpp: 0,
        inn: 0,
        ogrn: 0,
        currAccount: 0,
        corrAccount: 0,
        legalAddress: '',
        postAddress: '',
        bankName: '',
      },
      user: {} as BxUserDto
    };
  },
  mounted(): any {
    let userStore = useUserStore();
    this.user = userStore.getUser;

    this.form.email = this.user.email ?? '';
    this.form.client = this.user.fullName ?? '';
    this.form.inn = this.user.inn ?? 0;
    this.form.bik = this.user.bik ?? 0;
    this.form.kpp = this.user.kpp ?? 0;
    this.form.ogrn = this.user.ogrn ?? 0;
    this.form.currAccount = this.user.currAccount ?? 0;
    this.form.corrAccount = this.user.corrAccount ?? 0;
    this.form.postAddress = this.user.postAddress ?? '';
    this.form.legalAddress = this.user.legalAddress ?? '';
    this.form.bankName = this.user.bankName ?? '';
  },
  methods: {
    submitForm: function () {
      let api = new CraftApi();


      let body: ClaimCreateRequestDto = {
        buildObjectId: this.buildObjectId,
        userId: this.user.id,
        email: this.form.email,
        phone: this.form.phone,
        client: this.form.client,
        bik: this.form.bik ?? 0,
        kpp: this.form.kpp ?? 0,
        inn: this.form.inn ?? 0,
        ogrn: this.form.ogrn ?? 0,
        currAccount: this.form.currAccount ?? 0,
        corrAccount: this.form.corrAccount ?? 0,
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
          } else if (error) {
            AlertService.showErrorAlert('Отправка заявки', error);
          }

        });
    },
  },
  props: {
    buildObjectId: {
      type: Number,
      default: 0,
    },
    modelValue: {
      type: Boolean,
      default: false,
    },
  }
})
</script>

<template>
  <v-dialog max-width="500" v-model="modelValue">
    <template v-slot:default="{ isActive }">
      <v-card title="Заявка на покупку квартиры">

        <v-form @submit.prevent="submitForm">

          <v-card-text>
            Заполните недостающие данные и отправьте заявку нажав кнопку "Отправить"
          </v-card-text>

          <v-container>
            <v-row>
              <v-col cols="12">
                <v-text-field type="text" label="Телефон" v-model="form.phone" required/>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="12">
                <v-text-field type="text" label="E-Mail" v-model="form.email" required/>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="12">
                <v-text-field type="text" label="ФИО" v-model="form.client" required/>
              </v-col>
            </v-row>


            <v-card-subtitle>Юридические данные</v-card-subtitle>
            <v-row>
              <v-col cols="12">
                <v-text-field type="text" label="ИНН" v-model="form.inn" required/>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="12">
                <v-text-field type="text" label="ОГРН/ОГРНИП" v-model="form.ogrn" required/>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="12">
                <v-text-field type="text" label="КПП" v-model="form.kpp" required/>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="12">
                <v-text-field type="text" label="БИК" v-model="form.bik" required/>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="12">
                <v-text-field type="text" label="Расчетный счет" v-model="form.currAccount" required/>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="12">
                <v-text-field type="text" label="Корреспондентский счет" v-model="form.corrAccount" required/>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="12">
                <v-text-field type="text" label="Юридический адрес" v-model="form.legalAddress" required/>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="12">
                <v-text-field type="text" label="Почтовый адрес" v-model="form.postAddress" required/>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="12">
                <v-text-field type="text" label="Наименование банка" v-model="form.bankName" required/>
              </v-col>
            </v-row>
          </v-container>

          <v-card-actions>
            <v-spacer></v-spacer>

            <v-btn type="submit">Отправить</v-btn>

            <v-btn
              text="Отмена"
              @click="()=>{$emit('update:modelValue', false)}"
            ></v-btn>
          </v-card-actions>
        </v-form>


      </v-card>
    </template>
  </v-dialog>
</template>

<style scoped>

</style>
