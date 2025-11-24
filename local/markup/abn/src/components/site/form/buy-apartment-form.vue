<script lang="ts">
import {defineComponent} from 'vue'
import AlertService from "@/service/AlertService.ts";
import {useUserStore} from "@/stores/app.ts";
import type BxUserDto from "@/dto/bitrix/BxUserDto.ts";
import ValidateLegalData from "@/core/validate/validate-legal-data.ts";
import ClaimService from "@/service/ClaimService.ts";
import type ClaimCreateResponseDto from "@/dto/response/ClaimCreateResponseDto.ts";
import PhoneInput from "@/components/site/form/element/phone-input.vue";
import type ClaimCreateShortRequestDto from "@/dto/request/ClaimCreateShortRequestDto.ts";

export default defineComponent({
  name: "BuyApartmentForm",
  components: {PhoneInput},
  data: function () {
    return {
      form: {
        email: '',
        phone: '',
        client: '',
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
    modelValue: {
      type: Boolean,
      default: false,
    },
    apartmentId: {
      type: Number,
      default: 0,
    },
  },
  mounted(): any {
    let userStore = useUserStore();
    this.user = userStore.getUser;

    this.form.phone = this.user.phone ?? '';
    this.form.email = this.user.email ?? '';
    this.form.client = this.user.fullName ?? '';
  },
  methods: {
    submitForm: function () {

      if (!this.isFormValid) {
        return;
      }

      let body: ClaimCreateShortRequestDto = {
        apartmentId: this.apartmentId,
        userId: this.user.id,
        email: this.form.email,
        phone: this.form.phone,
        client: this.form.client,
      };

      let service = new ClaimService();
      service.createClaim(body)
        .then((response: ClaimCreateResponseDto) => {

          let {status} = response;

          if (status === 'success') {
            AlertService.showAlert('Отправка заявки', 'Ваша заявка успешно отправлена');
            this.$emit('update:modelValue', false);

            this.form.email = '';
            this.form.client = '';
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
          <PhoneInput
            label="Телефон"
            v-model="form.phone"
            :rules="validate.phone"
            required
          />
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
