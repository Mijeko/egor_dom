<script lang="ts">
import {defineComponent} from 'vue'

export default defineComponent({
  name: "CreateUserForm",
  data: () => {
    return {
      isFormValid: false,
      form: {},
      validate: {},
    };
  }
})
</script>

<template>
  <v-form v-model="isFormValid">



    <SButton type="submit">Добавить</SButton>
  </v-form>
</template>

<style lang="scss">

</style>
