<script lang="ts">
import {defineComponent} from 'vue'
import ProfileAsideMenu from "@/components/profile/element/profile-aside-menu.vue";
import MenuBxBx from "@/components/menu-bx.vue";

export default defineComponent({
  name: "default",
  components: {MenuBx: MenuBxBx, ProfileAsideMenu: ProfileAsideMenu}
})
</script>

<template>

  <div class="stronger">


    <AppHeader/>

    <div class="page-content">
      <div class="container">

        <div class="profile-section">
          <div class="profile-aside">


            <MenuBx
              typeMenu="profile_aside"
            >
              <template #items="{items}">
                <ProfileAsideMenu
                  v-if="items"
                  :items="items"
                />
              </template>

            </MenuBx>

          </div>
          <div class="profile-body">
            <slot/>
          </div>
        </div>
      </div>
    </div>

    <AppFooter/>

  </div>
</template>

<style lang="scss">
.profile {
  &-section {
    display: flex;
    gap: 20px;
    justify-content: space-between;
    align-items: flex-start;
  }

  &-aside {
    max-width: 300px;
    width: 100%;
  }

  &-body {
    width: 100%;
  }
}
</style>
