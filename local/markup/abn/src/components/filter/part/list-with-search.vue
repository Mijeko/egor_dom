<script lang="ts">
import {defineComponent} from 'vue'

export default defineComponent({
  name: "ListWithSearch",
  props: {
    label: {
      type: String,
      default: () => '',
    }
  }
})
</script>

<template>
  <v-expansion-panels class="collapse-wrapper">
    <v-expansion-panel class="list-item">
      <v-expansion-panel-title class="list-item__title">
        {{ label }}

        <template v-slot:actions>
          <svg width="8" height="7" viewBox="0 0 8 7" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M3.89746 6.75L7.79457 0H0.000346661L3.89746 6.75Z" fill="#979797"/>
          </svg>
        </template>

      </v-expansion-panel-title>

      <v-expansion-panel-text class="list-item__text">
        <slot></slot>
      </v-expansion-panel-text>

    </v-expansion-panel>
  </v-expansion-panels>
</template>

<style lang="scss">
@use '@/styles/system/variable' as *;

.collapse-wrapper {
  border-bottom: 1px solid $stat-border-color;
  margin-bottom: 15px;
}

.list-item {
  border: 0 !important;

  .v-expansion-panel__shadow {
    box-shadow: unset;
  }

  &__title {
    padding: 0 !important;
  }

  &__text {

    .v-expansion-panel-text__wrapper {
      padding: 0 !important;
    }
  }
}
</style>
