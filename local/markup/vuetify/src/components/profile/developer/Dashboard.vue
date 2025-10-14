<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import DeveloperService from "@/service/DeveloperService.ts";
import type ManagerFeedUpdateResponseDto from "@/dto/response/ManagerFeedUpdateResponseDto.ts";
import type SelectVariantDto from "@/dto/present/component/SelectVariantDto.ts";
import type ManagerFeedUpdateRequestDto from "@/dto/request/ManagerFeedUpdateRequestDto.ts";
import SelectHelper from "@/service/SelectHelper.ts";
import type BxUserDto from "@/dto/bitrix/BxUserDto.ts";
import {useUserStore} from "@/store.ts";

export default defineComponent({
  name: "Dashboard",
  computed: {
    SelectHelper() {
      return SelectHelper
    }
  },
  created(): any {
    let userStore = useUserStore();
    let user = userStore.getUser;

    if (user) {
      this.currentUser = user;
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
      currentUser: null as BxUserDto | null,
      timer: 0,
      lenSources: 2,
      isValidForm: false,
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
    decrementLenSource() {
      if (this.lenSources - 1 > 0) {
        this.lenSources--;
      }
    },
    incrementLenSource() {
      if (this.lenSources + 1 < 5) {
        this.lenSources++;
      }
    },
    submit() {

      console.log('this submit form');

      if (!this.isValidForm) {
        return;
      }

      let body: ManagerFeedUpdateRequestDto = {
        developerId: (this.currentUser as BxUserDto).id,
        sources: this.form.sources,
        channelLead: this.form.channelLead,
        timeoutBron: Number(this.form.timeoutBron),
        timePay: Number(this.form.timePay)
      };

      if (this.timer) {
        clearTimeout(this.timer);
      }

      this.timer = setTimeout(function () {

        DeveloperService.update(body)
          .then((data: ManagerFeedUpdateResponseDto) => {
            console.log(data);
          })
          .then((r: any) => {
            console.log(r);
          })
          .then((r: any) => {
            console.log(r);
          })
          .catch((r: any) => {
            console.log(r);
          });
      }, 500);

    },
  },
  watch: {
    'form': {
      handler: function (nV: any, oV: any) {

        // let form: any = this.$refs['form'] as any;
        // if (form) {
        //   form.submit();
        // }

        this.submit();
      },
      deep: true,
    },
  }
})
</script>

<template>
  <v-form @submit.prevent="submit" ref="form" v-model="isValidForm" class="d-flex ga-4 flex-wrap">
    <v-card>
      <v-card-text>
        <v-card-title class="mb-3">Источники квартир</v-card-title>
        <v-row class="mb-1" v-for="number in lenSources">
          <v-col cols="12" class="py-0">
            <v-text-field
              multiple="multiple"
              v-model="form.sources[number]"
              :rules="validate.sources"
              :hide-details="false"
              label="Ссылка на источник"/>
          </v-col>

          <v-divider v-if="(number) < (lenSources)"/>
        </v-row>
        <v-btn type="button" @click="decrementLenSource" class="mr-4">Убрать</v-btn>
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

    <v-card width="400px">
      <v-card-text>
        <v-card-title>Срок оплаты</v-card-title>
        <v-text-field
          v-model="form.timePay"
          :rules="validate.timePay"
          label="Срок оплаты, в часах"
        />
      </v-card-text>

      <v-divider/>


      <v-card-text>
        <v-card-title>Время удержания брони</v-card-title>
        <v-text-field
          v-model="form.timeoutBron"
          :rules="validate.timeoutBron"
          label="Время удержания брони, в часах"
        />
      </v-card-text>

    </v-card>
  </v-form>
</template>

<style lang="scss">

</style>
