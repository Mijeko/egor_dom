<script setup lang="ts">
import {ref} from 'vue';

const form = ref({email: '', phone: '', password: ''});


let submit = () => {
  fetch('')
      .then((r: any) => r.json())
      .then((d: any) => {
        console.log(d);
      })
}

</script>

<template>
  <form @submit.prevent="submit">

    <div>
      <label>Почта</label>
      <input type="text" name="EMAIL" v-model="form.email">
    </div>

    <div>
      <label>Телефон</label>
      <input type="text" name="PHONE" v-model="form.phone">
    </div>

    <div>
      <label>Пароль</label>
      <input type="password" name="PASSWORD" v-model="form.password">
    </div>


    <button type="submit">Зарегистрироваться</button>
  </form>
</template>

<style scoped>

</style>