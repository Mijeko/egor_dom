<script lang="ts">
import {defineComponent} from 'vue'
import BuyApartmentForm from "@/components/BuyApartmentForm.vue";

export default defineComponent({
  name: "BuyApartmentModal",
  components: {BuyApartmentForm},
  data: function () {
    return {
      selectApartmentId: null,
    };
  },
  computed: {
    selectApartmentId: {
      set(val: number) {
        this.selectApartmentId = val;
        this.$emit('@update:apartmentId', val);
      },
      get(): number {
        return this.selectApartmentId;
      },
    }
  },
  props: {
    apartmentId: {
      type: Number,
      default: 0,
    },
    showModal: {
      type: Boolean,
      default: false,
    },
  }
})
</script>

<template>
  <v-dialog max-width="500" v-model="showModal">
    <template v-slot:default="{ isActive }">
      <v-card title="Заявка на покупку квартиры">


        <BuyApartmentForm
          :apartment-id="selectApartmentId"
          @update:apartmentId="selectApartmentId = $event"
        />

      </v-card>
    </template>
  </v-dialog>
</template>

<style scoped>

</style>
