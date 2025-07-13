<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import type ClaimDto from "@/dto/entity/ClaimDto.ts";
import Price from "../core/Price.ts";
import {th} from "vuetify/locale";
import ClaimStatus from "@/components/part/ClaimStatus.vue";

export default defineComponent({
  name: "ClaimDetail",
  components: {ClaimStatus},
  props: {
    claim: {
      type: Object as PropType<ClaimDto>,
      default: null
    }
  },
  computed: {
    Price() {
      return Price
    },
    currentImage(): string | null {

      let image = this.claim.apartment.planImages?.shift();

      if (image) {
        return image.src;
      }

      return null;
    },
    personalData(): Array<any> {
      let personal: any[] = [];

      personal.push({title: 'ФИО', value: this.claim.clientName});
      personal.push({title: 'Телефон', value: this.claim.phone});
      personal.push({title: 'E-Mail', value: this.claim.email});
      personal.push({title: 'БИК', value: this.claim.bik});
      personal.push({title: 'ОГРН', value: this.claim.ogrn});
      personal.push({title: 'КПП', value: this.claim.kpp});
      personal.push({title: 'ИНН', value: this.claim.inn});
      personal.push({title: 'Корреспондентский счет', value: this.claim.corrAcc});
      personal.push({title: 'Рассчетный счет', value: this.claim.currAcc});
      personal.push({title: 'Почтовый адрес', value: this.claim.postAddress});
      personal.push({title: 'Юридический адрес', value: this.claim.legalAddress});

      return personal;
    }
  },
  mounted(): any {
    console.log(this.claim);
  }
})
</script>

<template>

  <v-row>
    <v-col cols="4">
      <v-card class="pa-3">
        <v-card-title>№ заявки</v-card-title>
        <v-card-subtitle>{{ claim.id }}</v-card-subtitle>
        <v-card-title>Дата создания</v-card-title>
        <v-card-subtitle>{{ claim.createdAt }}</v-card-subtitle>
        <v-card-title>Статус</v-card-title>
        <v-card-subtitle>
          <ClaimStatus :status="claim.status"/>
        </v-card-subtitle>
        <v-card-title>Стоимость</v-card-title>
        <v-card-subtitle>{{ Price.format(claim.apartment.price) }}</v-card-subtitle>
        <v-card-title>Жилой объект</v-card-title>
        <v-card-subtitle>
          <a :href="`/objects/${claim.apartment.buildObject.id}/`">{{ claim.apartment.buildObject.name }}</a>
        </v-card-subtitle>
      </v-card>
    </v-col>

    <v-col cols="4">
      <v-card class="pa-3">
        <h2>Ваши данные</h2>

        <div v-for="personalItem in personalData">
          <v-card-title>{{ personalItem.title }}</v-card-title>
          <v-card-subtitle>{{ personalItem.value }}</v-card-subtitle>
        </div>

      </v-card>
    </v-col>

    <v-col cols="4">
      <v-card class="pa-3">
        <h2>Покупаемый объект</h2>
        <v-img v-if="currentImage" :src="currentImage"></v-img>
        <v-card-title>{{ claim.apartment.name }}</v-card-title>
      </v-card>
    </v-col>
  </v-row>
</template>

<style>

</style>
