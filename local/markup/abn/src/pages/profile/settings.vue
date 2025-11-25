<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import ProfileEditForm from "@/components/profile/element/profile-edit-form.vue";
import type ProfileEditUserDataDto from "@/dto/ProfileEditUserDataDto.ts";

export default defineComponent({
  name: "settings",
  components: {ProfileEditForm},
  props: {
    userData: {
      type: Object as PropType<ProfileEditUserDataDto>,
      default: {},
    }
  },
})
</script>

<template>
  <ProfileEditForm
    :user-data
  />
</template>

<style scoped>

</style>
