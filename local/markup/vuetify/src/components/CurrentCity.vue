<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import type CityDto from "@/dto/entity/CityDto.ts";
import CurrentCityService from "@/service/CurrentCityService.ts";
import type CurrentCityResponseDto from "@/dto/response/CurrentCityResponseDto.ts";

export default defineComponent({
  name: "CurrentCity",
  data: function () {
    return {
      showModal: false
    };
  },
  props: {
    currentCity: {
      type: Object as PropType<CityDto>,
      default: null,
    },
    cityList: {
      type: Array as PropType<CityDto[]>,
      default: []
    },
  },
  methods: {
    label: function (city: CityDto) {
      let label: string = city.name;

      if (city.id == this.currentCity.id) {
        label += ' (текущий)';
      }

      return label;
    },
    select: function (city: CityDto) {
      let service = new CurrentCityService();
      service.saveCity(city).then((response: CurrentCityResponseDto) => {
        let {status, data} = response;

        if (status === 'success') {
          if (data) {
            let {redirect} = data;
            if (redirect) {
              window.location.href = redirect;
            }
          }
        }

      });

    }
  },
})
</script>

<template>
  <v-dialog max-width="500" v-model="showModal">
    <template v-slot:activator="{ props: activatorProps }">
      <v-chip
        v-bind="activatorProps"
        variant="text"
        prepend-icon="$mapMarker"
      >
        {{ currentCity.name }}
      </v-chip>
    </template>

    <template v-slot:default="{ isActive }">
      <v-card title="Выбрать город">

        <v-list>
          <v-list-item v-for="(city, i) in cityList" :key="i" :value="city" @click="select(city)">
            <v-list-item-title>{{ label(city) }}</v-list-item-title>
          </v-list-item>
        </v-list>

        <v-card-actions>
          <v-spacer></v-spacer>

          <v-btn
            text="Закрыть"
            @click="isActive.value = false"
          ></v-btn>
        </v-card-actions>
      </v-card>
    </template>
  </v-dialog>
</template>

<style scoped>

</style>
