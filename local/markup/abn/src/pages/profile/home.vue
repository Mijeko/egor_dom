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

        <div class="personal-reward">
          <div class="personal-reward-title">
            Вознаграждение: 4%
          </div>
          <div class="personal-reward-body">
            <div class="personal-reward-chars">

              <div class="personal-reward-chars-row">
                <div class="personal-reward-chars-key">Кол-во сделок:</div>
                <div class="personal-reward-chars-value">0</div>
              </div>

              <div class="personal-reward-chars-row">
                <div class="personal-reward-chars-key">Оборот:</div>
                <div class="personal-reward-chars-value">0</div>
              </div>

              <div class="personal-reward-chars-row">
                <div class="personal-reward-chars-key">К получению:</div>
                <div class="personal-reward-chars-value">0</div>
              </div>

            </div>
          </div>

          <Button>Подробнее</Button>
        </div>

      </div>
    </div>


    <div class="profile-main-card">
      <div class="profile-main-card-title">Реферальная система</div>
      <div class="profile-main-card-wrap">
        <div class="referral-data">
          <div class="referral-data-link">
            <div class="referral-data-link__title">
              Ссылка-приглашение
            </div>

            <div class="referral-data-link__source">
              http://abn.dev-kvsn.ru/ref/68ca83b5e9c52
            </div>
          </div>

          <div class="referral-data-char">
            <div class="referral-data-char-row">
              <div class="referral-data-char-key">Приглашено</div>
              <div class="referral-data-char-value">0</div>
            </div>
            <div class="referral-data-char-row">
              <div class="referral-data-char-key">Вознаграждение</div>
              <div class="referral-data-char-value">0 руб</div>
            </div>
          </div>

          <Button>Скопировать</Button>
        </div>
      </div>
    </div>


    <div class="profile-main-card">
      <div class="profile-main-card-title">Просмотренные</div>
      <div class="profile-main-card-wrap">
        <div class="visited-list">
          <a href="" class="visited-item">Дом в мичурино</a>
          <a href="" class="visited-item">Дом в мичурино</a>
          <a href="" class="visited-item">Дом в мичурино</a>
        </div>
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
    align-items: stretch;
    justify-content: flex-start;
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
      height: 100%;
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

.personal-reward {

  &-title {
    margin-bottom: 26px;
    border-radius: 10px;
    background: $personal-reward-bg;
    font-family: var(--font-family);
    font-weight: 500;
    font-size: 14px;
    line-height: 100%;
    color: #fff;
    padding: 5px 40px;
  }

  &-body {
    margin-bottom: 30px;
  }

  &-chars {
    display: flex;
    flex-direction: column;
    width: 100%;

    &-row {
      display: flex;
      align-items: flex-start;
      justify-content: space-between;
    }

    &-key {
      font-family: var(--font-family);
      font-weight: 500;
      font-size: 14px;
      line-height: 250%;
      color: $gray-color;

    }

    &-value {
      font-family: var(--font-family);
      font-weight: 400;
      font-size: 14px;
      line-height: 250%;
      text-align: right;
      color: $bo-color-name;
    }
  }
}

.referral-data {
  &-link {
    margin-bottom: 20px;

    &__title {
      font-family: var(--font-family);
      font-weight: 500;
      font-size: 14px;
      line-height: 100%;
      color: $ref-title-color;
      margin-bottom: 10px;
    }

    &__source {
      font-family: var(--font-family);
      font-weight: 400;
      font-size: 14px;
      line-height: 140%;
      color: $personal-reward-bg;
    }
  }

  &-char {
    width: 100%;
    display: flex;
    flex-direction: column;
    margin-bottom: 30px;

    &-row {
      display: flex;
      align-items: flex-start;
      justify-content: space-between;
    }

    &-key {
      font-family: var(--font-family);
      font-weight: 400;
      font-size: 14px;
      line-height: 250%;
      color: $gray-color;
    }

    &-value {
      font-family: var(--font-family);
      font-weight: 400;
      font-size: 14px;
      line-height: 250%;
      text-align: right;
      color: $bo-color-name;
    }
  }
}

.visited {
  &-list {
    display: flex;
    flex-direction: column;
    gap: 10px;
  }

  &-item {
    font-family: var(--font-family);
    font-weight: 400;
    font-size: 14px;
    line-height: 250%;
    color: $bo-color-name;
  }
}
</style>
