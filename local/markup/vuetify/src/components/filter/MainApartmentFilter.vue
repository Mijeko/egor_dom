<script lang="ts">
import {defineComponent} from 'vue'
import CheckboxDropdown from "@/components/filter/part/CheckboxDropdown.vue";
import InputDropdown from "@/components/filter/part/InputDropdown.vue";
import MinMaxInputDropdown from "@/components/filter/part/MinMaxInputDropdown.vue";

export default defineComponent({
  name: "MainApartmentFilter",
  components: {MinMaxInputDropdown, InputDropdown, CheckboxDropdown},
  data: function () {
    return {
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
      }
    };
  }
})
</script>

<template>

  <div class="container">
    {{ filter }}
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
              icon="$bed"
            />
          </v-col>
        </v-row>
      </v-card>
    </v-form>
  </div>

</template>

<style lang="scss">

</style>
