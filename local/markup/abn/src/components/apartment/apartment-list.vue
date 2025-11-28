<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import type ApartmentDto from "@/dto/entity/ApartmentDto.ts";
import BuyApartmentModal from "@/components/site/modal/buy-apartment-modal.vue";
import ApartmentItem from "@/components/apartment/apartment-item.vue";

export default defineComponent({
  name: "ApartmentList",
  components: {ApartmentItem, BuyApartmentModal},
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
  
</template>

<style scoped>

</style>
