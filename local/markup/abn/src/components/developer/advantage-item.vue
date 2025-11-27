<script lang="ts">
import {defineComponent} from 'vue'

export default defineComponent({
  name: "AdvantageItem",
  props: {
    title: {
      type: String,
    }
  }
})
</script>

<template>

  <v-expansion-panels>
    <v-expansion-panel>
      <v-expansion-panel-title>
        {{ title }}

        <template v-slot:actions>
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M8.45777 7.08056L16.9798 7.08044M16.9798 7.08044L16.9798 15.4812M16.9798 7.08044L7.08027 16.9799"
              stroke="#8DC2FF"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
            />
          </svg>
        </template>

      </v-expansion-panel-title>
      <v-expansion-panel-text>
        <slot></slot>
      </v-expansion-panel-text>
    </v-expansion-panel>
  </v-expansion-panels>

</template>

<style lang="scss">

</style>
