<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import type ApartmentDto from "@/dto/entity/ApartmentDto.ts";
import BuyApartmentModal from "@/components/modal/BuyApartmentModal.vue";
import ApartmentItem from "@/components/ApartmentItem.vue";

export default defineComponent({
  name: "ApartmentList",
  components: {ApartmentItem, BuyApartmentModal},
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


  <v-row>
    <v-col cols="3" v-for="apartment in apartments">
      <ApartmentItem
        :apartment
      />
    </v-col>
  </v-row>


  <BuyApartmentModal
    v-model="openModal"
    :build-object-id="selectBuildObjectId"
  />

</template>

<style scoped>

</style>
