<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import type ProfileEditUserDataDto from "../dto/ProfileEditUserDataDto.ts";

export default defineComponent({
  name: "ProfileEditForm",
  props: {
    userData: Object as PropType<ProfileEditUserDataDto>
  },
  mounted(): any {
    // console.log(this.userData);
  },
  data: () => ({
    valid: false,
    form: {
      UF_CORR_ACC: '',
      UF_KPP: '',
      UF_INN: '',
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
  }),
})
</script>

<template>
  <v-form v-model="valid">
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
      v-model="form.UF_KPP"
      label="КПП"
      required
    ></v-text-field>
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
