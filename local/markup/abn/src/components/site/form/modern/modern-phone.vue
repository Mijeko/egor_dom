<script lang="ts">
import {defineComponent} from 'vue'
import {vMaska} from "maska/vue";

export default defineComponent({
  name: "ModernPhone",
  props: {
    modelValue: {},
    label: {
      type: String
    },
    rules: {},
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
