<script lang="ts">
import {defineComponent} from 'vue'

export default defineComponent({
  name: "InputDropdown",
  props: {
    label: String,
    icon: String,
    color: String,
    modelValue: {
      type: [String, Number, null],
      default: null
    }
  },
  computed: {
    rawValue: {
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
  <v-menu
    :close-on-content-click="false"
  >
    <template v-slot:activator="{ props }">
      <v-btn
        :prepend-icon="icon"
        :color
        variant="tonal"
        v-bind="props"
      >
        <span>{{ label }}</span>
        <span v-if="modelValue"> * до {{ modelValue }}</span>
      </v-btn>
    </template>

    <v-card min-width="300" class="pa-3">
      <v-text-field
        :hide-details="true"
        v-model="rawValue"
        :label
        variant="outlined"
      ></v-text-field>
    </v-card>

  </v-menu>
</template>

<style scoped>

</style>
