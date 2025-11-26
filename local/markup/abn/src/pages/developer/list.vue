<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import DeveloperList from "@/components/developer/developer-list.vue";
import type DeveloperListItemDto from "@/dto/entity/DeveloperListItemDto.ts";
import DeveloperSearch from "@/components/developer/developer-search.vue";

export default defineComponent({
  name: "list",
  components: {DeveloperSearch, DeveloperList},
  props: {
    developers: {
      type: Array as PropType<DeveloperListItemDto[]>
    }
  }
})
</script>

<template>
  <div class="developer-page">
    <h1 class="developer-page__title">Застройщики</h1>
    <DeveloperSearch/>
    <DeveloperList
      :developers
    />

    <section class="about">
      <div class="about-image-wrapper">
        <img class="about-image" src="@/assets/images/about1.png" alt="О компании Побеждай">
      </div>
      <div class="about-body">

        <div class="about-header">
          <span>30 регионов</span>
          России
        </div>

        <div class="about-text">
          <p>Платформа «Побеждай» объединяет ведущих девелоперов России — компании, чьи проекты формируют современную архитектуру городов и задают новые стандарты качества жизни</p>
          <p>Партнёрская сеть «Побеждай» охватывает более 30 регионов России и продолжает активно расширяться. Мы обеспечиваем застройщикам новые каналы продаж, прозрачную аналитику и прямой доступ к покупателям по всей стране</p>
          <p>Благодаря этому покупатели получают доступ только к актуальным, достоверным и безопасным предложениям, а застройщики — к аудитории, готовой к осознанному выбору.Мы ценим партнёров, которые строят не только дома, но и доверие.</p>
        </div>
      </div>
    </section>

  </div>
</template>

<style lang="scss">
@use '@/styles/system/variable' as *;

.developer-page {
  &__title {
    font-family: var(--second-family);
    font-weight: 300;
    font-size: 30px;
    line-height: 140%;
    text-transform: uppercase;
    text-align: center;
    color: $bo-color-name;
  }

  .about {
    display: flex;
    gap: 50px;
    margin-bottom: 90px;

    &-image {
      position: absolute;
      width: 100%;
      height: 100%;
      object-fit: cover;

      &-wrapper {
        border-radius: 25px;
        overflow: hidden;
        position: relative;
        padding-bottom: 30%;
        max-width: 500px;
        width: 100%;
      }
    }

    &-body {
      padding-top: 10px;
    }

    &-header {
      font-family: var(--second-family);
      font-weight: 300;
      font-size: 28px;
      line-height: 140%;
      text-transform: uppercase;
      color: $bo-color-name;
      margin-bottom: 15px;

      span {
        margin-right: 10px;
        padding: 6px 20px;
        background: $about-mark;
        border-radius: 15px;
      }
    }

    &-text {
      font-family: var(--font-family);
      font-style: italic;
      font-weight: 300;
      font-size: 14px;
      line-height: 150%;
      color: $bo-color-name;
      border: 1px solid $about-text-border;
      border-radius: 10px;
      padding: 30px;

      p {
        &:not(:last-child) {
          margin-bottom: 20px;
        }
      }
    }
  }
}
</style>
