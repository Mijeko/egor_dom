<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import type BxUserDto from "@/dto/bitrix/BxUserDto.ts";
import {useApartmentFilterStore, useUserStore} from "@/store.ts";
import type ApartmentFilterDto from "@/dto/ApartmentFilterDto.ts";

export default defineComponent({
  name: "Init",
  props: {
    user: {
      type: Object as PropType<BxUserDto>,
    },
    apartmentFilter: {
      type: Object as PropType<ApartmentFilterDto>,
      default: null,
    }
  },
  mounted(): any {
    let store = useUserStore();
    store.updateInfo(this.user as BxUserDto);

    let filterStore = useApartmentFilterStore();
    filterStore.pushFilterData(this.apartmentFilter);
  },
})
</script>

<template>

</template>

<style scoped>

</style>
