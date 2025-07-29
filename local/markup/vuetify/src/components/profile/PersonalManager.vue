<script lang="ts">
import {defineComponent} from 'vue'
import ContactPersonalManager from "@/components/modal/ContactPersonalManager.vue";
import {useUserStore} from "@/store.ts";
import type ManagerDto from "@/dto/entity/ManagerDto.ts";

export default defineComponent({
  name: "PersonalManager",
  components: {ContactPersonalManager},
  data: function () {
    return {
      manager: {} as ManagerDto,
      showModal: false,
    }
  },
  mounted(): any {
    let userStore = useUserStore();

    let manager = userStore.getUser.manager;

    if (manager !== undefined) {
      this.manager = manager;

      console.log(this.manager);
    }
  }
})
</script>

<template>
  <v-card class="pa-3 mb-3 mt-3" v-if="manager.id">
    <v-row>
      <v-col cols="1">
        <v-avatar size="100" image="https://shapka-youtube.ru/wp-content/uploads/2024/08/avatarka-bryunetka.jpg"/>
      </v-col>
      <v-col cols="4">
        <v-card-title>{{ manager.lastName }} {{ manager.name }} {{ manager.secondName }}</v-card-title>
        <v-card-subtitle>Ваш персональный менеджер</v-card-subtitle>
      </v-col>
      <v-col cols="7" class="d-flex">
        <v-btn
          class="ml-auto mt-6 mr-5"
          @click.prevent="showModal=true"
          elevation="0"
          variant="tonal"
        >Связаться
        </v-btn>
      </v-col>
    </v-row>
  </v-card>

  <ContactPersonalManager
    v-model="showModal"
    :manager="manager"
  />
</template>

<style scoped>

</style>
