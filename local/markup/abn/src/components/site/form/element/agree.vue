<script lang="ts">
import {defineComponent} from 'vue'

export default defineComponent({
  name: "Agree",
  props: {
    modelValue: {
      type: [String, Boolean,],
      default: false,
    },
    text: {
      type: String,
      default: null,
    },
    rules: {
      type: Array as PropType<any[]>,
      default: []
    },
  },
  computed: {
    modelValueComputed: {
      set(val: string | boolean) {
        this.$emit('update:modelValue', val);
      },
      get(): string | boolean {
        return this.modelValue;
      }
    }
  }
})
</script>

<template>
  <v-checkbox
    v-model="modelValueComputed"
    :rules
  >
    <template v-slot:label>
      <slot></slot>
    </template>
  </v-checkbox>
</template>

<style lang="scss">

</style>
