<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import type ApartmentDto from "@/dto/entity/ApartmentDto.ts";
import BuyApartmentModal from "@/components/modal/BuyApartmentModal.vue";
import ApartmentItem from "@/components/ApartmentItem.vue";
import ApartmentFilter from "@/components/ApartmentFilter.vue";

export default defineComponent({
  name: "ApartmentList",
  components: {ApartmentFilter, ApartmentItem, BuyApartmentModal},
  data: function () {
    return {
      selectApartmentId: 0,
      showModal: false,
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
        :show-modal="showModal"
        @update:showModal="showModal = $event"
      />
    </v-col>
  </v-row>


  <BuyApartmentModal
    :show-modal="showModal"
    @update:showModal="showModal = $event"
    @update:apartmentId="selectApartmentId = $event"
    :apartment-id="selectApartmentId"
  />

</template>

<style scoped>

</style>
