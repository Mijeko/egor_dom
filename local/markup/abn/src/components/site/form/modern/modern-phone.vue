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
  <IconInput
    v-bind="{...$props,...$attrs}"
    v-maska="'+7 (###) ### ##-##'"
    v-model="modelValueComputed"
    type="text"
  >
    <template #icon="{label}">
      <img class="modern-input-icon__image" src="@/assets/images/icons/input/mobile.svg" :alt="label">
    </template>
  </IconInput>
</template>

<style lang="scss">
</style>
