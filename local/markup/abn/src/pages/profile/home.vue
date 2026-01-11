<script lang="ts">
import {defineComponent} from 'vue'
import Profile from '@/layouts/profile.vue';
import PersonalMemberShort from "@/components/personal-member-short.vue";
import type {ReferralInformationDto} from "@/dto/present/ReferralInformationDto.ts";
import type {ViewedInformationDto} from "@/dto/present/ViewedInformationDto.ts";
import {CopyService} from "@/service/CopyService.ts";
import CreateUserModal from "@/components/site/modal/create-user-modal.vue";
import type {ClaimStatisticDto} from "@/dto/present/ClaimStatisticDto.ts";

export default defineComponent({
  name: "Home",
  computed: {
    CopyService() {
      return CopyService
    }
  },
  components: {CreateUserModal, PersonalMemberShort},
  layout: [Profile],
  props: {
    referralInfo: {
      type: Object as PropType<ReferralInformationDto>,
      default: () => {
        return {};
      }
    },
    viewedInfo: {
      type: Object as PropType<ViewedInformationDto>,
      default: () => {
        return {};
      }
    },
    claimStatistic: {
      type: Object as PropType<ClaimStatisticDto>,
      default: () => {
        return {};
      }
    },
  }
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
            Вознаграждение: {{ claimStatistic.amountReward }}
          </div>

          <div class="personal-reward-chars">

            <div class="personal-reward-chars-row">
              <div class="personal-reward-chars-key">Кол-во сделок:</div>
              <div class="personal-reward-chars-value">{{ claimStatistic.claimTotal }}</div>
            </div>

            <div class="personal-reward-chars-row">
              <div class="personal-reward-chars-key">Оборот:</div>
              <div class="personal-reward-chars-value">{{ claimStatistic.moneyRotate }}</div>
            </div>

            <div class="personal-reward-chars-row">
              <div class="personal-reward-chars-key">К получению:</div>
              <div class="personal-reward-chars-value">{{ claimStatistic.acceptTake }}</div>
            </div>

          </div>

          <SButton class="personal-reward-link">Подробнее</SButton>

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
              {{ referralInfo.link }}
            </div>
          </div>

          <div class="referral-data-char">
            <div class="referral-data-char-row">
              <div class="referral-data-char-key">Приглашено</div>
              <div class="referral-data-char-value">{{ referralInfo.countJoined }}</div>
            </div>
            <div class="referral-data-char-row">
              <div class="referral-data-char-key">Вознаграждение</div>
              <div class="referral-data-char-value">{{ referralInfo.reward }}</div>
            </div>
          </div>

          <SButton class="referral-data-more" @click="()=>CopyService.execute(referralInfo.link)">Скопировать</SButton>
        </div>
      </div>
    </div>


    <div class="profile-main-card">
      <div class="profile-main-card-title">Просмотренные</div>
      <div class="profile-main-card-wrap">

        <div class="visited-list" v-for="(viewItem, index) in viewedInfo.items">
          <a :href="viewItem.detailLink" class="visited-item" :key="index">{{ viewItem.name }}</a>
        </div>

      </div>


    </div>
  </div>


  <PersonalMemberShort>
    <template #title>Пользователи</template>
    <template #actions>
      <a href="/profile/managers/" class="all-list-button">Все менеджеры</a>
      <div class="add-member-button">Добавить +</div>
    </template>
  </PersonalMemberShort>


  <CreateUserModal

  />

  <!--  <PersonalMemberShort>-->
  <!--    <template #title>Агенты</template>-->
  <!--    <template #actions>-->
  <!--      <a href="/profile/agents/" class="all-list-button">Все агенты</a>-->
  <!--      <div class="add-member-button">Добавить +</div>-->
  <!--    </template>-->
  <!--  </PersonalMemberShort>-->

  <!--  <PersonalMemberShort>-->
  <!--    <template #title>Студенты</template>-->
  <!--    <template #actions>-->
  <!--      <a href="/profile/students/" class="all-list-button">Все студенты</a>-->
  <!--      <div class="add-member-button">Добавить +</div>-->
  <!--    </template>-->
  <!--  </PersonalMemberShort>-->

</template>

<style lang="scss">
@use '@/styles/system/variable' as *;

.profile-main {
  &-title {
    text-align: left !important;
    margin-bottom: 30px !important;
  }

  &-cards {
    display: flex;
    align-items: stretch;
    justify-content: flex-start;
    gap: 15px;
    margin-bottom: 20px;
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
      padding: 20px;
      display: flex;
      flex-direction: column;
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
  height: 100%;
  display: flex;
  flex-direction: column;

  &-title {
    margin-bottom: 26px;
    border-radius: 10px;
    background: $personal-reward-bg;
    font-family: var(--font-family);
    font-weight: 500;
    font-size: 14px;
    line-height: 100%;
    color: #fff;
    padding: 5px 25px;
  }

  &-chars {
    display: flex;
    flex-direction: column;
    width: 100%;
    margin-bottom: 30px;

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

  &-link {
    margin-top: auto;
  }
}

.referral-data {
  display: flex;
  flex-direction: column;
  height: 100%;

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

  &-more {
    margin-top: auto;
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

  &-more {
    margin-top: auto;
  }
}


.all-list-button {
  cursor: pointer;
  font-family: var(--font-family);
  font-weight: 400;
  font-size: 14px;
  line-height: 100%;
  text-align: right;
  color: $bo-color-name;
  border: 1px solid #e3e3e3;
  border-radius: 50px;
  background: $white-color;
  padding: 8px 20px;
  transition: all 0.4s ease;
  text-decoration: none !important;

  &:hover {
    color: $white-color;
    background: $bo-color-name;
    transition: all 0.4s ease;
  }
}

.add-member-button {
  cursor: pointer;
  padding: 8px 20px;
  font-family: var(--font-family);
  font-weight: 400;
  font-size: 14px;
  line-height: 100%;
  text-align: right;
  color: $white-color;
  border-radius: 50px;
  background: $bo-color-name;
  border: 1px $bo-color-name solid;
  transition: all 0.4s ease;

  &:hover {
    color: $bo-color-name;
    background: $white-color;
    transition: all 0.4s ease;
  }
}
</style>
