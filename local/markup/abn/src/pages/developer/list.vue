<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import DeveloperList from "@/components/developer/developer-list.vue";
import type DeveloperListItemDto from "@/dto/entity/DeveloperListItemDto.ts";
import DeveloperSearch from "@/components/developer/developer-search.vue";

export default defineComponent({
  name: "list",
  components: {DeveloperSearch, DeveloperList},
  props: {
    developers: {
      type: Array as PropType<DeveloperListItemDto[]>
    }
  }
})
</script>

<template>

  <h1>Застройщики</h1>

  <DeveloperSearch/>

  <DeveloperList
    :developers
  />
</template>

<style scoped>

</style>
