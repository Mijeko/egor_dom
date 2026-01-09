<script lang="ts">
import {defineComponent} from 'vue'

export default defineComponent({
  name: "IconInput",
  props: {
    modelValue: {
      type: [String, Number, null, Boolean, Array, Object],
      default: null
    },
    rules: {
      type: Array as PropType<any[]>,
      default: []
    },
    hideIcon: {
      type: Boolean,
      default: false,
    }
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
  <BaseInput
    v-bind="{...$props,...$attrs}"
    v-model="modelValueComp"
  >
    <template #template="{ input, hasError, firstError, label, required }">

      <div :class="{
        'modern-input-container':true,
        'modern-input-has-error': hasError,
      }">

        <div class="modern-input">
          <div class="modern-input-wrapper">
            <div class="modern-input-icon" v-if="!hideIcon">
              <slot name="icon" v-if="$slots.icon" :label="label"></slot>
              <img v-else class="modern-input-icon__image" src="@/assets/images/icons/input/mobile.svg" :alt="label">
            </div>
            <input class="modern-input-field" v-bind="input" :placeholder="label"/>
          </div>
        </div>

        <div v-if="hasError" class="modern-input-error">{{ firstError }}</div>

      </div>

    </template>
  </BaseInput>
</template>

<style lang="scss">

@use "@/styles/system/variable" as *;

.modern-input {
  display: flex;

  &-container {
    display: flex;
    flex-direction: column;
  }

  &-has-error {
    .modern-input-wrapper {
      border-color: $error-color;
    }
  }

  &-icon {
    width: 20px;
    margin-right: 5px;

    &__image, image {
      height: 100%;
      object-fit: contain;
    }
  }

  &-wrapper {
    display: flex;
    align-items: stretch;
    justify-content: flex-start;
    border: 1px $footer-short solid;
    padding: 5px 5px 5px 15px;
    border-radius: 12px;
    //border-radius: 7px;
    width: 100%;
  }

  &-field {
    outline: none;
    border: 0;
    height: 100%;
    padding: 5px;
  }

  &-error {
    font-size: 14px;
    color: $error-color;
    text-transform: lowercase;
    margin-top: 3px;
  }
}
</style>
