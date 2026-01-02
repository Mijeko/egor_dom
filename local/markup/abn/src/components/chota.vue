<script lang="ts">
import {defineComponent} from 'vue'

export default defineComponent({
  name: "chota"
})
</script>

<template>
  <div class="chota-house container">

    <img src="@/assets/images/vertical-house.png" class="chota-house__home" alt="Дом">

    <svg width="555" height="350" viewBox="0 0 555 350" fill="none" xmlns="http://www.w3.org/2000/svg" class="chota-house__round1">
      <circle cx="277.5" cy="249.5" r="277.5" fill="#6893FF"/>
    </svg>

    <svg width="850" height="350" viewBox="0 0 850 350" fill="none" xmlns="http://www.w3.org/2000/svg" class="chota-house__round2">
      <circle cx="425" cy="250" r="425" fill="#5A85F2"/>
    </svg>

    <div class="chota-house-text">
      <h3 class="chota-house-text__title">от 20 000 руб</h3>
      <p>За рекомендацию. Простой способ заработать — приглашайте покупателей и получайте вознаграждение после сделки</p>
      <h3 class="chota-house-text__title">24/7 на связи</h3>
      <p>Доступ из личного кабинета. Все операции онлайн: объекты, заявки, сделки и выплаты — в одном месте</p>

      <SButton class="chota-house-join">Регистрация</SButton>
    </div>

  </div>
</template>

<style lang="scss">
@use '@/styles/system/variable' as *;

.chota {
  &-house {
    position: relative;
    background: $house-bg;
    border-radius: 30px;
    padding-bottom: 15% !important;
    width: 100%;
    margin-bottom: 90px !important;

    &__home {
      position: absolute;
      bottom: 0;
      left: 0;
      z-index: 3;
    }

    &__round1 {
      position: absolute;
      left: 50%;
      top: 50%;
      transform: translate(-50%, -50%);
      z-index: 2;
      height: 100%;
      object-fit: contain;
    }

    &__round2 {
      position: absolute;
      left: 50%;
      top: 50%;
      transform: translate(-50%, -50%);
      z-index: 1;
      height: 100%;
      object-fit: contain;
    }

    &-text {
      position: absolute;
      right: 10%;
      top: 50%;
      transform: translate(10%, -50%);
      z-index: 4;
      max-width: 445px;
      width: 100%;

      &__title {
        font-family: var(--second-family);
        font-weight: 500;
        font-size: 24px;
        line-height: 140%;
        text-transform: uppercase;
        color: $white-color;

        &:not(:first-child) {
          margin-top: 20px;
        }
      }

      p {
        font-family: var(--font-family);
        font-weight: 600;
        font-size: 14px;
        line-height: 150%;
        color: $white-color;
      }
    }

    &-join {
      margin-top: 40px;
    }
  }
}
</style>
