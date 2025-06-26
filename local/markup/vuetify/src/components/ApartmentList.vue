<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import type ApartmentDto from "@/dto/entity/ApartmentDto.ts";
import BuyApartmentModal from "@/components/modal/BuyApartmentModal.vue";

export default defineComponent({
  name: "ApartmentList",
  components: {BuyApartmentModal},
  data: function () {
    return {
      selectBuildObjectId: 0,
      openModal: false,
    };
  },
  props: {
    apartments: {
      type: Array as PropType<ApartmentDto[]>,
      default: []
    }
  }
})
</script>

<template>


  <v-card v-for="apart in apartments" class="mb-3">
    <v-row>
      <v-col md="9" class="pa-5">
        <v-card-title>{{ apart.name }} {{apart.buildObjectId}}</v-card-title>
        <v-card-subtitle>{{ apart.price }}</v-card-subtitle>
      </v-col>
      <v-col md="3" class="pa-5">
        <v-btn @click.prevent="()=>{ selectBuildObjectId=apart.buildObjectId;openModal=true;}">Купить</v-btn>
      </v-col>
    </v-row>
  </v-card>


  <BuyApartmentModal
    v-model="openModal"
    :build-object-id="selectBuildObjectId"
  />

</template>

<style scoped>

</style>
