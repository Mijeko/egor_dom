<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import type ProfileEditUserDataDto from "@/dto/ProfileEditUserDataDto.ts";
import UserService from "@/service/User/UserService.ts";
import type ProfileUpdateDto from "@/dto/ProfileUpdateDto.ts";
import AlertService from "@/service/AlertService.ts";

export default defineComponent({
  name: "ProfileEditForm",
  props: {
    userData: {
      type: Object as PropType<ProfileEditUserDataDto>,
      default: {},
    }
  },
  methods: {
    submitForm() {
      if (!this.valid) {
        return;
      }

      let service = new UserService();
      let body: ProfileUpdateDto = {...this.form, profileId: this.userData.id};

      service.profileUpdate(body)
        .then((data: any) => {
          let {result} = data;
          let {success, error, message} = result;

          if (success && message) {
            AlertService.showAlert('Обновление профиля', message);
          }

          if (error) {
            AlertService.showErrorAlert('Обновление профиля', error);
          }
        })
    },
    isJurPerson(): boolean {
      return this.userData.profileType === 'jur';
    },
  },
  data() {
    return {
      tab: null,
      valid: false,
      form: {
        NAME: this.userData.name,
        LAST_NAME: this.userData.family,
        SECOND_NAME: this.userData.last_name,
        UF_OGRN: this.userData.uf_ogrn,
        UF_INN: this.userData.uf_inn,
        UF_KPP: this.userData.uf_kpp,
        UF_BIK: this.userData.uf_bik,
        UF_POSTAL_ADDRESS: this.userData.uf_post_address,
        UF_LEGAL_ADDRESS: this.userData.uf_legal_address,
        UF_BANK_NAME: this.userData.uf_bank_name,
        UF_CURR_ACC: this.userData.uf_curr_acc,
        UF_CORR_ACC: this.userData.uf_corr_acc,
      },
      rules: {
        nameRules: [
          (value: string) => {
            if (value) return true

            return 'Name is required.'
          },
          (value: string) => {
            if (value?.length <= 10) return true

            return 'Name must be less than 10 characters.'
          },
        ],
        emailRules: [
          (value: string) => {
            if (value) return true

            return 'E-mail is required.'
          },
          (value: string) => {
            if (/.+@.+\..+/.test(value)) return true

            return 'E-mail must be valid.'
          },
        ],
      },
    }
  },
})
</script>

<template>
  <v-form v-model="valid" @submit.prevent="submitForm">

    <v-tabs
      v-model="tab"
      align-tabs="center"
      color="deep-purple-accent-4"
    >
      <v-tab value="pers">Персональные данные</v-tab>
      <v-tab v-if="isJurPerson()" value="jur">Юридические данные</v-tab>
    </v-tabs>

    <v-tabs-window v-model="tab">
      <v-tabs-window-item
        value="pers"
      >
        <v-text-field
          v-model="form.NAME"
          label="Имя"
          required
        ></v-text-field>
        <v-text-field
          v-model="form.LAST_NAME"
          label="Фамилия"
          required
        ></v-text-field>
        <v-text-field
          v-model="form.SECOND_NAME"
          label="Отчество"
          required
        ></v-text-field>
      </v-tabs-window-item>


      <v-tabs-window-item
        v-if="isJurPerson()"
        value="jur"
      >
        <v-text-field
          v-model="form.UF_INN"
          :counter="isJurPerson() ? 10 : 12"
          label="ИНН"
          required
        ></v-text-field>
        <v-text-field
          v-model="form.UF_OGRN"
          :counter="isJurPerson() ? 13 : 15"
          label="ОГРН"
          required
        ></v-text-field>
        <v-text-field
          v-model="form.UF_BIK"
          :counter="9"
          label="БИК"
          required
        ></v-text-field>
        <v-text-field
          v-model="form.UF_KPP"
          :counter="9"
          label="КПП"
          required
        ></v-text-field>
        <v-text-field
          v-model="form.UF_CURR_ACC"
          :counter="20"
          label="Лицевой счёт"
          required
        ></v-text-field>
        <v-text-field
          v-model="form.UF_CORR_ACC"
          :counter="20"
          label="Корреспондентский счёт"
          required
        ></v-text-field>
        <v-text-field
          v-model="form.UF_BANK_NAME"
          label="Наименование банка"
          required
        ></v-text-field>
        <v-text-field
          v-model="form.UF_POSTAL_ADDRESS"
          label="Почтовый адрес"
          required
        ></v-text-field>
        <v-text-field
          v-model="form.UF_LEGAL_ADDRESS"
          label="Юридический адрес"
          required
        ></v-text-field>
      </v-tabs-window-item>
    </v-tabs-window>


    <v-btn
      class="me-4"
      type="submit"
    >
      Изменить
    </v-btn>
  </v-form>

</template>

<style scoped>

</style>
