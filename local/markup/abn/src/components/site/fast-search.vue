<script lang="ts">
import {defineComponent} from 'vue'

export default defineComponent({
  name: "FastSearch",
  data: function () {
    return {
      isFormValid: false,
      form: {
        q: null,
      }
    };
  },
  methods: {
    submit() {
      if (!this.isFormValid) {
        return;
      }
    }
  }
})
</script>

<template>
  <v-form v-model="isFormValid" @submit.prevent="submit">
    <v-text-field
      :hide-details="true"
      variant="outlined"
      v-model="form.q"
      placeholder="Поиск"
    />
  </v-form>
</template>

<style scoped>

</style>
