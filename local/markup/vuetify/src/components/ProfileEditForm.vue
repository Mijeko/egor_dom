<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import type ProfileEditUserDataDto from "../dto/ProfileEditUserDataDto.ts";

export default defineComponent({
  name: "ProfileEditForm",
  props: {
    userData: {
      type: Object as PropType<ProfileEditUserDataDto>,
      default: {},
    }
  },
  mounted(): any {
    console.log(this.userData);
  },
  data() {
    return {
      tab: null,
      valid: false,
      form: {
        NAME: this.userData.name,
        LAST_NAME: this.userData.family,
        SECOND_NAME: this.userData.last_name,
        UF_CORR_ACC: this.userData.uf_corr_acc,
        UF_OGRN: this.userData.uf_ogrn,
        UF_INN: this.userData.uf_inn,
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
  <v-form v-model="valid">

    <v-tabs
      v-model="tab"
      align-tabs="center"
      color="deep-purple-accent-4"
    >
      <v-tab value="pers">Персональные данные</v-tab>
      <v-tab v-if="userData.profileType =='realtor'" value="jur">Юридические данные</v-tab>
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
        v-if="userData.profileType =='realtor'"
        value="jur"
      >
        <v-text-field
          v-model="form.UF_INN"
          :counter="11"
          label="ИНН"
          required
        ></v-text-field>
        <v-text-field
          v-model="form.UF_CORR_ACC"
          :counter="10"
          label="Корреспондентский счёт"
          required
        ></v-text-field>
        <v-text-field
          v-model="form.UF_OGRN"
          label="ОГРН"
          required
        ></v-text-field>
      </v-tabs-window-item>
    </v-tabs-window>


  </v-form>

  <v-btn
    class="me-4"
    type="submit"
  >
    Изменить
  </v-btn>
</template>

<style scoped>

</style>
