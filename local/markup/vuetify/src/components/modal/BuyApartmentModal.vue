<script lang="ts">
import {defineComponent} from 'vue'
import BuyApartmentForm from "@/components/form/BuyApartmentForm.vue";

export default defineComponent({
  name: "BuyApartmentModal",
  components: {BuyApartmentForm},
  data: function () {
    return {
      _showModalData: false
    };
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
  },
  computed: {
    _showModal: {
      get(): boolean {
        return this._showModalData;
      },
      set(value: boolean) {
        this._showModalData = value;
        this.$emit('update:modelValue', value);
      }
    }
  }
})
</script>

<template>
  <v-dialog max-width="500" v-model="showModal">
    <template v-slot:default="{ isActive }">
      <v-card title="Заявка на покупку квартиры">


        <BuyApartmentForm
          :apartment-id="apartmentId"
          v-model="_showModal"
        />

      </v-card>
    </template>
  </v-dialog>
</template>

<style scoped>

</style>
