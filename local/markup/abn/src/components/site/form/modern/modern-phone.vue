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
      type: Array as PropType<Array<(value: any) => boolean | string>>,
      default: () => []
    },
    // Добавьте другие нужные вам props, например:
    label: {
      type: String,
      default: ''
    },
    type: {
      type: String,
      default: 'text'
    },
    placeholder: {
      type: String,
      default: ''
    },
    disabled: {
      type: Boolean,
      default: false
    },
    required: {
      type: Boolean,
      default: false
    },
  },
  emits: ['update:modelValue'],
  directives: {
    maska: vMaska as any
  },
  methods: {
    obtainIn(): InputParams {
      return {
        label: this.label,
        type: this.type,
        required: this.required,
        value: this.modelValueComputed as any
      };
    }
  },
  computed: {
    modelValueComputed: {
      set(val: any) {
        this.$emit('update:modelValue', val);
      },
      get(): string | number | boolean | any[] | Record<string, any> | null {
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
