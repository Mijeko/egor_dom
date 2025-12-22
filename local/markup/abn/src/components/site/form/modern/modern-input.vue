<script lang="ts">
import {defineComponent} from 'vue'

export default defineComponent({
  name: "ModernInput",
  props: {
    modelValue: {},
    rules: {},
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
    v-model="modelValue"
    :rules
  />
</template>

<style scoped>

</style>
