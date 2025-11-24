<script lang="ts">
import {defineComponent} from 'vue'
import BuyApartmentForm from "@/components/site/form/buy-apartment-form.vue";

export default defineComponent({
  name: "BuyApartmentModal",
  components: {BuyApartmentForm},
  props: {
    modelValue: {
      type: Boolean,
      default: false
    },
    apartmentId: {
      type: Number,
      default: 0,
    },
  },
  computed: {
    showModalComputed: {
      get(): boolean {
        return this.modelValue;
      },
      set(value: boolean) {
        this.$emit('update:modelValue', value);
      }
    }
  },
})
</script>

<template>
  <v-dialog max-width="500" v-model="showModalComputed">
    <template v-slot:default="{ isActive }">
      <v-card title="Заявка на покупку квартиры">


        <BuyApartmentForm
          :apartment-id="apartmentId"
          v-model="modelValue"
        />

      </v-card>
    </template>
  </v-dialog>
</template>

<style scoped>

</style>
