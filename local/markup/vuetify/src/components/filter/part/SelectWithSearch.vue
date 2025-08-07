<script lang="ts">
import {defineComponent} from 'vue'

export default defineComponent({
  name: "SelectWithSearch",
  data: function () {
    return {
      selectedFruits: [],
      fruits: [
        'Apples',
        'Apricots',
        'Avocado',
        'Bananas',
        'Blueberries',
        'Blackberries',
        'Boysenberries',
        'Bread fruit',
        'Cantaloupes (cantalope)',
        'Cherries',
        'Cranberries',
        'Cucumbers',
        'Currants',
        'Dates',
        'Eggplant',
        'Figs',
        'Grapes',
        'Grapefruit',
        'Guava',
        'Honeydew melons',
        'Huckleberries',
        'Kiwis',
        'Kumquat',
        'Lemons',
        'Limes',
        'Mangos',
        'Mulberries',
        'Muskmelon',
        'Nectarines',
        'Olives',
        'Oranges',
        'Papaya',
        'Peaches',
        'Pears',
        'Persimmon',
        'Pineapple',
        'Plums',
        'Pomegranate',
        'Raspberries',
        'Rose Apple',
        'Starfruit',
        'Strawberries',
        'Tangerines',
        'Tomatoes',
        'Watermelons',
        'Zucchini',
      ]
    };
  },
  methods: {
    toggle: function () {
      if (this.likesAllFruit.value) {
        this.selectedFruits.value = []
      } else {
        this.selectedFruits.value = this.fruits.slice()
      }
    }
  },
  computed: {
    title: function () {
      if (this.likesAllFruit.value) return 'Holy smokes, someone call the fruit police!';
      if (this.likesSomeFruit.value) return 'Fruit Count';
      return 'How could you not like fruit?';
    },
    likesSomeFruit: function () {
      return this.selectedFruits.value.length > 0;
    },
    likesAllFruit: function () {
      return this.selectedFruits.value.length === this.fruits.length;
    },
    subtitle: function () {
      if (this.likesAllFruit.value) return undefined;
      if (this.likesSomeFruit.value) return this.selectedFruits.value.length;
      return 'Go ahead, make a selection above!'
    }
  }
})
</script>

<template>
  <v-select
    v-model="selectedFruits"
    :items="fruits"
    label="Favorite Fruits"
    multiple
  >
    <template v-slot:prepend-item>
      <v-list-item
        title="Select All"
        @click="toggle"
      >
        <template v-slot:prepend>
          <v-checkbox-btn
            :color="likesSomeFruit ? 'indigo-darken-4' : undefined"
            :indeterminate="likesSomeFruit && !likesAllFruit"
            :model-value="likesAllFruit"
          ></v-checkbox-btn>
        </template>
      </v-list-item>

      <v-divider class="mt-2"></v-divider>
    </template>

    <template v-slot:append-item>
      <v-divider class="mb-2"></v-divider>

      <v-list-item
        :subtitle="subtitle"
        :title="title"
        disabled
      >
        <template v-slot:prepend>
          <v-avatar color="primary" icon="mdi-food-apple"></v-avatar>
        </template>
      </v-list-item>
    </template>
  </v-select>
</template>

<style scoped>

</style>
