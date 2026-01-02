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
      <div class="first-screen-layer">

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

          <div class="first-screen-body-left">

            <div class="first-screen-content">
              <p>онлайн</p>
              <p>платформа</p>
              <p>//недвижимости</p>

              <div class="first-screen-description">
                Выгодные объекты от застройщиков, удобный поиск, профессиональные кабинеты для застройщиков и риэлторов
              </div>

              <SButton>Регистрация</SButton>
            </div>

          </div>
          <div class="first-screen-body-right">
            <div class="first-screen-image-wrapper">
              <div class="first-screen-image">
                <img src="@/assets/images/first-screen-bg.png" alt="Площадка">
              </div>
              <div class="first-screen-advantages">
                <div class="first-screen-advantages-item">
                  <div class="first-screen-advantages-item__icon">
                    <img src="@/assets/images/icons/diamond.svg" alt="Инвестиции в выгодные объекты">
                  </div>
                  <div class="first-screen-advantages-item__text">Инвестиции в выгодные объекты</div>
                </div>
                <div class="first-screen-advantages-item">
                  <div class="first-screen-advantages-item__icon">
                    <img src="@/assets/images/icons/coin-hand.svg" alt="Заработок через приглашение людей">
                  </div>
                  <div class="first-screen-advantages-item__text">Заработок через приглашение людей</div>
                </div>
                <div class="first-screen-advantages-item">
                  <div class="first-screen-advantages-item__icon">
                    <img src="@/assets/images/icons/home-04.svg" alt="Покупка квартиры без риэлтора">
                  </div>
                  <div class="first-screen-advantages-item__text">Покупка квартиры без риэлтора</div>
                </div>
              </div>
            </div>
          </div>

        </div>

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
    position: relative;
  }

  &-layer {
    width: 100%;
    height: 100%;
    background-image: url("@/assets/images/first-screen-wrap.svg");
    background-size: 100% 100%;
  }

  &-header {
    display: flex;
    align-items: center;
  }

  &-body {
    display: flex;
    justify-content: space-between;
    align-items: stretch;

    &-left {
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 35px;
    }

    &-right {
      padding: 10px;
    }
  }

  &-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;

    p {
      font-family: var(--second-family);
      font-weight: 300;
      font-size: 40px;
      line-height: 125%;
      text-transform: uppercase;
      color: $bo-color-name;
    }
  }

  &-description {
    font-family: var(--font-family);
    font-weight: 400;
    font-size: 14px;
    line-height: 160%;
    text-align: center;
    color: $bo-color-name;
    margin-top: 20px;
    margin-bottom: 40px;
    max-width: 448px;
    width: 100%;
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

  &-image {
    display: block;
    width: 100%;
    object-fit: contain;

    &-wrapper {
      max-width: 450px;
      width: 100%;
      position: relative;
    }
  }

  &-advantages {
    position: absolute;
    right: 20px;
    bottom: 20px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 35px;
    padding: 30px;
    border: 1px solid rgba(255, 255, 255, 0.4);
    border-radius: 40px;
    backdrop-filter: blur(20px);
    background: rgba(255, 255, 255, 0.3);

    &-item {
      display: flex;
      flex-direction: column;
      gap: 10px;
      max-width: 153px;
      font-family: var(--second-family);
      font-weight: 400;
      font-size: 12px;
      line-height: 130%;
      text-align: center;
      color: $bo-color-name;
    }
  }
}

</style>
