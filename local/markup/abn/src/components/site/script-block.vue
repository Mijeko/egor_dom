<script lang="ts">
import {defineComponent} from 'vue'

export default defineComponent({
  name: "ScriptBlock",
  props: {
    src: {
      type: String,
      default: null,
    },
    isAsync: {
      type: Boolean,
      default: false,
    },
  },
  mounted(): any {
    if (this.src && this.$refs.script instanceof HTMLDivElement) {
      const script = document.createElement("script");
      script.src = this.src;
      script.setAttribute("type", "text/javascript");

      if (this.isAsync) {
        script.setAttribute('async', '');
      }

      this.$refs.script.appendChild(script);
    }
  }
})
</script>

<template>
  <div ref="script"></div>
</template>

<style lang="scss">

</style>
