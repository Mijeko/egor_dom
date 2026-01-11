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
      <div class="create-user-form-layer">
        <ModernPhone :hideIcon="true" v-model="form.base.phone" label="Номер телефона"/>
        <IconInput :hideIcon="true" v-model="form.base.email" label="E-Mail адрес"/>
        <IconInput :hideIcon="true" v-model="form.base.password" label="Пароль"/>
      </div>
    </BlockParams>
    <!--  base end    -->


    <BlockParams :label="`Настройки для ${group}`" v-for="(group, index) in form.group">

      <div v-if="group=='developer'" class="create-user-form-layer">
        <IconInput :hideIcon="true" v-model="form.developer.companyName" label="Именование"/>
        <IconInput :hideIcon="true" v-model="form.developer.contactPerson" label="Имя менеджера"/>
        <IconInput :hideIcon="true" v-model="form.developer.inn" label="ИНН"/>
        <IconInput :hideIcon="true" v-model="form.developer.ogrn" label="ОГРН"/>
        <IconInput :hideIcon="true" v-model="form.developer.legalAddress" label="Юридический адрес"/>
        <IconInput :hideIcon="true" v-model="form.developer.tariff" label="Тариф?"/>
      </div>

      <div v-else-if="group=='law'" class="create-user-form-layer">
        law
      </div>
      <div v-else-if="group=='realtor'" class="create-user-form-layer">
        realtor
      </div>
      <div v-else-if="group=='agency'" class="create-user-form-layer">
        agency
      </div>

    </BlockParams>

    <SButton type="submit">Добавить</SButton>
  </v-form>
</template>

<style lang="scss">
.create-user-form {
  display: flex;
  flex-direction: column;
  gap: 15px;

  &-layer {
    display: flex;
    flex-direction: column;
    gap: 15px;
  }
}
</style>
