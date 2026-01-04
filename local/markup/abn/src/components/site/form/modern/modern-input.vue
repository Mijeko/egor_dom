<script lang="ts">
import {
  defineComponent,
  type PropType,
  computed,
  ref,
  watch,
  inject,
  onBeforeMount,
  onBeforeUnmount,
  onMounted,
  getCurrentInstance,
  useId,
  nextTick,
  shallowRef,
  type ComponentPublicInstance
} from 'vue'

// Символ для инжекта формы Vuetify
const FormKey = Symbol.for("vuetify:form")

// Интерфейс для формы Vuetify
interface VuetifyForm {
  register?: (item: {
    id: string | number
    vm: any // ComponentInternalInstance, обрабатывается через markRaw в Vuetify
    validate: () => Promise<string[]>
    reset: () => Promise<void>
    resetValidation: () => Promise<void>
  }) => void
  unregister?: (id: string | number) => void
  update?: (id: string | number, isValid: boolean | null, errorMessages: string[]) => void
  isDisabled?: { value: boolean }
  isReadonly?: { value: boolean }
  validateOn?: { value: string }
}

// Тип для правила валидации
type ValidationRule = (value: any) => boolean | string | Promise<boolean | string>

// Интерфейс для props компонента
interface ModernInputProps {
  modelValue?: string | number | null
  rules?: ValidationRule[]
  label?: string
  type?: string
  placeholder?: string
  disabled?: boolean
  required?: boolean
  name?: string
  error?: boolean
  errorMessages?: string[]
  maxErrors?: number
  validateOn?: string
  readonly?: boolean
  autofocus?: boolean
  counter?: boolean | number | string
  counterValue?: number | ((value: any) => number)
  prefix?: string
  suffix?: string
  persistentPlaceholder?: boolean
  persistentCounter?: boolean
  role?: string
}

