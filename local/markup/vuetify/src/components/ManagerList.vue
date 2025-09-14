<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import type BxUserDto from "@/dto/bitrix/BxUserDto.ts";
import CreateManagerModal from "@/components/modal/CreateManagerModal.vue";

export default defineComponent({
  name: "ManagerList",
  components: {CreateManagerModal},
  props: {
    managers: {
      type: Array as PropType<BxUserDto[]>,
      default: [],
    }
  },
  data: function () {
    return {
      showModal: false
    };
  },
  mounted(): any {
    console.log(this.managers);
  },
  methods: {
    doShowModal() {
      this.showModal = !this.showModal;
    }
  }
})
</script>

<template>
  <v-card class="pa-3 mb-3 mt-3" v-if="managers.length > 0" title="Менеджеры">
    <v-divider/>

    <v-card-text>
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

        <div>{{ manager.fullName }}</div>
      </div>
    </v-card-text>

    <v-divider/>

    <v-card-actions class="flex-row justify-start ga-2">
      <v-btn>Все менеджеры</v-btn>
      <v-btn @click.prevent="doShowModal">Добавить менеджера</v-btn>
    </v-card-actions>

    <CreateManagerModal
      :model-value="showModal"
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
