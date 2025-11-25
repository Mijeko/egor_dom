<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import type BxUserDto from "@/dto/bitrix/BxUserDto.ts";
import PhoneInput from "@/components/site/form/element/phone-input.vue";
import type ManagerEditDescriptionItemDto from "@/dto/present/component/ManagerEditDescriptionItemDto.ts";
import GuestUserInformation from "@/components/guest-user-information.vue";

export default defineComponent({
  name: "ManagerEdit",
  components: {GuestUserInformation, PhoneInput},
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
  },
  methods: {
    submitForm() {
      if (!this.isFormValid) {
        return;
      }
    }
  },
  computed: {
    descriptionItems: function (): ManagerEditDescriptionItemDto[] {
      let items: ManagerEditDescriptionItemDto[] = [];

      items.push({label: 'Телефон', value: this.manager.phone} as ManagerEditDescriptionItemDto);
      items.push({label: 'E-Mail', value: this.manager.email} as ManagerEditDescriptionItemDto);
      items.push({
        label: 'ФИО', value: this.manager.fullName ?? [
          this.manager.lastName,
          this.manager.name,
          this.manager.secondName,
        ].join(' ')
      } as ManagerEditDescriptionItemDto);

      return items;
    }
  }
})
</script>

<template>
  <v-row class="mt-7">
    <v-col cols="6">
      <GuestUserInformation
        :profile-avatar="manager.avatar?.src"
        :profile-name="manager.fullName"
        :list-info="descriptionItems"
      />
    </v-col>
    <v-col cols="6">
      <v-form v-model="isFormValid" @submit.prevent="submitForm">
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
            <PhoneInput v-model="form.phone" :rules="validate.phone" placeholder="Номер телефона"/>
          </v-col>
          <v-col cols="6">
            <v-text-field v-model="form.email" :rules="validate.email" placeholder="E-Mail"/>
          </v-col>
        </v-row>


        <v-btn type="submit">Обновить</v-btn>
      </v-form>
    </v-col>
  </v-row>
</template>

<style scoped>

</style>