export default defineComponent({
  name: "ModernInput",
  inheritAttrs: false,
  props: {
    modelValue: {
      type: [String, Number, null] as PropType<string | number | null>,
      default: null
    },
    rules: {
      type: Array as PropType<ValidationRule[]>,
      default: () => []
    },
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
    name: {
      type: String,
      default: ''
    },
    error: {
      type: Boolean,
      default: false
    },
    errorMessages: {
      type: Array as PropType<string[]>,
      default: () => []
    },
    maxErrors: {
      type: Number,
      default: 1
    },
    validateOn: {
      type: String,
      default: 'input'
    },
    readonly: {
      type: Boolean,
      default: false
    },
    autofocus: {
      type: Boolean,
      default: false
    },
    counter: {
      type: [Boolean, Number, String] as PropType<boolean | number | string>,
      default: false
    },
    counterValue: {
      type: [Number, Function] as PropType<number | ((value: any) => number)>,
      default: undefined
    },
    prefix: {
      type: String,
      default: ''
    },
    suffix: {
      type: String,
      default: ''
    },
    persistentPlaceholder: {
      type: Boolean,
      default: false
    },
    persistentCounter: {
      type: Boolean,
      default: false
    },
    role: {
      type: String,
      default: undefined
    }
  },
  emits: {
    'update:modelValue': (value: string | number | null) => true,
    'update:focused': (focused: boolean) => true
  },
  setup(props: ModernInputProps, { emit, attrs, slots }) {
    // Состояние компонента
    const internalErrorMessages = ref<string[]>([])
    const isPristine = shallowRef(true)
    const isValidating = shallowRef(false)
    const isFocused = ref(false)
    const inputRef = ref<HTMLInputElement | null>(null)

    // Интеграция с формой Vuetify
    const form = inject(FormKey as symbol, null) as VuetifyForm | null
    const vm = getCurrentInstance()
    const id = useId()
    const uid = computed(() => props.name || id)

    // Computed для значения модели
    const modelValue = computed({
      get(): string | number | null {
        return props.modelValue ?? null
      },
      set(value: string | number | null) {
        emit('update:modelValue', value)
      }
    })

    // Computed для значения валидации
    const validationModel = computed(() => modelValue.value)

    // Computed для сообщений об ошибках
    const errorMessages = computed(() => {
      if (props.errorMessages && props.errorMessages.length > 0) {
        return [...props.errorMessages, ...internalErrorMessages.value].slice(0, Math.max(0, props.maxErrors || 1))
      }
      return internalErrorMessages.value
    })

    // Computed для настройки валидации
    const validateOnConfig = computed(() => {
      const value = props.validateOn || form?.validateOn?.value || 'input'
      const normalizedValue = value === 'lazy' ? 'input lazy' : value === 'eager' ? 'input eager' : value
      const set = new Set(normalizedValue.split(' '))
      return {
        input: set.has('input'),
        blur: set.has('blur') || set.has('input') || set.has('invalid-input'),
        invalidInput: set.has('invalid-input'),
        lazy: set.has('lazy'),
        eager: set.has('eager')
      }
    })

    // Computed для валидности
    const isValid = computed(() => {
      if (props.error || (props.errorMessages && props.errorMessages.length > 0)) {
        return false
      }
      if (!props.rules || props.rules.length === 0) {
        return true
      }
      if (isPristine.value) {
        return internalErrorMessages.value.length > 0 || validateOnConfig.value.lazy ? null : true
      }
      return internalErrorMessages.value.length === 0
    })

    // Computed для счетчика
    const counterValue = computed(() => {
      if (typeof props.counterValue === 'function') {
        return props.counterValue(modelValue.value)
      }
      if (typeof props.counterValue === 'number') {
        return props.counterValue
      }
      return (modelValue.value ?? '').toString().length
    })

    const hasCounter = computed(() => {
      return props.counter !== false && (props.counter !== undefined || props.counterValue !== undefined)
    })

    const counterText = computed(() => {
      if (typeof props.counter === 'string') {
        return props.counter
      }
      if (typeof props.counter === 'number') {
        return `${counterValue.value} / ${props.counter}`
      }
      return String(counterValue.value)
    })

    // Функция валидации
    async function validate(silent: boolean = false): Promise<string[]> {
      if (!props.rules || props.rules.length === 0) {
        internalErrorMessages.value = []
        isValidating.value = false
        return []
      }

      isValidating.value = true
      const results: string[] = []

      for (const rule of props.rules) {
        if (results.length >= (props.maxErrors || 1)) {
          break
        }

        try {
          const handler = typeof rule === 'function' ? rule : () => rule
          const result = await handler(validationModel.value)

          if (result === true) {
            continue
          }

          if (result !== false && typeof result !== 'string') {
            console.warn(`${result} is not a valid value. Rule functions must return boolean true or a string.`)
            continue
          }

          results.push(result || '')
        } catch (error) {
          // Безопасная обработка ошибок в правилах валидации
          console.warn('Validation rule error:', error, 'for value:', validationModel.value)
          // Не добавляем ошибку, чтобы не скрывать проблемы в правилах
        }
      }

      internalErrorMessages.value = results
      isValidating.value = false
      isPristine.value = silent

      return internalErrorMessages.value
    }

    // Функция сброса
    async function reset(): Promise<void> {
      modelValue.value = null
      await nextTick()
      await resetValidation()
    }

    // Функция сброса валидации
    async function resetValidation(): Promise<void> {
      isPristine.value = true
      if (!validateOnConfig.value.lazy) {
        await validate(!validateOnConfig.value.eager)
      } else {
        internalErrorMessages.value = []
      }
    }

    // Обработчики событий
    const handleInput = (event: Event) => {
      const target = event.target as HTMLInputElement
      const value = target.type === 'number' ? (target.value === '' ? null : Number(target.value)) : target.value
      modelValue.value = value
      isPristine.value = false
    }

    const handleFocus = () => {
      isFocused.value = true
      emit('update:focused', true)
    }

    const handleBlur = async () => {
      isFocused.value = false
      emit('update:focused', false)
      isPristine.value = false
      if (validateOnConfig.value.blur) {
        await validate()
      }
    }

    // Computed для классов
    const hasError = computed(() => errorMessages.value.length > 0 || props.error)
    const firstError = computed(() => errorMessages.value[0] || '')

    // Watchers для валидации
    if (validateOnConfig.value.input || (validateOnConfig.value.invalidInput && isValid.value === false)) {
      watch(validationModel, async (newValue) => {
        if (newValue != null) {
          await validate()
        } else if (isFocused.value) {
          const unwatch = watch(() => isFocused.value, async (val) => {
            if (!val) {
              await validate()
            }
            unwatch()
          })
        }
      })
    }

    if (validateOnConfig.value.blur) {
      watch(() => isFocused.value, async (val) => {
        if (!val) {
          await validate()
        }
      })
    }

    // Отслеживание изменений валидности для обновления формы
    watch([isValid, errorMessages], () => {
      if (form) {
        form.update?.(uid.value, isValid.value, errorMessages.value)
      }
    }, { flush: 'post' })

    // Регистрация в форме
    onBeforeMount(() => {
      if (form && vm) {
        form.register?.({
          id: uid.value,
          vm: vm, // ComponentInternalInstance, Vuetify обработает через markRaw
          validate,
          reset,
          resetValidation
        })
      }
    })

    onMounted(async () => {
      // Автофокус
      if (props.autofocus && inputRef.value) {
        inputRef.value.focus()
      }

      // Валидация при первом рендере
      if (!validateOnConfig.value.lazy) {
        await validate(!validateOnConfig.value.eager)
      }

      if (form) {
        form.update?.(uid.value, isValid.value, errorMessages.value)
      }
    })

    onBeforeUnmount(() => {
      if (form) {
        form.unregister?.(uid.value)
      }
    })

    // Методы для внешнего использования
    const focus = () => {
      inputRef.value?.focus()
    }

    const blur = () => {
      inputRef.value?.blur()
    }

    return {
      // State
      modelValue,
      errorMessages,
      hasError,
      firstError,
      isValid,
      isFocused,
      isValidating,
      inputRef,
      uid,
      
      // Computed
      counterValue,
      counterText,
      hasCounter,
      
      // Methods
      validate,
      reset,
      resetValidation,
      focus,
      blur,
      handleInput,
      handleFocus,
      handleBlur,
      
      // Props (для использования в template)
      label: computed(() => props.label),
      type: computed(() => props.type),
      placeholder: computed(() => props.placeholder),
      disabled: computed(() => props.disabled || form?.isDisabled?.value || false),
      readonly: computed(() => props.readonly || form?.isReadonly?.value || false),
      required: computed(() => props.required),
      prefix: computed(() => props.prefix),
      suffix: computed(() => props.suffix),
      persistentPlaceholder: computed(() => props.persistentPlaceholder),
      persistentCounter: computed(() => props.persistentCounter),
      role: computed(() => props.role),
      
      // Slots
      slots
    }
  }
})
</script>

