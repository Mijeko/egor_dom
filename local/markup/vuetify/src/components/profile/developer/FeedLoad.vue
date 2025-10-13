<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import DeveloperService from "@/service/DeveloperService.ts";
import type ManagerFeedUpdateResponseDto from "@/dto/response/ManagerFeedUpdateResponseDto.ts";
import type SelectVariantDto from "@/dto/present/component/SelectVariantDto.ts";
import type ManagerFeedUpdateRequestDto from "@/dto/request/ManagerFeedUpdateRequestDto.ts";

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
        <v-card-title>Источники квартир</v-card-title>
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

    <v-card>
      <v-card-text>
        <v-card-title>Способ получения заявки</v-card-title>
        <v-checkbox name="channelLead" label="Tg"></v-checkbox>
        <v-checkbox name="channelLead" label="Email"></v-checkbox>
        <v-checkbox name="channelLead" label="Call"></v-checkbox>
      </v-card-text>
    </v-card>

    <v-card>
      <v-card-text>
        <v-card-title>Время удержания брони</v-card-title>
        <v-text-field name="timeoutBron" label="Время удержания брони, в часах"/>
      </v-card-text>
    </v-card>

    <v-card>
      <v-card-text>
        <v-card-title>Срок оплаты</v-card-title>
        <v-text-field name="timePay" label="Срок оплаты, в часах"/>
      </v-card-text>
    </v-card>
  </v-form>
</template>

<style lang="scss">

</style>
