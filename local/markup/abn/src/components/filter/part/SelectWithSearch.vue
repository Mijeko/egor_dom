<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import type SelectItemDto from "@/dto/SelectItemDto.ts";

export default defineComponent({
  name: "SelectWithSearch",
  props: {
    icon: String,
    label: String,
    color: String,
    modelValue: {
      type: [Boolean, String, Object, Array, null],
      default: null
    },
    values: {
      type: Array as PropType<SelectItemDto[]>,
      default: []
    }
  },
  data: function () {
    return {
      searchText: null,
      searchResult: [] as SelectItemDto[],
      selectedFruits: [],
      fruits: []
    };
  },
  methods: {
    select: function (val: any) {
      this.$emit('update:modelValue', val);
    },
  },
  updated(): any {
    this.searchResult = this.values;
  },
  watch: {
    'searchText': function (value: string, oldValue) {
      if (value.length > 0) {
        this.searchResult = this.values.filter((selectItem: SelectItemDto) => {
          return selectItem.label.toLowerCase().indexOf(value.toLowerCase()) != -1;
        });
      } else {
        this.searchResult = this.values;
      }
    }
  },
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


    <v-card min-width="320" class="pa-4">
      <v-text-field v-model="searchText" :label="label"/>

      <v-divider/>

      <v-list>
        <v-list-item
          v-for="(item, index) in searchResult"
          :key="index"
          :value="index"
          @click="select(item.value)"
        >
          <v-list-item-title>{{ item.label }}</v-list-item-title>
        </v-list-item>
      </v-list>
    </v-card>

  </v-menu>


</template>

<style scoped>

</style>
