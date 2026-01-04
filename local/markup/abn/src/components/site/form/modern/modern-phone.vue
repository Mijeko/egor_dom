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
    <template #template="{ input, hasError, firstError, label, required }">

      <div class="modern-input-wrapper">

        <label v-if="label">{{ label }}
          <span v-if="required">*</span>
        </label>

        <div class="modern-input">
          <input v-bind="input"/>
        </div>

        <div v-if="hasError" class="my-error">{{ firstError }}</div>

      </div>

    </template>
  </ModernInput>
</template>

<style lang="scss" scoped>

.modern-input {
  display: flex;

  &-wrapper {
    display: flex;
    flex-direction: column;
  }
}
</style>
