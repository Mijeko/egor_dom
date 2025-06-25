<script lang="ts">
import {defineComponent} from 'vue'
import {useUserStore} from "@/store.ts";
import type BxUserDto from "@/dto/bitrix/BxUserDto.ts";
import CraftApi from "@/service/CraftApi.ts";

export default defineComponent({
  name: "BuyApartmentModal",
  data: function () {
    return {
      user: {} as BxUserDto
    };
  },
  mounted(): any {
    let userStore = useUserStore();
    this.user = userStore.getUser;
  },
  methods: {
    submitForm: function () {
      let api = new CraftApi();
      api.post('claim.create', new FormData())
        .then((response: any) => response.json())
        .then((response: any) => {
          console.log(response);

          this.$emit('update:modelValue', false)
        });
    },
  },
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

        <v-form @submit.prevent="submitForm">

          <v-card-text>
            Заполните недостающие данные и отправьте заявку нажав кнопку "Отправить"
          </v-card-text>

          <v-container>
            <v-row>
              <v-col cols="12">
                <v-text-field type="text" label="Телефон" required/>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="12">
                <v-text-field type="text" label="E-Mail" required/>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="12">
                <v-text-field type="text" label="ФИО" required/>
              </v-col>
            </v-row>
          </v-container>

          <v-card-actions>
            <v-spacer></v-spacer>

            <v-btn type="submit">Отправить</v-btn>

            <v-btn
              text="Отмена"
              @click="()=>{$emit('update:modelValue', false)}"
            ></v-btn>
          </v-card-actions>
        </v-form>


      </v-card>
    </template>
  </v-dialog>
</template>

<style scoped>

</style>
