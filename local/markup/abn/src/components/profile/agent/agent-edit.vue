<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import type BxUserDto from "@/dto/bitrix/BxUserDto.ts";
import type ClaimDto from "@/dto/entity/ClaimDto.ts";
import GuestUserInformation from "@/components/guest-user-information.vue";
import PhoneInput from "@/components/site/form/element/phone-input.vue";
import type GuestUserInfoItemDto from "@/dto/present/component/ManagerEditDescriptionItemDto.ts";
import ClaimList from "@/components/profile/element/claim-list.vue";

export default defineComponent({
  name: "AgentEdit",
  components: {ClaimList, PhoneInput, GuestUserInformation},
  props: {
    agent: {
      type: Object as PropType<BxUserDto>,
      default: null
    },
    orders: {
      type: Array as PropType<ClaimDto[]>,
      default: null
    }
  },
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
  methods: {
    submitForm() {
      if (!this.isFormValid) {
        return;
      }
    }
  },
  computed: {
    descriptionItems: function (): GuestUserInfoItemDto[] {
      let items: GuestUserInfoItemDto[] = [];

      items.push({label: 'Телефон', value: this.agent.phone} as GuestUserInfoItemDto);
      items.push({label: 'E-Mail', value: this.agent.email} as GuestUserInfoItemDto);
      items.push({
        label: 'ФИО', value: this.agent.fullName ?? [
          this.agent.lastName,
          this.agent.name,
          this.agent.secondName,
        ].join(' ')
      } as GuestUserInfoItemDto);

      return items;
    }
  },
})
</script>

<template>
  <v-row class="mt-7">
    <v-col cols="6">
      <GuestUserInformation
        :profile-avatar="agent.avatar?.src"
        :profile-name="agent.fullName"
        :list-info="descriptionItems"
      />

      <ClaimList
        :claims="orders"
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
