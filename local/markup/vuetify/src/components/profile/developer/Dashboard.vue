<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import DeveloperService from "@/service/DeveloperService.ts";
import type ManagerFeedUpdateResponseDto from "@/dto/response/ManagerFeedUpdateResponseDto.ts";
import type SelectVariantDto from "@/dto/present/component/SelectVariantDto.ts";
import type ManagerFeedUpdateRequestDto from "@/dto/request/ManagerFeedUpdateRequestDto.ts";
import SelectHelper from "@/service/SelectHelper.ts";

export default defineComponent({
  name: "Dashboard",
  computed: {
    SelectHelper() {
      return SelectHelper
    }
  },
  props: {
    source: {
      type: Array as PropType<SelectVariantDto[]>,
      default: [],
    },
    channels: {
      type: Array as PropType<{ key: string, label: string }[]>,
      default: [],
    }
  },
  data: function () {
    return {
      lenSources: 2,
      form: {
        sources: [],
        timeoutBron: null,
        timePay: null,
        channelLead: [],
      },
      validate: {
        sources: [
          (value: any) => {
            return true;
          }
        ],
        channelLead: [
          (value: any) => {
            return true;
          }
        ],
        timeoutBron: [
          (value: any) => {
            return true;
          }
        ],
        timePay: [
          (value: any) => {
            return true;
          }
        ],
      }
    };
  },
  methods: {
    incrementLenSource() {
      this.lenSources++;
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
  <v-form @submit="submit" class="d-flex ga-4 flex-wrap">
    <v-card>
      <v-card-text>
        <v-card-title class="mb-3">Источники квартир</v-card-title>
        <v-row class="mb-1" v-for="number in lenSources">
          <v-col cols="12" class="py-0">
            <v-text-field
              v-model="form.sources"
              :rules="validate.sources"
              :hide-details="false"
              label="Ссылка на источник"/>
          </v-col>

          <v-divider v-if="(number) < (lenSources)"/>
        </v-row>
        <v-btn type="submit" class="mr-4">Обновить</v-btn>
        <v-btn type="button" @click="incrementLenSource">Еще</v-btn>
      </v-card-text>
    </v-card>

    <v-card>
      <v-card-text>
        <v-card-title>Способ получения заявки</v-card-title>
        <v-checkbox
          v-for="chanel in SelectHelper.map(channels, {key:'value',label:'label'})"
          :label="chanel.label"
          :value="chanel.value"
          class="pa-0 ma-0"
          v-model="form.channelLead"
          :rules="validate.channelLead"
          multiple
        />
      </v-card-text>
    </v-card>

    <v-card>
      <v-card-text>
        <v-card-title>Время удержания брони</v-card-title>
        <v-text-field
          v-model="form.timeoutBron"
          :rules="validate.timeoutBron"
          label="Время удержания брони, в часах"
        />
      </v-card-text>
    </v-card>

    <v-card width="300px">
      <v-card-text>
        <v-card-title>Срок оплаты</v-card-title>
        <v-text-field
          v-model="form.timePay"
          :rules="validate.timePay"
          label="Срок оплаты, в часах"
        />
      </v-card-text>
    </v-card>
  </v-form>
</template>

<style lang="scss">

</style>
