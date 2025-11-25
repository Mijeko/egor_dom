<script lang="ts">
import {defineComponent} from 'vue'
import ProfileAsideMenu from "@/components/profile/element/profile-aside-menu.vue";

export default defineComponent({
  name: "default",
  components: {ProfileAsideMenu: ProfileAsideMenu}
})
</script>

<template>

  <div class="stronger">
    <div class="page-content">
      <div class="container">


        <div class="profile-section">
          <div class="profile-aside">
            <ProfileAsideMenu
              :items="[]"
            />
          </div>
          <div class="profile-body">

            <slot/>

          </div>
        </div>


      </div>
    </div>

  </div>
</template>

<style scoped>

</style>
