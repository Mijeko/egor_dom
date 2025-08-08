<script lang="ts">
import {defineComponent, type PropType} from 'vue'

export default defineComponent({
  name: "SelectWithSearch",
  props: {
    icon: String,
    label: String,
    color: String,
    modelValue: {
      type: [Boolean, String, Object, Array, null],
      default: null
    }
  },
  data: function () {
    return {
      searchText: null,
      searchResult: [] as string[],
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
    doFilterItems: function (event: any) {
      this.searchText = event.target.value;

      if (!this.searchText) {
        this.searchResult = this.fruits;
      } else {
        this.searchResult = (this.fruits.filter((phrase: string) => {
          return phrase.toLowerCase().indexOf(String(this.searchText)) != -1;
        })) as string[]
      }
    }
  },
  mounted(): any {
    if (!this.searchText) {
      this.searchResult = this.fruits;
    }
  }
})
</script>

<template>
  <v-menu
    :close-on-content-click="false"
  >
    <template v-slot:activator="{ props }">
      <v-btn
        :prepend-icon="icon"
        :color
        variant="tonal"
        v-bind="props"
      >
        <span>{{ label }}</span>
      </v-btn>
    </template>


    <v-card min-width="300" class="pa-4">
      <v-select
        v-model="selectedFruits"
        :items="searchResult"
        :label
        multiple
      >
        <template v-slot:prepend-item>
          <v-row>
            <v-col class="pa-4">
              <v-text-field label="Поиск" @keyup.prevent.stop="doFilterItems"/>
            </v-col>
          </v-row>
          <v-divider class="mt-2"></v-divider>
        </template>

      </v-select>
    </v-card>

  </v-menu>
</template>

<style scoped>

</style>
