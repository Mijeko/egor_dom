<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import type ApartmentDto from "@/dto/entity/ApartmentDto.ts";
import BuyApartmentModal from "@/components/modal/BuyApartmentModal.vue";
import Price from "../core/Price.ts";

export default defineComponent({
  name: "ApartmentList",
  computed: {
    Price() {
      return Price
    }
  },
  components: {BuyApartmentModal},
  data: function () {
    return {
      show: false,
      selectBuildObjectId: 0,
      openModal: false,
    };
  },
  props: {
    apartments: {
      type: Array as PropType<ApartmentDto[]>,
      default: []
    }
  }
})
</script>

<template>


  <v-row>
    <v-col cols="3" v-for="apart in apartments">
      <v-card
        class="mx-auto"
        max-width="344"
      >
        <v-carousel>
          <v-carousel-item
            v-for="galleryItem in apart.buildObject?.gallery"
            :src="galleryItem.src"
            cover
          ></v-carousel-item>
        </v-carousel>

        <v-card-title>
          {{ apart.name }}
        </v-card-title>

        <v-card-subtitle>
          {{ Price.format(apart.price) }}
        </v-card-subtitle>

        <v-card-actions>
          <v-btn
            color="orange-lighten-2"
            text="Explore"
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
              I'm a thing. But, like most politicians, he promised more than he could deliver. You won't have time for
              sleeping, soldier, not with all the bed making you'll be doing. Then we'll go with that data file! Hey,
              you
              add a one and two zeros to that or we walk! You're going to do his laundry? I've got to find a way to
              escape.
            </v-card-text>
          </div>
        </v-expand-transition>
      </v-card>
    </v-col>
  </v-row>


  <BuyApartmentModal
    v-model="openModal"
    :build-object-id="selectBuildObjectId"
  />

</template>

<style scoped>

</style>
