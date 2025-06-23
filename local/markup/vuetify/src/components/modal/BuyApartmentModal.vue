<script lang="ts">
import {defineComponent} from 'vue'

export default defineComponent({
  name: "BuyApartmentModal",
  props: {
    modelValue: {
      type: Boolean,
      default: false,
    }
  }
})
</script>

<template>
  <v-dialog max-width="500" v-model="modelValue">
    <template v-slot:default="{ isActive }">
      <v-card title="Заявка на покупку квартиры">
        <v-card-text>
          Заполните недостающие данные и отправьте заявку нажав кнопку "Отправить"
        </v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>

          <v-btn type="button">Отправить</v-btn>

          <v-btn
            text="Отмена"
            @click="()=>{$emit('update:modelValue', false)}"
          ></v-btn>
        </v-card-actions>
      </v-card>
    </template>
  </v-dialog>
</template>

<style scoped>

</style>
