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
      default: () => {
        return {
          id: 0,
          name: 'Новосибирск'
        } as CityDto
      }
    },
    cityList: {
      type: Array as PropType<CityDto[]>,
      default: () => []
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
  <v-dialog max-width="500" v-model="showModal" v-if="currentCity">
    <template v-slot:activator="{ props: activatorProps }">

      <div
        v-bind="activatorProps"
        class="current-city"
      >
        <slot name="gpsIcon" v-if="$.slots.gpsIcon"></slot>
        <img v-else src="@/assets/images/icons/gps.svg" alt="gps">
        <div class="current-city__label">{{ currentCity.name }}</div>
      </div>

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

<style lang="scss">

@use "@/styles/system/variable" as *;

.current-city {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 10px;
  cursor: pointer;

  &__icon {
    display: block;
  }

  &__label {
    font-family: var(--font-family);
    font-weight: 400;
    font-size: 14px;
    line-height: 120%;
    text-decoration: underline;
    text-decoration-skip-ink: none;
    color: $gray-color;
  }
}
</style>
