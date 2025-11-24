<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import {vMaska} from "maska/vue";

export default defineComponent({
  name: "PhoneInput",
  props: {
    modelValue: {
      type: [String, Number, null, Boolean, Array, Object],
      default: null
    },
    label: {
      type: String
    },
    rules: {
      type: Array as PropType<any[]>,
      default: []
    },
    required: {
      type: Boolean,
      default: false
    },
  },
  directives: {
    maska: vMaska as any
  },
  computed: {
    computedValue: {
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
  <v-text-field
    v-maska="'+7 (###) ### ##-##'"
    v-model="computedValue"
    :rules
    :label
  />
</template>

<style scoped>

</style>
