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
  name: "ModernInput",
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
  setup(props, {emit}) {
    const errorMessages = ref<string[]>([])

    // Валидация значения
    const validateValue = (value: any): boolean => {
      if (!props.rules || props.rules.length === 0) {
        errorMessages.value = []
        return true
      }

      const errors: string[] = []
      for (const rule of props.rules) {
        const result = rule(value)
        if (result !== true) {
          errors.push(result as string)
        }
      }

      errorMessages.value = errors
      return errors.length === 0
    }

    // Синхронизация с внешним значением
    watch(() => props.modelValue, (newValue) => {
      validateValue(newValue)
    })

    // Computed для двухстороннего связывания
    const modelValueComp = computed({
      get(): any {
        return props.modelValue
      },
      set(value: any) {
        validateValue(value)
        emit('update:modelValue', value)
      },
    })

    // Computed для проверки наличия ошибок
    const hasError = computed(() => errorMessages.value.length > 0)
    const firstError = computed(() => errorMessages.value[0] || '')

    // Валидация при первом рендере
    if (props.modelValue !== null && props.modelValue !== undefined) {
      validateValue(props.modelValue)
    }

    return {
      modelValueComp,
      errorMessages,
      hasError,
      firstError,
      validateValue,
    }
  },
  directives: {
    maska: vMaska as any
  },
  computed: {
    inputParams: function (): InputParams {
      return {
        label: this.label,
        type: this.type,
        required: this.required,
        value: this.modelValueComp
      };
    }
  }
})
</script>

<template>

  <div
    v-if="$.slots.template"
  >
    <slot name="template" v-bind="inputParams"></slot>

    <input
      v-maska="'+7 (###) ### ##-##'"
      v-model="modelValueComp"
      :type="type"
      :placeholder="placeholder"
      :disabled="disabled"
      :class="{
        'modern-input__field': true,
        'modern-input__field--error': hasError,
        'modern-input__field--disabled': disabled,
      }"
      @blur="validateValue(modelValueComp)"
    />

  </div>
  <div v-else class="modern-input">

    <label v-if="label" class="modern-input__label">
      {{ label }}
      <span v-if="required" class="modern-input__required">*</span>
    </label>

    <input
      v-model="modelValueComp"
      :type="type"
      :placeholder="placeholder"
      :disabled="disabled"
      :class="{
        'modern-input__field': true,
        'modern-input__field--error': hasError,
        'modern-input__field--disabled': disabled,
      }"
      @blur="validateValue(modelValueComp)"
    />

    <div v-if="hasError" class="modern-input__error">
      {{ firstError }}
    </div>
  </div>
</template>

<style scoped>
.modern-input {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

.modern-input__label {
  font-size: 0.875rem;
  font-weight: 500;
  color: rgba(var(--v-theme-on-surface), 0.87);
}

.modern-input__required {
  color: rgb(var(--v-theme-error));
}

.modern-input__field {
  padding: 0.75rem;
  border: 1px solid rgba(var(--v-border-color), var(--v-border-opacity));
  border-radius: 4px;
  font-size: 1rem;
  outline: none;
  transition: border-color 0.2s ease;
  width: 100%;
}

.modern-input__field:hover:not(.modern-input__field--disabled) {
  border-color: rgba(var(--v-border-color), 1);
}

.modern-input__field:focus {
  border-color: rgb(var(--v-theme-primary));
  border-width: 2px;
}

.modern-input__field--error {
  border-color: rgb(var(--v-theme-error));
}

.modern-input__field--disabled {
  opacity: 0.6;
  cursor: not-allowed;
  background-color: rgba(var(--v-theme-surface), 0.38);
}

.modern-input__error {
  font-size: 0.75rem;
  color: rgb(var(--v-theme-error));
  margin-top: -0.25rem;
}
</style>
