<script lang="ts">
import {defineComponent} from 'vue'
import BuyApartmentForm from "@/components/BuyApartmentForm.vue";

export default defineComponent({
  name: "BuyApartmentModal",
  components: {BuyApartmentForm},
  props: {
    buildObjectId: {
      type: Number,
      default: 0,
    },
    modelValue: {
      type: Boolean,
      default: false,
    },
  }
})
</script>

<template>
  <v-dialog max-width="500" v-model="modelValue">
    <template v-slot:default="{ isActive }">
      <v-card title="Заявка на покупку квартиры">


        <BuyApartmentForm
          :build-object-id="buildObjectId"
        />

      </v-card>
    </template>
  </v-dialog>
</template>

<style scoped>

</style>
