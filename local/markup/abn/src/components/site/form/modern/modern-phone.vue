<script lang="ts">
import {defineComponent, type PropType, computed, ref, watch} from 'vue'
import {vMaska} from "maska/vue";

export interface InputParams {
  label: string;
  type: string;
  required: boolean;
  value: any;
}

export default defineComponent({
  name: "ModernPhone",
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
  emits: ['update:modelValue'],
  directives: {
    maska: vMaska as any
  },
  computed: {
    modelValueComputed: {
      set(value: any) {
        this.$emit('update:modelValue', value);
      },
      get(): any {
        return this.modelValue;
      },
    },
  }
})
</script>

<template>
  <ModernInput
    v-bind="{...$props,...$attrs}"
    v-maska="'+7 (###) ### ##-##'"
    v-model="modelValueComputed"
  >
    <template v-for="(_, slotName) in $slots" #[slotName]="slotProps">
      <slot :name="slotName" v-bind="slotProps"></slot>
    </template>
  </ModernInput>
</template>

<style lang="scss">
</style>
