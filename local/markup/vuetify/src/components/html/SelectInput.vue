<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import type SelectVariantDto from "@/dto/present/component/SelectVariantDto.ts";

export default defineComponent({
  name: "SelectInput",
  props: {
    modelValue: {
      type: [null, String],
      default: null
    },
    label: {
      type: String
    },
    placeholder: {
      type: String
    },
    rules: {
      type: Array as PropType<any[]>,
      default: []
    },
    items: {
      type: Array as PropType<SelectVariantDto[]>,
      default: []
    }
  },
  computed: {
    compModelValue: {
      set(value: any) {
        this.$emit('update:modelValue', value);
      },
      get() {
        return this.modelValue;
      },
    }
  }
})
</script>

<template>
  <v-select
    v-model="compModelValue"
    :label="placeholder"
    :items="items"
    :rules
    item-title="label"
    item-value="value"
    variant="outlined"
  ></v-select>
</template>

<style scoped>

</style>
