<script lang="ts">
import {defineComponent} from 'vue'

export default defineComponent({
  name: "Agree",
  props: {
    modelValue: {
      type: [String, Boolean,],
      default: false,
    },
    text: {
      type: String,
      default: null,
    },
    rules: {
      type: Array as PropType<any[]>,
      default: []
    },
  },
  computed: {
    modelValueComputed: {
      set(val: string | boolean) {
        this.$emit('update:modelValue', val);
      },
      get(): string | boolean {
        return this.modelValue;
      }
    }
  }
})
</script>

<template>
  <div class="modern-form-agree">
    <v-checkbox
      class=""
      v-model="modelValueComputed"
      :rules
      hideDetails="auto"
    >
      <template v-slot:label>
        <slot></slot>
      </template>
    </v-checkbox>
  </div>
</template>

<style lang="scss" scoped>
.modern-form-agree {
  &:deep(*) {
    --v-input-control-height: 16px !important;
    --v-selection-control-size: 10px !important;

    .v-icon{
      width: 15px!important;
      min-width: 15px!important;
      height: 15px!important;
      min-height: 15px!important;
    }

    .v-label {
      font-size: 14px !important;
      line-height: calc(14px * 1.3) !important;
    }

    .v-checkbox.v-input {
      padding: 0 10px 0 15px !important;
    }

    .v-selection-control__wrapper {
      margin-right: 10px;
    }

    .v-input__control, .v-input__details {
      padding: 0 10px 0 5px !important;
    }
  }
}
</style>
