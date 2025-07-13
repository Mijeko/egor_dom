<script lang="ts">
import {defineComponent} from 'vue'

export default defineComponent({
  name: "MinMaxInputDropdown",
  props: {
    label: String,
    icon: String,
    color: String,
    min: {
      type: [String, Number, null],
      default: null
    },
    max: {
      type: [String, Number, null],
      default: null
    }
  },
  computed: {
    rawMinValue: {
      set(value: any) {
        this.$emit('update:min', value);
      },
      get() {
        return this.min;
      },
    },
    rawMaxValue: {
      set(value: any) {
        this.$emit('update:max', value);
      },
      get() {
        return this.max;
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
        <span v-if="min">&nbsp;от&nbsp;{{ min }}</span>
        <span v-if="max">&nbsp;до&nbsp;{{ max }}</span>
      </v-btn>
    </template>



    <v-card min-width="300" class="pa-4">
      <v-row>
        <v-col>
          <v-text-field
            :hide-details="true"
            v-model="rawMinValue"
            :label
            variant="outlined"
          ></v-text-field>
        </v-col>
        <v-col>
          <v-text-field
            :hide-details="true"
            v-model="rawMaxValue"
            :label
            variant="outlined"
          ></v-text-field>
        </v-col>
      </v-row>
    </v-card>


  </v-menu>
</template>

<style scoped>

</style>
