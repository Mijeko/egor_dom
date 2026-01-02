<script lang="ts">
import {defineComponent} from 'vue'
import type BxUserDto from "@/dto/bitrix/BxUserDto.ts";

export default defineComponent({
  name: "FirstScreen",
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
  <section class="first-screen container">

    <div class="first-screen-wrapper">
      <div class="first-screen-header">

        <a href="/" class="first-screen-logo-link">
          <img src="@/assets/images/logo.svg" class="first-screen-logo" alt="Побеждай логотип">
        </a>

        <div class="first-screen-city">
          <CurrentCity>
            <template #gpsIcon>
              <img src="@/assets/images/icons/gps-white.svg" alt="Гео">
            </template>
          </CurrentCity>
        </div>

        <MenuBx
          typeMenu="landing_top"
        >
          <template #items="{items}">
            <ul class="first-screen-menu">
              <li class="first-screen-menu-item" v-for="item in items">
                <a class="first-screen-menu-link" :href="item.url">{{ item.title }}</a>
              </li>
            </ul>
          </template>
        </MenuBx>

        <div class="first-screen-search">
          <FastSearch/>
        </div>

        <div class="first-screen-cabinet">
          <Cabinet
            :user
          />
        </div>

      </div>


      <div class="first-screen-body">
      </div>

    </div>

  </section>
</template>

<style lang="scss">
@use '@/styles/system/variable' as *;

.first-screen {
  border-radius: 40px;
  box-shadow: 0 0 30px 0 rgba(0, 0, 0, 0.1);
  background: #fff;
  padding: 20px !important;
  position: relative;
  padding-bottom: 30% !important;
  margin-bottom: 90px !important;
  margin-top: 30px !important;

  &-logo {
    display: block;
    width: 168px;
    object-fit: contain;

    &-link {
      display: block;
    }
  }

  &-city {
    margin-left: 53px;

    .current-city__label {
      color: white;
    }
  }

  &-wrapper {
    position: absolute;
    //width: 100%;
    //height: 100%;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background-image: url("@/assets/images/first-screen-wrap.svg");
    background-size: 100% 100%;
  }

  &-header {
    display: flex;
    align-items: center;
  }

  &-menu {
    display: flex;
    align-items: center;
    gap: 35px;
    margin-left: 87px;

    &-item {
      font-family: var(--font-family);
      font-weight: 500;
      font-size: 14px;
      line-height: 120%;
      color: $menu-blacked;
      text-decoration: none;
    }

    &-link {
      color: inherit;
      text-decoration: inherit;
    }
  }

  &-search {
    margin-left: 40px;
  }

  &-cabinet {
    margin-left: 40px;
  }

}

</style>
