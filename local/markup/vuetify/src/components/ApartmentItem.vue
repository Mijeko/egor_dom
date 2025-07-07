<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import type ApartmentDto from "@/dto/entity/ApartmentDto.ts";
import Price from "../core/Price.ts";

export default defineComponent({
  name: "ApartmentItem",
  computed: {
    countImages(): number {
      if (this.apartment?.planImages?.length) {
        return this.apartment?.planImages?.length;
      }

      return 0;
    },
    Price() {
      return Price
    }
  },
  data: function () {
    return {
      show: false,
    };
  },
  props: {
    apartment: {
      type: Object as PropType<ApartmentDto>,
      default: null
    }
  },
  mounted(): any {
    console.log(this.apartment);
  }
})
</script>

<template>
  <v-card
    class="mx-auto"
  >
    <v-carousel :show-arrows="countImages > 1">
      <v-carousel-item
        v-for="galleryItem in apartment?.planImages"
        :src="galleryItem.src"
        cover
      ></v-carousel-item>
    </v-carousel>

    <v-card-title>
      {{ apartment.name }}
    </v-card-title>

    <v-card-subtitle>
      Цена: {{ Price.format(apartment.price) }}
    </v-card-subtitle>

    <v-card-subtitle>
      Этаж: {{ apartment.floor }}
    </v-card-subtitle>

    <v-card-subtitle>
      Кол-во комнат: {{ apartment.rooms }}
    </v-card-subtitle>

    <v-card-subtitle v-if="apartment.renovation">
      Отделка: {{ apartment.renovation }}
    </v-card-subtitle>

    <v-card-subtitle v-if="apartment.builtYear">
      Год сдачи: {{ apartment.builtYear }}
    </v-card-subtitle>

    <v-card-subtitle v-if="apartment.builtState">
      Состояние: {{ apartment.builtState }}
    </v-card-subtitle>

    <v-card-actions>
      <v-btn
        color="orange-lighten-2"
        text="Описание"
      ></v-btn>

      <v-spacer></v-spacer>

      <v-btn
        :icon="show ? 'mdi-chevron-up' : 'mdi-chevron-down'"
        @click="show = !show"
      ></v-btn>
    </v-card-actions>

    <v-expand-transition>
      <div v-show="show">
        <v-divider></v-divider>

        <v-card-text>
          {{ apartment?.description ?? apartment?.buildObject?.description ?? 'Отсутствует' }}
        </v-card-text>
      </div>
    </v-expand-transition>


    <v-btn color="second">Купить квартиру</v-btn>
  </v-card>
</template>

<style scoped>

</style>
