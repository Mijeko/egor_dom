<script lang="ts">
import {defineComponent, type PropType} from 'vue';

export default defineComponent({
  name: "MaskInput",
  data: function () {
    return {
      vd: null
    };
  },
  props: {
    label: {
      type: String as PropType<any>
    },
    rules: {
      type: Array as PropType<any[]>
    },
    modelValue: {
      type: String as PropType<any>
    },
  },
  computed: {
    _value: {
      set(value: any) {
        this.$emit('update:modelValue', value);
        this.vd;
      },
      get(): any {
        return this.vd;
      },
    }
  }
})
</script>

<template>
  <v-text-field
    :label="label"
    v-model="vd"
    v-mask="'(###) ### ##-##'"
  ></v-text-field>
</template>

<style scoped>

</style>
