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
    showModal: {
      type: Boolean,
    },
    apartmentId: {
      type: Number,
      default: 0,
    },
  },
  computed: {
    _showModal: {
      get(): boolean {
        return this.showModal;
      },
      set(value: boolean) {
        console.log('asd', value);
        this._showModalData = value;
        this.$emit('update:modelValue', value);
      }
    }
  },
})
</script>

<template>
  <v-dialog max-width="500" v-model="_showModal">
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
