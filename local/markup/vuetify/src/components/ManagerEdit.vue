<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import type BxUserDto from "@/dto/bitrix/BxUserDto.ts";
import PhoneInput from "@/components/html/PhoneInput.vue";

export default defineComponent({
  name: "ManagerEdit",
  components: {PhoneInput},
  data: function () {
    return {
      isFormValid: false,
      form: {
        name: null,
        lastName: null,
        secondName: null,
        phone: null,
        email: null,
      },
      validate: {
        name: [],
        lastName: [],
        secondName: [],
        phone: [],
        email: [],
      },
    };
  },
  props: {
    manager: {
      type: Object as PropType<BxUserDto>,
      default: null
    }
  }
})
</script>

<template>
  <v-row>
    <v-col cols="6">
      <v-avatar
        v-if="manager.avatar?.src"
        :image="manager.avatar?.src"
      />
    </v-col>
    <v-col cols="6">
      <v-form>
        <v-row>
          <v-col cols="4">
            <v-text-field v-model="form.lastName" :rules="validate.lastName" placeholder="Фамилия"/>
          </v-col>
          <v-col cols="4">
            <v-text-field v-model="form.name" :rules="validate.name" placeholder="Имя"/>
          </v-col>
          <v-col cols="4">
            <v-text-field v-model="form.secondName" :rules="validate.secondName" placeholder="Отчество"/>
          </v-col>
        </v-row>

        <v-row>
          <v-col cols="6">
            <PhoneInput v-model="form.phone" :rules="validate.phone"/>
          </v-col>
          <v-col cols="6">
            <v-text-field v-model="form.email" :rules="validate.email" placeholder="E-Mail"/>
          </v-col>
        </v-row>

      </v-form>
    </v-col>
  </v-row>
</template>

<style scoped>

</style>