<template>
  <div class="modern-input" :class="{
    'modern-input--error': hasError,
    'modern-input--disabled': disabled,
    'modern-input--readonly': readonly,
    'modern-input--focused': isFocused
  }">
    <!-- Label -->
    <label v-if="label || $slots.label" class="modern-input__label">
      <slot name="label">
        {{ label }}
        <span v-if="required" class="modern-input__required">*</span>
      </slot>
    </label>

    <!-- Input wrapper -->
    <div class="modern-input__wrapper">
      <!-- Prefix -->
      <span v-if="prefix" class="modern-input__prefix">
        {{ prefix }}
      </span>

      <!-- Input field -->
      <input
        ref="inputRef"
        :id="uid"
        :value="modelValue ?? ''"
        :type="type"
        :placeholder="persistentPlaceholder ? placeholder : (isFocused || modelValue ? '' : placeholder)"
        :disabled="disabled"
        :readonly="readonly"
        :required="required"
        :role="role"
        :aria-label="label"
        :aria-required="required"
        :aria-invalid="hasError"
        :aria-describedby="hasError ? `${uid}-error` : undefined"
        class="modern-input__field"
        :class="{
          'modern-input__field--error': hasError,
          'modern-input__field--disabled': disabled,
          'modern-input__field--readonly': readonly,
          'modern-input__field--prefixed': prefix,
          'modern-input__field--suffixed': suffix || hasCounter
        }"
        @input="handleInput"
        @focus="handleFocus"
        @blur="handleBlur"
        v-bind="$attrs"
      />

      <!-- Suffix -->
      <span v-if="suffix" class="modern-input__suffix">
        {{ suffix }}
      </span>

      <!-- Counter -->
      <span v-if="hasCounter && (persistentCounter || isFocused || modelValue)" class="modern-input__counter">
        {{ counterText }}
      </span>
    </div>

    <!-- Error messages -->
    <div v-if="hasError" :id="`${uid}-error`" class="modern-input__error" role="alert">
      <slot name="error" :error="firstError">
        {{ firstError }}
      </slot>
    </div>

    <!-- Details slot -->
    <div v-if="$slots.details" class="modern-input__details">
      <slot name="details"></slot>
    </div>
  </div>
