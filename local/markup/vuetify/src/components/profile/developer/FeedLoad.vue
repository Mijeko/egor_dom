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
  methods: {
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

    <v-row>
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

    <v-btn type="submit">Обновить</v-btn>
  </v-form>
</template>

<style scoped>

</style>
