<script lang="ts">
import {defineComponent} from 'vue'
import BaseModernModal from "@/components/site/modal/base-modern-modal.vue";
import CreateUserForm from "@/components/site/form/create-user-form.vue";

export default defineComponent({
  name: "CreateUserModal",
  components: {CreateUserForm, BaseModernModal}
})
</script>

<template>
  <BaseModernModal>
    <template #activator="{activatorProps}">
      <div v-bind="activatorProps">
        open modal
      </div>
    </template>

    <template #backgroundImage>
      <img src="@/assets/images/modal/bg/realtor.png" class="modal-image" alt="Новый пользователь">
    </template>

    <template #content>
      <CreateUserForm/>
    </template>

  </BaseModernModal>
</template>

<style lang="scss">

</style>
