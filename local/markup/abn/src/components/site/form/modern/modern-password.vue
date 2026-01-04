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
    <template #template="{ input, hasError, firstError, label, required }">

      <div class="modern-input-container">

        <div class="modern-input">
          <div class="modern-input-wrapper">
            <div class="modern-input-icon">
              <img class="modern-input-icon__image" src="@/assets/images/icons/input/mobile.svg" :alt="label">
            </div>
            <input class="modern-input-field" v-bind="input" :placeholder="label"/>
          </div>
        </div>

        <div v-if="hasError" class="modern-input-error">{{ firstError }}</div>

      </div>

    </template>
  </ModernInput>
</template>

<style lang="scss" scoped>

.modern-input {
  display: flex;

  &-container {
    display: flex;
    flex-direction: column;
  }

  &-icon {
    width: 20px;

    &__image {
      height: 100%;
      object-fit: contain;
    }
  }

  &-wrapper {
    display: flex;
    align-items: stretch;
    justify-content: flex-start;
    border: 1px gray solid;
    padding: 10px;
    border-radius: 7px;
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
    color: red;
    text-transform: lowercase;
    margin-top: 3px;
  }
}

</style>
