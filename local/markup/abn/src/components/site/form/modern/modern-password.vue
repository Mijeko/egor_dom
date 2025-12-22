<script lang="ts">
import {defineComponent} from 'vue'

export default defineComponent({
  name: "ModernPassword",
  props: {
    modelValue: {
      type: [String, Number, null, Boolean, Array, Object],
      default: null
    },
    rules: {
      type: Array as PropType<any[]>,
      default: []
    },
  },
  computed: {
    modelValueComp: {
      set(value: any) {
        this.$emit('update:modelValue', value);
      },
      get(): any {
        return this.modelValue;
      },
    }
  },
})
</script>

<template>
  <v-text-field
    type="password"
    v-model="modelValueComp"
    :rules
  />
</template>

<style scoped>

</style>
