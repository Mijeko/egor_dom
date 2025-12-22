<script lang="ts">
import {defineComponent} from 'vue'
import ProfileAsideMenu from "@/components/profile/element/profile-aside-menu.vue";
import MenuBxBx from "@/components/menu-bx.vue";
import ShortSideInfo from "@/components/profile/short-side-info.vue";
import type BxUserDto from "@/dto/bitrix/BxUserDto.ts";

export default defineComponent({
  name: "default",
  components: {ShortSideInfo, MenuBx: MenuBxBx, ProfileAsideMenu: ProfileAsideMenu},
  props: {
    user: {
      type: Object as PropType<BxUserDto>,
      default: () => {
        return {};
      }
    }
  },
})
</script>

<template>

  <div class="stronger">


    <AppHeader/>

    <div class="page-content">
      <div class="container">

        <div class="profile-section">
          <div class="profile-aside">
            <div class="profile-aside-wrapper">

              <ShortSideInfo
                :user
              />

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
    gap: 70px;
    justify-content: space-between;
    align-items: flex-start;
  }

  &-aside {
    max-width: 300px;
    width: 100%;

    &-wrapper {
      padding: 30px;
      box-shadow: 3px 4px 10px 0 rgba(0, 0, 0, 0.25), -25px -25px 100px 0 rgba(233, 233, 233, 0.6), -20px -20px 40px 0 #fff, -3px -3px 2px 0 #fff;
      background: linear-gradient(316deg, #fff 0%, #f9f9f9 100%);
      border-radius: 25px;
    }
  }

  &-body {
    width: calc(100% - 300px - 75px);
  }
}
</style>
