<script lang="ts">
import {defineComponent, type PropType} from 'vue';
import ApartmentList from "@/components/apartment/apartment-list.vue";
import Map from "@/components/map.vue";
import type BuildObjectDetailInfo from "@/dto/present/build-object-detail-info.ts";
import type BuildObjectDto from "@/dto/entity/BuildObjectDto.ts";

export default defineComponent({
  name: "BuildObjectDetail",
  components: {Map, ApartmentList},
  props: {
    buildObject: {
      type: Object as PropType<BuildObjectDto>
    }
  },
  data: function () {
    return {
      isRunFilter: false,
      filterApartmentList: [],
    };
  },
  computed: {
    computedApartments: function () {

      if (this.filterApartmentList.length > 0) {
        return this.filterApartmentList;
      }

      return this.buildObject?.apartments;
    },
    buildObjectDetailInfoComputed: function (): BuildObjectDetailInfo[] {
      return [
        {
          title: 'Ваше вознаграждение',
          value: '<span style="color:green; font-weight:600;">4%</span>',
        },
        {
          title: 'Застройщик',
          value: String(this.buildObject?.developer?.name),
        },
        {
          title: 'Колличество этажей',
          value: String(this.buildObject?.floors),
        },
        {
          title: 'Адрес',
          value: `${this.buildObject?.location?.country}, ${this.buildObject?.location?.localityName}, ${this.buildObject?.location?.address}`
        },
        {
          title: 'Тип дома',
          value: String(this.buildObject?.type)
        }
      ]
    }
  },
  methods: {
    getPresentation: function () {
    }
  },
})
</script>

<template>

</template>

<style scoped>

</style>
