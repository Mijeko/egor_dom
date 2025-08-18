<script lang="ts">
import {defineComponent} from 'vue'

export default defineComponent({
  name: "ProfileReferral",
  data: function () {
    return {
      items: [
        'Приглашено: 3',
        'Получено вознаграждения: 15 000 Р',
      ]
    };
  }
})
</script>

<template>
  <v-card title="Реферальная система">
    <template #subtitle>
      Ссылка-приглашение<br>https://abn.ru/ref/391030
    </template>
    <v-divider/>
    <v-card-text>
      <div class="mb-3" v-for="item in items" v-html="item"></div>
    </v-card-text>
    <v-divider/>

    <v-card-actions>
      <v-btn>Скопировать</v-btn>
    </v-card-actions>
  </v-card>
</template>

<style lang="scss">

</style>
