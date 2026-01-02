<script lang="ts">
import {defineComponent} from 'vue'
import Homepage from '@/layouts/homepage.vue';
import ContactsBlock from "@/components/homepage/contacts-block.vue";
import DeveloperIcons from "@/components/homepage/developer-icons.vue";
import SecurityBlock from "@/components/homepage/security-block.vue";
import HowItWork from "@/components/homepage/how-it-work.vue";
import Chota from "@/components/chota.vue";
import FirstScreen from "@/components/homepage/first-screen.vue";
import type BxUserDto from "@/dto/bitrix/BxUserDto.ts";

export default defineComponent({
  name: "index",
  components: {FirstScreen, Chota, HowItWork, SecurityBlock, DeveloperIcons, ContactsBlock},
  layout: [Homepage],
  props: {
    user: {
      type: Object as PropType<BxUserDto>,
      default: () => {
        return {};
      }
    }
  },
})
</script>

<template>

  <FirstScreen
    :user
  />

  <SecurityBlock/>
  <HowItWork/>
  <DeveloperIcons/>
  <ReviewsBlock/>
  <Chota/>
  <ContactsBlock/>

</template>

<style lang="scss">

</style>
