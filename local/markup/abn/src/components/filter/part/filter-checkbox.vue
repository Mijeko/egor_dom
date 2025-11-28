<script lang="ts">
import {defineComponent} from 'vue'

export interface CheckboxItem {
  value: any;
  label: any
}

export default defineComponent({
  name: "FilterCheckbox",
  props: {
    modelValue: {},
    values: {
      type: Array as PropType<CheckboxItem[]>,
      default: () => [],
    }
  },
  computed: {
    modelValueComputed: {
      set(value: any) {
        this.$emit('update:modelValue', value);
      },
      get() {
        return this.modelValue;
      },
    }
  }
})
</script>

<template>
  <v-checkbox
    true-icon="$radioOn"
    false-icon="$radioOff"
    color="theme-color"
    v-model="modelValueComputed"
    v-for="item in values"
    :value="item.value"
    :label="item.label"
    :hide-details="true"
    class="filter-checkbox"
  />
</template>

<style lang="scss">
.filter-checkbox {
  &.v-input--density-default {
    --v-input-control-height: 20px;
  }
}
</style>
