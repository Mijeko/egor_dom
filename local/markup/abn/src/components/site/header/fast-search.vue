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
  <v-form v-model="isFormValid" @submit.prevent="submit" class="search-header">
    <v-text-field
      prepend-inner-icon="$searchIcon"
      class="search-header__input"
      :hide-details="true"
      variant="outlined"
      v-model="form.q"
      placeholder="Поиск"
    />
  </v-form>
</template>

<style lang="scss">

@use "@/styles/system/variable" as *;

.search-header {
  max-width: 160px;
  width: 100%;

  .v-field {
    border-radius: 32px;
  }

  &__input {
    border-top-left-radius: 30px !important;
    border-bottom-left-radius: 30px !important;

    .v-field--variant-outlined {
      color: $fast-search-color;
    }

    .v-field__input {
      padding: 10px;
      min-height: 10px !important;
    }

    .v-field__outline__start {
      flex: 0 0 20px !important;
      //border-top-left-radius: 30px !important;
      //border-bottom-left-radius: 30px !important;
    }
  }
}
</style>