</template>

<style scoped>
.modern-input {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
  width: 100%;
}

.modern-input__label {
  font-size: 0.875rem;
  font-weight: 500;
  color: rgba(var(--v-theme-on-surface), 0.87);
  line-height: 1.5;
}

.modern-input__required {
  color: rgb(var(--v-theme-error));
  margin-left: 0.25rem;
}

.modern-input__wrapper {
  position: relative;
  display: flex;
  align-items: center;
  width: 100%;
}

.modern-input__prefix,
.modern-input__suffix {
  font-size: 1rem;
  color: rgba(var(--v-theme-on-surface), 0.6);
  white-space: nowrap;
  user-select: none;
}

.modern-input__prefix {
  padding-right: 0.5rem;
}

.modern-input__suffix {
  padding-left: 0.5rem;
}

.modern-input__counter {
  font-size: 0.75rem;
  color: rgba(var(--v-theme-on-surface), 0.6);
  padding-left: 0.5rem;
  white-space: nowrap;
  user-select: none;
}

.modern-input__field {
  flex: 1;
  padding: 0.75rem;
  border: 1px solid rgba(var(--v-border-color), var(--v-border-opacity));
  border-radius: 4px;
  font-size: 1rem;
  font-family: inherit;
  line-height: 1.5;
  color: rgba(var(--v-theme-on-surface), 0.87);
  background-color: rgb(var(--v-theme-surface));
  outline: none;
  transition: border-color 0.2s ease, box-shadow 0.2s ease;
  width: 100%;
  box-sizing: border-box;
}

.modern-input__field::placeholder {
  color: rgba(var(--v-theme-on-surface), 0.38);
}

.modern-input__field:hover:not(.modern-input__field--disabled):not(.modern-input__field--readonly) {
  border-color: rgba(var(--v-border-color), 1);
}

.modern-input__field:focus {
  border-color: rgb(var(--v-theme-primary));
  border-width: 2px;
  box-shadow: 0 0 0 2px rgba(var(--v-theme-primary), 0.12);
}

.modern-input__field--error {
  border-color: rgb(var(--v-theme-error));
}

.modern-input__field--error:focus {
  border-color: rgb(var(--v-theme-error));
  box-shadow: 0 0 0 2px rgba(var(--v-theme-error), 0.12);
}

.modern-input__field--disabled {
  opacity: 0.6;
  cursor: not-allowed;
  background-color: rgba(var(--v-theme-surface), 0.38);
}

.modern-input__field--readonly {
  cursor: default;
  background-color: rgba(var(--v-theme-surface), 0.12);
}

.modern-input__field--prefixed {
  padding-left: 0.5rem;
}

.modern-input__field--suffixed {
  padding-right: 0.5rem;
}

.modern-input__error {
  font-size: 0.75rem;
  color: rgb(var(--v-theme-error));
  line-height: 1.5;
  margin-top: -0.25rem;
}

.modern-input__details {
  font-size: 0.75rem;
  color: rgba(var(--v-theme-on-surface), 0.6);
  line-height: 1.5;
}

.modern-input--error .modern-input__label {
  color: rgb(var(--v-theme-error));
}

.modern-input--disabled {
  opacity: 0.6;
  pointer-events: none;
}

.modern-input--readonly {
  opacity: 0.87;
}
</style>