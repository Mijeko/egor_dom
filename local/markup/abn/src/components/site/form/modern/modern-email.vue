<script lang="ts">
import {defineComponent} from 'vue'

export default defineComponent({
  name: "modern-email",
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
  <IconInput
    v-bind="{...$attrs,...$props}"
    v-model="modelValueComp"
  >
    <template #icon="{label}">
      <img class="modern-input-icon__image" src="@/assets/images/icons/input/email.svg" :alt="label">
    </template>
  </IconInput>
</template>

<style scoped>

</style>
