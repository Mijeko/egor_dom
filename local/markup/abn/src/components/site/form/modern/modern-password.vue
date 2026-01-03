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
  <ModernInput
    v-bind="{...$props,...$attrs}"
    type="password"
    v-model="modelValueComp"
  >
    <template v-for="(_, slotName) in $slots" #[slotName]="slotProps">
      <slot :name="slotName" v-bind="slotProps"></slot>
    </template>
  </ModernInput>
</template>

<style scoped>

</style>
