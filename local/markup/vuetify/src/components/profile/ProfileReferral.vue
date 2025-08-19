<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import type ReferralDto from "@/dto/ReferralDto.ts";

export default defineComponent({
  name: "ProfileReferral",
  props: {
    referral: {
      type: Object as PropType<ReferralDto>,
    }
  },
  computed: {
    items: function () {

      let ref: ReferralDto = this.referral as ReferralDto;

      return [
        'Приглашено: ' + ref.countJoined,
        'Получено вознаграждения: ' + ref.reward,
      ]
    }
  },
  methods: {
    copy: function () {
      if (this.referral?.link) {
        this.copyToClipboard(String(this.referral?.link));
      }
    },
    async copyToClipboard(text: string) {
      try {
        await navigator.clipboard.writeText(text);
        console.log('Text copied to clipboard!');
      } catch (err) {
        console.error('Failed to copy text: ', err);
      }
    }
  }
})
</script>

<template>
  <v-card title="Реферальная система">
    <template #subtitle v-if="referral?.link">
      Ссылка-приглашение<br>{{ referral.link }}
    </template>
    <v-divider/>
    <v-card-text>
      <div class="mb-3" v-for="item in items" v-html="item"></div>
    </v-card-text>
    <v-divider/>

    <v-card-actions>
      <v-btn @click.prevent="copy">Скопировать</v-btn>
    </v-card-actions>
  </v-card>
</template>

<style lang="scss">

</style>
