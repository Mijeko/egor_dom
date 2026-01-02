<script lang="ts">
import {defineComponent} from 'vue'

export default defineComponent({
  name: "SecurityBlock"
})
</script>

<template>
  <section class="security-block container">
    <div class="security-block-left">
      <h3 class="security-block-title page-title h1">Безопасность</h3>
      <div class="security-block-text">
        Все объекты проходят юридическую и документальную проверку. Все сделки сопровождаются нашими экспертами, а выплаты партнёрам проходят по официальным договорам
      </div>

      <div class="security-block-items">
        <div class="security-block-item">
          Юридическая проверка каждого объекта — ваша гарантия безопасности
        </div>
        <div class="security-block-item">
          Реферальная программа позволяет зарабатывать, просто рекомендуя объекты
        </div>
        <div class="security-block-item">
          Система умного поиска подбирает варианты по вашим критериям
        </div>
        <div class="security-block-item">
          Поддержка 24/7 — вы не останетесь без помощи на любом этапе
        </div>
      </div>
    </div>
    <div class="security-block-right">
      <img src="@/assets/images/security-bg.png" alt="Безопасность сделок">
    </div>
  </section>
</template>

<style lang="scss">
@use '@/styles/system/variable' as *;

.security-block {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  gap: 47px;
  margin-bottom: 80px !important;

  &-left {
    flex: 0 0 calc(1150px - 550px - 47px);
  }

  &-right {
    flex: 0 0 550px;
  }

  &-title {
    margin-bottom: 15px;
  }

  &-text {
    font-family: var(--font-family);
    font-weight: 400;
    font-size: 14px;
    line-height: 150%;
    color: $bo-color-name;
    margin-bottom: 45px;
  }

  &-items {
    display: flex;
    flex-wrap: wrap;
    gap: 35px 30px;
  }

  &-item {
    font-family: var(--font-family);
    font-weight: 400;
    font-size: 14px;
    line-height: 140%;
    color: $bo-color-name;
    max-width: calc(50% - 30px);
    width: 100%;
    padding-left: 35px;
    position: relative;

    &:before {
      content: "";
      width: 20px;
      height: 20px;
      display: block;
      position: absolute;
      top: 0;
      left: 0;
      background-image: url("@/assets/images/icons/check-security.svg");
    }
  }
}
</style>
