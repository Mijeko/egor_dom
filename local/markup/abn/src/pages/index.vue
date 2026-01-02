<script lang="ts">
import {defineComponent} from 'vue'
import Homepage from '@/layouts/homepage.vue';
import ContactsBlock from "@/components/homepage/contacts-block.vue";
import DeveloperIcons from "@/components/homepage/developer-icons.vue";
import SecurityBlock from "@/components/homepage/security-block.vue";

export default defineComponent({
  name: "index",
  components: {SecurityBlock, DeveloperIcons, ContactsBlock},
  layout: [Homepage],
})
</script>

<template>

  <SecurityBlock/>
  <DeveloperIcons/>
  <ReviewsBlock/>
  <ContactsBlock/>

</template>

<style lang="scss">

</style>
