<script lang="ts">
import {defineComponent} from 'vue'
import Profile from '@/layouts/profile.vue';

export default defineComponent({
  name: "Home",
  layout: [Profile],
})
</script>

<template>
  <div class="profile-main">
    <h1 class="page-title h1 profile-main-title">Личный кабинет</h1>
  </div>

  <div class="profile-main-cards">


    <div class="profile-main-card">
      <div class="profile-main-card-title">Информация о сделках</div>
      <div class="profile-main-card-wrap">
      </div>
    </div>

    <div class="profile-main-card">
      <div class="profile-main-card-title">Реферальная система</div>
      <div class="profile-main-card-wrap">
      </div>
    </div>

    <div class="profile-main-card">
      <div class="profile-main-card-title">Просмотренные</div>
      <div class="profile-main-card-wrap">
      </div>
    </div>


  </div>
</template>

<style lang="scss">
@use '@/styles/system/variable' as *;

.profile-main {
  &-title {
    text-align: left;
    margin-bottom: 30px !important;
  }

  &-cards {
    display: flex;
    gap: 15px;
  }

  &-card {
    max-width: calc(33% - 10px);
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;

    &-wrap {
      width: 100%;
      border: 1px solid $stat-border-color;
      border-radius: 25px;
      padding: 25px;
    }

    &-title {
      margin-bottom: 20px;
      font-family: var(--second-family);
      font-weight: 400;
      font-size: 14px;
      line-height: 140%;
      text-align: center;
      color: $gray-color;
    }
  }
}
</style>
