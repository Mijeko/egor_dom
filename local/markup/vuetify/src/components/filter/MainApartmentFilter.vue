<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import CheckboxDropdown from "@/components/filter/part/CheckboxDropdown.vue";
import InputDropdown from "@/components/filter/part/InputDropdown.vue";
import MinMaxInputDropdown from "@/components/filter/part/MinMaxInputDropdown.vue";
import ApartmentFilterService from "@/service/ApartmentFilterService.ts";
import type ApartmentFilterDto from "@/dto/ApartmentFilterDto.ts";
import type ApartmentPreFilterRequestDto from "@/dto/request/ApartmentPreFilterRequestDto.ts";
import type ApartmentPrefilterResponseDto from "@/dto/response/ApartmentPrefilterResponseDto.ts";
import type ApartmentFilterRequestDto from "@/dto/request/ApartmentFilterRequestDto.ts";
import type ApartmentFilterResponseDto from "@/dto/response/ApartmentFilterResponseDto.ts";
import type ApartmentDto from "@/dto/entity/ApartmentDto.ts";
import {useApartmentFilterStore} from "@/store.ts";

export default defineComponent({
  name: "MainApartmentFilter",
  components: {MinMaxInputDropdown, InputDropdown, CheckboxDropdown},
  props: {
    filterApartmentList: {
      type: Array as PropType<ApartmentDto[]>,
      default: []
    }
  },
  data: function () {
    return {
      filterTimeout: 0,
      preFilterTimeout: 0,
      preFilterCount: -1,
      filter: {
        price: {
          min: null,
          max: null,
        },
        bathroom: [],
        renovation: [],
        floorsTotal: null,
        roomsTotal: null,
        floor: null,
      } as ApartmentFilterDto
    };
  },
  mounted(): any {
    let store = useApartmentFilterStore();
    let defStore = store.getFilterData;
    this.filter = {...defStore};
  },
  methods: {
    clearFilter: function () {

    },
    runFilter: function () {
      let service = new ApartmentFilterService();
      let body: ApartmentFilterRequestDto = {
        action: 'filter',
        ...this.filter
      };


      if (this.filterTimeout) {
        clearTimeout(this.filterTimeout);
      }

      this.filterTimeout = setTimeout(() => {
        service.filterAction(body).then((response: ApartmentFilterResponseDto) => {
          let {data} = response;

          let {items, filterUrl} = data;

          if (items.length > 0) {
            this.$emit('update:modelValue', items);
            window.history.pushState(null, '', filterUrl);
          }

        });

      }, 400);
    },
  },
  watch: {
    'filter': {
      handler(v, nv) {
        let service = new ApartmentFilterService();
        let body: ApartmentPreFilterRequestDto = {
          action: 'prefilter',
          ...this.filter
        };


        if (this.preFilterTimeout) {
          clearTimeout(this.preFilterTimeout);
        }

        this.preFilterTimeout = setTimeout(() => {
          service.preFilterAction(body).then((response: ApartmentPrefilterResponseDto) => {
            let {data} = response;
            if (data) {
              let {count} = data;
              if (count !== undefined) {
                this.preFilterCount = count;
              }
            }
          });
        }, 400);

      },
      deep: true
    }
  },
})
</script>

<template>

  <div class="container">
    <v-form>
      <v-card class="mt-3 mb-5 pa-4">
        <v-row>
          <v-col>
            <MinMaxInputDropdown
              color="light-blue"
              label="Стомость"
              icon="$cash"
              v-model:min="filter.price.min"
              v-model:max="filter.price.max"
            />
          </v-col>
          <v-col>
            <CheckboxDropdown
              color="light-blue"
              label="Сан-узел"
              icon="$shower"
              v-model="filter.bathroom"
              :values="[
                {
                  label:'Совмещенный',
                  value:'union'
                },
                {
                  label:'Раздельный',
                  value:'split'
                }
              ]"
            />
          </v-col>
          <v-col>
            <CheckboxDropdown
              color="light-blue"
              label="Отделка"
              icon="$hammer"
              v-model="filter.renovation"
              :values="[
                {
                  label:'Чистовая',
                  value:'clean'
                },
                {
                  label:'С ремонтом',
                  value:'repair'
                }
              ]"
            />
          </v-col>
          <v-col>
            <InputDropdown
              v-model="filter.floorsTotal"
              color="light-blue"
              label="Этажей в доме"
              icon="$floorPlan"
            />
          </v-col>
          <v-col>
            <InputDropdown
              v-model="filter.roomsTotal"
              color="light-blue"
              label="Кол-во комнат"
              icon="$bed"
            />
          </v-col>
          <v-col>
            <InputDropdown
              v-model="filter.floor"
              color="light-blue"
              label="Этаж"
              icon="$homeFloorNegative"
            />
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="4" md="2">
            <v-btn @click.prevent="runFilter">
              <div class="flex-column">
                <div style="font-size:12px;">Подобрать</div>
                <div style="font-size:10px;" v-if="preFilterCount >= 0">(найдено {{ preFilterCount }})</div>
              </div>
            </v-btn>
          </v-col>
          <v-col cols="4" md="2">
            <v-btn @click.prevent="clearFilter">
              <span>Сбросить</span>
            </v-btn>
          </v-col>
        </v-row>
      </v-card>
    </v-form>
  </div>

</template>

<style lang="scss">

</style>
