<script setup lang="ts">

import {useAlertsStore} from "@/store.ts";
import type AlertItemDto from "@/dto/AlertItemDto.ts";

import {onUpdated, ref} from "vue";

const alertsStore = useAlertsStore();

let alerts = ref(alertsStore.listAlert);

onUpdated(() => {
  setTimeout(() => {
    alertsStore.clear();
    alerts.value = [];
  }, 7500)
})

</script>
<template>
  <v-alert
    v-for="(alert) in alerts as AlertItemDto[]"
    max-width="400"
    style="z-index:9999!important;"
    class="bottom-0 left-0 ml-3 mb-3"
    position="fixed"
    :text="alert.text"
    :title="alert.title"
    :type="alert.type"
  ></v-alert>
</template>

<style scoped>

</style>
