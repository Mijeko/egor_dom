<script lang="ts">
import {defineComponent} from 'vue'

export default defineComponent({
  name: "ModernPassword",
  props: {
    modelValue: {},
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
    v-model="modelValue"
    :rules
  />
</template>

<style scoped>

</style>
