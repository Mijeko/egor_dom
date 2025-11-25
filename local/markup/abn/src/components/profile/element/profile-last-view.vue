<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import type BuildObjectDto from "@/dto/entity/BuildObjectDto.ts";

export default defineComponent({
  name: "ProfileLastView",
  props: {
    buildObjectList: {
      type: Array as PropType<BuildObjectDto[]>,
      default: []
    }
  },
  data: function () {
    return {
      items: [
        'Трёшка',
        'Двушка',
        'Однушка',
      ]
    }
  }
})
</script>

<template>
  <v-card title="Просмотренные квартиры" v-if="buildObjectList.length > 0">
    <v-divider/>

    <v-card-text>
      <div class="mb-3" v-for="item in buildObjectList">
        <a :href="item.detailLink" v-html="item.name"></a>
      </div>
    </v-card-text>
    <v-divider/>

    <v-card-actions>
      <v-btn>Посмотреть всё</v-btn>
    </v-card-actions>
  </v-card>
</template>

<style scoped>

</style>
