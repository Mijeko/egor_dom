<script lang="ts">
import {defineComponent} from 'vue'

export default defineComponent({
  name: "BaseModernModal",
  data: function () {
    return {
      showModalComputed: false,
    };
  },
  props: {
    modelValue: {
      type: Boolean,
      default: false,
    }
  },
})
</script>

<template>
  <v-dialog max-width="850" v-model="showModalComputed">

    <template v-slot:activator="{ props: activatorProps }" v-if="$slots.activator">
      <slot name="activator" :activatorProps="activatorProps"></slot>
    </template>

    <template v-slot:default="{ isActive }">
      <ModalContent v-model="showModalComputed">

        <template #backgroundImage>
          <slot name="backgroundImage"></slot>
        </template>

        <template #content>
          <slot name="content"></slot>
        </template>

      </ModalContent>
    </template>
  </v-dialog>
</template>

<style lang="scss">

</style>
