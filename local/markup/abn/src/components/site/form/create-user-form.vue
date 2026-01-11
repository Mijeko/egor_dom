<script lang="ts">
import {defineComponent} from 'vue'
import BlockParams from "@/components/site/form/element/new-user/block-params.vue";

export interface GroupItemDto {
  id: number;
  code: string;
  name: string;
}

export default defineComponent({
  name: "CreateUserForm",
  components: {BlockParams},
  data: () => {
    return {
      isFormValid: false,
      form: {
        group: [],
        base: {
          phone: null,
          email: null,
          password: null,
        },
        realtor: {},
        developer: {
          companyName: null,
          inn: null,
          ogrn: null,
          legalAddress: null,
          contactPerson: null,
          tariff: null,
        },
        lawyer: {},
      },
      validate: {},
    };
  },
  computed: {
    groupList: {
      set() {
      },
      get(): GroupItemDto[] {
        return [
          {id: 1, code: 'buyer', name: 'Пользователь'},
          {id: 2, code: 'realtor', name: 'Риэлтор'},
          {id: 3, code: 'developer', name: 'Застройщик'},
          {id: 4, code: 'law', name: 'Юрист'},
          {id: 4, code: 'agency', name: 'Агенство'},
        ];
      },
    }
  }
})
</script>

<template>
  <v-form v-model="isFormValid" class="create-user-form">

    <v-select
      v-model="form.group"
      clearable
      chips
      label="Группа пользователя"
      :items="groupList"
      itemValue="code"
      itemTitle="name"
      multiple
      variant="outlined"
    ></v-select>


    <!--  base start  -->
    <BlockParams label="Базовые настройки">
      <ModernPhone :hideIcon="true" v-model="form.base.phone" label="Номер телефона"/>
      <IconInput :hideIcon="true" v-model="form.base.email" label="E-Mail адрес"/>
      <IconInput :hideIcon="true" v-model="form.base.password" label="Пароль"/>
    </BlockParams>
    <!--  base end    -->


    <div v-for="(group, index) in form.group">

      <BlockParams :label="`Настройки для ${group}`" v-if="group=='developer'">
      </BlockParams>
      <BlockParams :label="`Настройки для ${group}`" v-else-if="group=='law'">
      </BlockParams>
      <BlockParams :label="`Настройки для ${group}`" v-else-if="group=='realtor'">
      </BlockParams>
      <BlockParams :label="`Настройки для ${group}`" v-else-if="group=='agency'">
      </BlockParams>
    </div>

    <SButton type="submit">Добавить</SButton>
  </v-form>
</template>

<style lang="scss">
.create-user-form {
  display: flex;
  flex-direction: column;
  gap: 15px;
}
</style>
