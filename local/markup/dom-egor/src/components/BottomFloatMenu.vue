<script lang="ts">
import {defineComponent} from 'vue'

export default defineComponent({
  name: "BottomFloatMenu",
  data: function () {
    return {
      icons: [
        {
          icon: 'mdi-menu',
          title: 'Объекты',
          link: '/',
        },
        {
          icon: 'mdi-menu',
          title: 'Заявки',
          link: '/claims/',
        },
        {
          icon: 'mdi-crosshairs-gps',
          title: 'Застройщики',
          link: '/developers/',
        },
        {
          icon: 'mdi-crosshairs-gps',
          title: 'Кабинет',
          link: '/profile/',
        },
        {
          icon: 'mdi-crosshairs-gps',
          title: 'Помощь',
          link: '/help/',
        },
      ]
    };
  }
})
</script>

<template>
  <v-app>
    <v-app-bar location="bottom" :elevation="6">

      <v-btn
        v-for="menuItem in icons"
        :href="menuItem.link"
        :prepend-icon="menuItem.icon"
        height="auto"
        width="auto"
        stacked
      >
        <template v-slot:prepend>
          <v-icon color="success"></v-icon>
        </template>

        <v-card elevation="0" class="ma-0 pa-0">
          <v-card-text class="ma-0 pa-0">{{ menuItem.title }}</v-card-text>
        </v-card>
      </v-btn>
    </v-app-bar>

  </v-app>
</template>

<style scoped>

</style>
