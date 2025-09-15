<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import type {TableRowDto} from "@/dto/present/TableRowDto.ts";

export default defineComponent({
  name: "Table",
  data: function () {
    return {
      itemsPerPage: 5,
      totalItems: 0,
      loading: false
    };
  },
  props: {
    header: {
      type: Array as PropType<any[]>,
      default: []
    },
    records: {
      type: Array as PropType<TableRowDto[]>,
      default: []
    },
    count: {
      type: Number,
      default: 10
    },
    hideActionBlock: {
      type: Boolean,
      default: false
    }
  },
  methods: {
    loadItems: function () {
    },
  },
  mounted(): any {
    console.log(this.header);
  }
})
</script>

<template>
  <v-data-table-server
    v-model:items-per-page="itemsPerPage"
    :headers="header"
    :items="records"
    :items-length="totalItems"
    :loading="loading"
    item-value="name"
    @update:options="loadItems"
  >

    <template #item="{item}">
      <tr class="system-table-row">
        <td class="system-table-col" v-for="(key) in (Object.keys(item))">
          {{ item[String(key)] as string }}
        </td>

        <td class="system-table-col" v-if="!hideActionBlock">
          <v-btn :href="`/profile/managers/${item.id}/`" variant="text">
            <v-icon icon="$editBox"></v-icon>
          </v-btn>
          <v-menu>
            <template v-slot:activator="{ props }">
              <v-icon icon="$cog" v-bind="props"></v-icon>
            </template>
            <v-list>
              <v-list-item>
                <v-list-item-title>Посмотреть</v-list-item-title>
              </v-list-item>
              <v-list-item>
                <v-list-item-title>Удалить</v-list-item-title>
              </v-list-item>
            </v-list>
          </v-menu>
        </td>
      </tr>
    </template>

  </v-data-table-server>
</template>

<style lang="scss">
.system-table {
  width: 100%;

  &-row {
    //display: flex;
    //align-items: center;
    //justify-content: flex-start;
  }

  &-col {
  }
}
</style>
