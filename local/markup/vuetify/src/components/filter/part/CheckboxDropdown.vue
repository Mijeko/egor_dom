<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import type CheckboxDropdownItemDto from "@/dto/present/CheckboxDropdownItemDto.ts";
import {th} from "vuetify/locale";

export default defineComponent({
  name: "CheckboxDropdown",
  props: {
    label: String,
    icon: String,
    color: String,
    values: Array as PropType<CheckboxDropdownItemDto[]>,
    modelValue: {
      type: [String, Number, null, Array],
      default: null
    }
  },
  computed: {
    rawValue: {
      get() {
        return this.modelValue;
      },
      set(value: any) {
        this.$emit('update:modelValue', value)
      },
    },
    htmlLabel: function () {

      let currentValues: CheckboxDropdownItemDto[] | undefined = this.values;
      let selectValues: string[] = this.modelValue as string[];
      if (!currentValues || selectValues.length == 0) {
        return null;
      }


      let _firstItem: string = selectValues[0];

      let firstItemList: CheckboxDropdownItemDto[] = currentValues.filter((item: CheckboxDropdownItemDto) => {
        return item.value === _firstItem;
      });

      if (firstItemList.length != 1) {
        return null;
      }

      let firstItem: CheckboxDropdownItemDto | undefined = firstItemList.shift();
      if (!firstItem) {
        return null;
      }

      let out = `<span> * ${firstItem.label}</span>`;

      if (selectValues.length > 1) {
        out += ` + ${(selectValues.length) - 1}`;
      }

      return out;
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
        <span v-if="htmlLabel" v-html="htmlLabel"/>
      </v-btn>
    </template>


    <v-card min-width="300" class="pa-4">
      <div v-for="item in values">
        <v-checkbox
          :hide-details="true"
          v-model="rawValue"
          :value="item.value"
          :color
          :label="item.label"
        />
      </div>
    </v-card>

  </v-menu>
</template>

<style scoped>

</style>
