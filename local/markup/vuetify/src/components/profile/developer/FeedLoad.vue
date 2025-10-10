<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import DeveloperService from "@/service/DeveloperService.ts";
import type ManagerFeedUpdateResponseDto from "@/dto/response/ManagerFeedUpdateResponseDto.ts";
import type SelectVariantDto from "@/dto/present/component/SelectVariantDto.ts";

export default defineComponent({
  name: "FeedLoad",
  props: {
    source: {
      type: Array as PropType<SelectVariantDto[]>,
      default: [],
    }
  },
  data: function () {
    return {
      lenSources: 2
    };
  },
  methods: {
    incrementLenSource() {
      this.lenSources += 1;
    },
    submit() {

      let body: ManagerFeedUpdateRequestDto = {};

      DeveloperService.updateFeedInfo(body)
        .then((data: ManagerFeedUpdateResponseDto) => {

        });

    }
  }
})
</script>

<template>
  <v-form @submit="submit">
    <v-card>
      <v-card-text>
        <v-row class="mb-4" v-for="ii in lenSources">
          <v-col>
            <v-select
              :items="source"
              label="Источник"
              item-value="value"
              item-title="label"
            />
          </v-col>
          <v-col>
            <v-input label="Ссылка на источник"/>
          </v-col>
        </v-row>
        <v-btn type="button" @click="incrementLenSource">Еще</v-btn>
        <v-btn type="submit">Обновить</v-btn>
      </v-card-text>
    </v-card>
  </v-form>
</template>

<style scoped>

</style>
