<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import BuyApartmentForm from "@/components/form/BuyApartmentForm.vue";
import type ManagerDto from "@/dto/entity/ManagerDto.ts";

export default defineComponent({
  name: "ContactPersonalManager",
  components: {BuyApartmentForm},
  data: function () {
    return {
      showModal: false
    };
  },
  props: {
    modelValue: {
      type: Boolean,
      default: false
    },
    manager: {
      type: Object as PropType<ManagerDto>
    }
  },
  computed: {
    showModalComputed: {
      set(value: boolean) {
        this.$emit('update:modelValue', value);
      },
      get(): boolean {
        return this.modelValue;
      },
    }
  }
})
</script>

<template>
  <v-dialog max-width="500" v-model="showModalComputed">
    <v-card>
      <v-card-title class="text-center">Нужна помощь?</v-card-title>
      <v-card-subtitle class="text-center">
        Можете заказать звонок, позвонить напрямую или найти ответ самостоятельно
      </v-card-subtitle>

      <v-card-text class="mt-5">
        <v-list>
          <v-list-item v-for="phone in manager?.phones">
            <template v-slot:prepend>
              <v-avatar
                class="me-4 mt-2"
                rounded="0"
              >
                <v-icon icon="$phone"/>
              </v-avatar>
            </template>

            <v-list-item-title
              class="text-uppercase font-weight-regular text-caption"
              v-text="phone.phone"
            ></v-list-item-title>
          </v-list-item>
        </v-list>
      </v-card-text>
    </v-card>
  </v-dialog>
</template>

<style lang="scss">

</style>
