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

  {{ showModal }}
  {{ selectApartmentId }}

  <v-row>
    <v-col cols="12" sm="6" md="4" lg="3" v-for="apartment in apartments">
      <ApartmentItem
        :apartment
        v-model="showModal"
        @update:apartment-id="selectApartmentId = $event"
      />
    </v-col>
  </v-row>


  <BuyApartmentModal
    v-model="showModal"
    :show-modal
    :apartment-id="selectApartmentId"
  />

</template>

<style scoped>

</style>
