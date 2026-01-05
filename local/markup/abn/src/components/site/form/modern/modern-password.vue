<script lang="ts">
import {defineComponent} from 'vue'
import IconInput from "@/components/site/form/modern/icon-input.vue";

export default defineComponent({
  name: "ModernPassword",
  components: {IconInput},
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
  <IconInput
    v-bind="{...$props,...$attrs}"
    v-model="modelValueComp"
    type="password"
  >
    <template #icon="{label}">
      <img class="modern-input-icon__image" src="@/assets/images/icons/input/encrypted.svg" :alt="label">
    </template>
  </IconInput>
</template>

<style lang="scss">
</style>
