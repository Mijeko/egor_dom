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

  <v-expansion-panels class="collapse-wrapper">
    <v-expansion-panel class="collapse-item">
      <v-expansion-panel-title class="collapse-item__title">
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

      <v-expansion-panel-text class="collapse-item__text">
        <slot></slot>
      </v-expansion-panel-text>

    </v-expansion-panel>
  </v-expansion-panels>

</template>

<style lang="scss">

@use '@/styles/system/variable' as *;

.collapse {

  &-wrapper {
    .v-expansion-panel--active {
      .v-expansion-panel-title__icon {
        transition: all 0.4s ease;
        transform: rotate(180deg);

        svg {
          path {
            stroke: $gray-color;
          }
        }
      }
    }
  }

  &-item {
    border-radius: 15px !important;

    &__title {
      padding: 24px 20px !important;
      font-family: var(--second-family);
      font-weight: 300 !important;
      font-size: 16px !important;
      line-height: 140% !important;
      text-transform: uppercase !important;
      color: $bo-color-name !important;

      .v-expansion-panel-title__icon {
        transition: all 0.4s ease;
        position: absolute;
        right: 0;
        top: 0;
        margin: 10px 10px 0 0;
      }
    }

    &__text {
      font-family: var(--font-family) !important;
      font-weight: 400 !important;
      font-size: 14px !important;
      line-height: 150% !important;
      color: $bo-color-name !important;
    }
  }
}
</style>
