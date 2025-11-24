<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import CheckboxDropdown from "@/components/filter/part/checkbox-dropdown.vue";
import InputDropdown from "@/components/filter/part/input-dropdown.vue";
import MinMaxInputDropdown from "@/components/filter/part/min-max-input-dropdown.vue";
import ApartmentFilterService from "@/service/ApartmentFilterService.ts";
import type ApartmentFilterDto from "@/dto/ApartmentFilterDto.ts";
import type ApartmentPreFilterRequestDto from "@/dto/request/ApartmentPreFilterRequestDto.ts";
import type ApartmentPrefilterResponseDto from "@/dto/response/ApartmentPrefilterResponseDto.ts";
import type ApartmentFilterRequestDto from "@/dto/request/ApartmentFilterRequestDto.ts";
import type ApartmentFilterResponseDto from "@/dto/response/ApartmentFilterResponseDto.ts";
import type ApartmentDto from "@/dto/entity/ApartmentDto.ts";
import {useApartmentFilterStore} from "@/stores/app.ts";
import SelectWithSearch from "@/components/filter/part/select-with-search.vue";
import type CheckboxDropdownItemDto from "@/dto/present/CheckboxDropdownItemDto.ts";
import type {ApartmentFilterData, ApartmentFilterProp, ApartmentFilterPropValue} from "@/dto/ApartmentFilterData.ts";
import type SelectItemDto from "@/dto/SelectItemDto.ts";
import type ApartmentFilterDataResponseDto from "@/dto/response/ApartmentFilterDataResponseDto.ts";

export default defineComponent({
  name: "MainApartmentFilter",
  components: {SelectWithSearch, MinMaxInputDropdown, InputDropdown, CheckboxDropdown},
  props: {
    skip: {
      type: Array,
      default: []
    },
    filterApartmentList: {
      type: Array as PropType<ApartmentDto[]>,
      default: []
    },
  },
  data: function () {
    return {
      canFilter: false,
      filterTimeout: 0,
      preFilterTimeout: 0,
      preFilterCount: -1,
      filterData: {} as ApartmentFilterData,
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
        developerId: [],
        buildObjectId: [],
      } as ApartmentFilterDto
    };
  },
  mounted(): any {
    let store = useApartmentFilterStore();
    let defStore = store.getFilterData;
    this.filter = {...defStore};

    ApartmentFilterService.filterData()
      .then((response: ApartmentFilterDataResponseDto) => {
        let {data} = response;
        let {filter} = data;
        this.filterData.propertyList = filter.props;
      });
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
    getAr: function (code: string): CheckboxDropdownItemDto[] | SelectItemDto[] {


      let prop: ApartmentFilterProp | undefined = this.filterData?.propertyList?.filter((item: ApartmentFilterProp) => {
        return item.code === code;
      }).shift()

      if (prop === undefined) {
        return [];
      }


      switch (prop.type) {
        case 'select':

          if (!Array.isArray(prop.value)) {
            return [];
          }

          return prop.value.map(function (el: ApartmentFilterPropValue) {
            return {
              value: el.value,
              label: el.label,
            } as SelectItemDto;
          }) as SelectItemDto[];
        default:
          if (!Array.isArray(prop.value)) {
            return [];
          }

          return prop.value.map(function (el: ApartmentFilterPropValue) {
            return {
              label: el.label,
              value: el.value,
            } as CheckboxDropdownItemDto;
          }) as CheckboxDropdownItemDto[];
      }

    }
  },
  watch: {
    'filter': {
      handler(v, nv) {


        console.log('canFilter', this.canFilter);

        if (!this.canFilter) {
          return;
        }

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
          <v-col v-if="!skip.includes('developerId')">
            <SelectWithSearch
              :values="(getAr('developer')) as SelectItemDto[]"
              color="light-blue"
              label="Застройщик"
              icon="$cash"
              v-model="filter.developerId"
            />
          </v-col>
          <v-col v-if="!skip.includes('buildObjectId')">
            <SelectWithSearch
              :values="(getAr('buildObjectList')) as SelectItemDto[]"
              color="light-blue"
              label="Жилой комплекс"
              icon="$cash"
              v-model="filter.buildObjectId"
            />
          </v-col>
          <v-col v-if="!skip.includes('price.min')">
            <MinMaxInputDropdown
              color="light-blue"
              label="Стомость"
              icon="$cash"
              v-model:min="filter.price.min"
              v-model:max="filter.price.max"
            />
          </v-col>
          <v-col v-if="!skip.includes('price')">
            <CheckboxDropdown
              :multiple="true"
              color="light-blue"
              label="Сан-узел"
              icon="$shower"
              v-model="filter.bathroom"
              :values="(getAr('bathroom')) as CheckboxDropdownItemDto[]"
            />
          </v-col>
          <v-col v-if="!skip.includes('renovation')">
            <CheckboxDropdown
              :multiple="true"
              color="light-blue"
              label="Отделка"
              icon="$hammer"
              v-model="filter.renovation"
              :values="(getAr('renovation')) as CheckboxDropdownItemDto[]"
            />
          </v-col>
          <v-col v-if="!skip.includes('floorsTotal')">
            <InputDropdown
              v-model="filter.floorsTotal"
              color="light-blue"
              label="Этажей в доме"
              icon="$floorPlan"
            />
          </v-col>
          <v-col v-if="!skip.includes('roomsTotal')">
            <InputDropdown
              v-model="filter.roomsTotal"
              color="light-blue"
              label="Кол-во комнат"
              icon="$bed"
            />
          </v-col>
          <v-col v-if="!skip.includes('floor')">
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
