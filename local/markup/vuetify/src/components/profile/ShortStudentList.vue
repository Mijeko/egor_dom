<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import CreateManagerModal from "@/components/modal/CreateManagerModal.vue";
import AccessService from "@/service/AccessService.ts";
import type BxUserDto from "@/dto/bitrix/BxUserDto.ts";
import CreateStudentModal from "@/components/modal/CreateStudentModal.vue";

export default defineComponent({
  name: "ShortStudentList",
  components: {CreateStudentModal, CreateManagerModal},
  computed: {
    AccessService() {
      return AccessService
    }
  },
  props: {
    students: {
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
    v-if="AccessService.hasRole(['ADMIN','MANAGER']) "
    class="pa-3 mb-3 mt-3"
    title="Студенты"
  >
    <v-divider v-if="students.length > 0"/>

    <v-card-text v-if="students.length > 0">
      <div class="mb-3 manager-item" v-for="student in students">
        <v-avatar
          size="36px"
        >
          <v-img
            v-if="student.avatar?.src"
            :alt="student.fullName"
            :src="student.avatar?.src"
          ></v-img>

        </v-avatar>

        <a :href="`/profile/students/${student.id}/`">{{ student.fullName }}</a>
      </div>
    </v-card-text>

    <v-divider/>

    <v-card-actions class="flex-row justify-space-between ga-2">
      <v-btn color="primary" href="/profile/students/">Все студенты</v-btn>
      <v-btn
        variant="flat"
        color="green-darken-2"
        class="text-white"
        @click.prevent="doShowModal"
      >Добавить студента
      </v-btn>
    </v-card-actions>

    <CreateStudentModal
      :model-value="showModal"
    />

  </v-card>
</template>


<style scoped>

</style>
