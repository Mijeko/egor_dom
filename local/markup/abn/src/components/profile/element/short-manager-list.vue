<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import CreateManagerModal from "@/components/modal/CreateManagerModal.vue";
import type BxUserDto from "@/dto/bitrix/BxUserDto.ts";
import {useUserStore} from "@/store.ts";
import AccessService from "@/service/AccessService.ts";
import CreateAgentModal from "@/components/modal/CreateAgentModal.vue";

export default defineComponent({
  name: "ShortManagerList",
  computed: {
    AccessService() {
      return AccessService
    }
  },
  components: {CreateAgentModal, CreateManagerModal},
  props: {
    managers: {
      type: Array as PropType<BxUserDto[]>,
      default: [],
    },
  },
  data: function () {
    return {
      showModal: false,
    };
  },
  methods: {
    doShowModal() {
      this.showModal = !this.showModal;
    }
  }
})
</script>

<template>
  <v-card
    v-if="AccessService.hasRole('ADMIN')"
    class="pa-3 mb-3 mt-3"
    title="Менеджеры"
  >
    <v-divider v-if="managers.length > 0"/>

    <v-card-text v-if="managers.length > 0">
      <div class="mb-3 manager-item" v-for="manager in managers">
        <v-avatar
          size="36px"
        >
          <v-img
            v-if="manager.avatar?.src"
            :alt="manager.fullName"
            :src="manager.avatar?.src"
          ></v-img>

        </v-avatar>

        <a :href="`/profile/managers/${manager.id}/`">{{ manager.fullName }}</a>
      </div>
    </v-card-text>

    <v-divider/>

    <v-card-actions class="flex-row justify-space-between ga-2">
      <v-btn color="primary" href="/profile/managers/">Все менеджеры</v-btn>
      <v-btn
        variant="flat"
        color="green-darken-2"
        class="text-white"
        @click.prevent="doShowModal"
      >Добавить менеджера
      </v-btn>
    </v-card-actions>

    <CreateManagerModal
      v-model="showModal"
    />

  </v-card>
</template>


<style scoped lang="scss">
.manager-item {
  display: flex;
  align-items: center;
  gap: 15px;
}
</style>
