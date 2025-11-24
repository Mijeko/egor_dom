<script lang="ts">
import {defineComponent, type PropType} from 'vue';
import ApartmentList from "@/components/apartment/apartment-list.vue";
import Map from "@/components/map.vue";
import ApartmentFilter from "@/components/filter/apartment-filter.vue";
import type BuildObjectDetailInfo from "@/dto/present/build-object-detail-info.ts";
import type BuildObjectDto from "@/dto/entity/BuildObjectDto.ts";
import MainApartmentFilter from "@/components/filter/main-apartment-filter.vue";

export default defineComponent({
  name: "BuildObjectDetail",
  components: {MainApartmentFilter, ApartmentFilter, Map, ApartmentList},
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
  <v-row>
    <v-col cols="12" md="8" class="px-2">
      <v-carousel>
        <v-carousel-item
          v-for="galleryItem in buildObject?.gallery"
          :src="galleryItem.src"
          cover
        ></v-carousel-item>
      </v-carousel>
    </v-col>
    <v-col cols="12" md="4" class="px-2">

      <v-card class="mb-3">
        <v-card-text>
          <v-row>
            <v-col>
              <div style="font-size: 1.25rem; line-height: 1.6;">Презентация</div>
            </v-col>
            <v-col>
              <v-btn variant="outlined" text="Запросить" @click.prevent="getPresentation"></v-btn>
            </v-col>
          </v-row>
        </v-card-text>
      </v-card>

      <v-card v-for="info in buildObjectDetailInfoComputed"
              :title="String(info.title)"
              class="mb-3"
      >
        <template #subtitle>
          <span v-html="String(info.value)"></span>
        </template>
      </v-card>
    </v-col>
  </v-row>

  <v-divider class="mt-15 mb-15"/>

  <h2>Объект на карте</h2>
  <v-row>
    <v-col cols="12">
      <Map
        :apartment-list="buildObject?.apartments"
        :lat="Number(buildObject?.location?.latitude)"
        :lon="Number(buildObject?.location?.longitude)"
      />
    </v-col>
  </v-row>

  <v-divider class="mt-15 mb-15"/>

  <v-row>
    <v-col cols="12">
      <v-row>
        <v-col>
          <h2 class="pt-2">Купить квартиру</h2>
        </v-col>
      </v-row>
      <v-row>
        <v-col>
          <MainApartmentFilter
            v-model="filterApartmentList"
            :skip="['developerId','buildObjectId']"
          />
        </v-col>
      </v-row>

      <ApartmentList
        v-if="buildObject?.apartments"
        :apartments="computedApartments"
      />
    </v-col>
  </v-row>
</template>

<style scoped>

</style>
