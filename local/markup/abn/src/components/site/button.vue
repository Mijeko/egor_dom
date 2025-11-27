<script lang="ts">
import {defineComponent} from 'vue'

export default defineComponent({
  name: "button",
  props: {
    type: {
      type: String,
      default: () => 'button',
    },
    link: {
      type: String,
      default: () => null,
    }
  }
})
</script>

<template>
  <v-btn
    :link
    class="btn-main"
    :type
  >
    <slot></slot>

    <template #append>
      <svg width="12" height="10" viewBox="0 0 12 10" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M6.75 0.75L10.75 4.75L6.75 8.75M0.75 0.750001L4.75 4.75L0.75 8.75" stroke="white" stroke-width="1.5"
              stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
    </template>
  </v-btn>
</template>

<style lang="scss">
@use '@/styles/system/variable' as *;

.btn-main {
  background: $button-color;
  border-radius: 30px !important;
  padding: 17px 43px !important;
  height: auto !important;

  .v-btn__content {
    color: $white-color;
  }

  .v-btn__append {
    margin-inline: 15px;
  }
}
</style>
