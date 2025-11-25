<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import type BxUserDto from "@/dto/bitrix/BxUserDto.ts";
import CreateAgentModal from "@/components/site/modal/create-agent-modal.vue";
import AccessService from "@/service/AccessService.ts";

export default defineComponent({
  name: "ShortAgentList",
  computed: {
    AccessService() {
      return AccessService
    }
  },
  components: {CreateAgentModal},
  props: {
    agents: {
      type: Array as PropType<BxUserDto[]>,
      default: [],
    },
  },
  data: function () {
    return {
      showModal: false,
      user: {} as BxUserDto
    };
  },
  mounted(): any {
    console.log('short agent list');
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
    v-if="AccessService.hasRole(['ADMIN','MANAGER'])"
    class="pa-3 mb-3 mt-3"
    title="Агенты"
  >
    <v-divider v-if="agents.length > 0"/>

    <v-card-text v-if="agents.length > 0">
      <div class="mb-3 agent-item" v-for="agent in agents">
        <v-avatar
          size="36px"
        >
          <v-img
            v-if="agent.avatar?.src"
            :alt="agent.fullName"
            :src="agent.avatar?.src"
          ></v-img>

        </v-avatar>

        <a :href="`/profile/agents/${agent.id}/`">{{ agent.fullName }}</a>
      </div>
    </v-card-text>

    <v-divider/>

    <v-card-actions class="flex-row justify-space-between ga-2">
      <v-btn color="primary" href="/profile/agents/">Все агенты</v-btn>
      <v-btn
        variant="flat"
        color="green-darken-2"
        class="text-white"
        @click.prevent="doShowModal"
      >Добавить агента
      </v-btn>
    </v-card-actions>

    <CreateAgentModal
      v-model="showModal"
    />

  </v-card>
</template>


<style scoped lang="scss">
.agent-item {
  display: flex;
  align-items: center;
  gap: 15px;
}
</style>
