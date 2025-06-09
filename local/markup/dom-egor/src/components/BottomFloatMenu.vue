<script>
import {defineComponent} from 'vue'

export default defineComponent({
  name: "BottomFloatMenu",
  mounted() {
    console.log(this.menuItems);
  },
  props: {
    menuItems: []
  },
})
</script>

<template>
  <v-app>
    <v-app-bar location="bottom" :elevation="6">

      <v-btn
        v-for="menuItem in menuItems"
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
