<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import DeveloperList from "@/components/developer/developer-list.vue";
import type DeveloperListItemDto from "@/dto/entity/DeveloperListItemDto.ts";
import DeveloperSearch from "@/components/developer/developer-search.vue";
import AdvantageItem from "@/components/developer/advantage-item.vue";

export default defineComponent({
  name: "list",
  components: {AdvantageItem, DeveloperSearch, DeveloperList},
  props: {
    developers: {
      type: Array as PropType<DeveloperListItemDto[]>
    }
  }
})
</script>

<template>
  <div class="developer-page container">
    <h1 class="developer-page__title">Застройщики</h1>
    <DeveloperSearch/>
    <DeveloperList
      :developers
    />
  </div>

  <section class="developer-page-about container">
    <div class="developer-page-about-image-wrapper">
      <img class="developer-page-about-image" src="@/assets/images/about1.png" alt="О компании Побеждай">
    </div>
    <div class="developer-page-about-body">

      <div class="developer-page-about-header">
        <span>30 регионов</span>
        России
      </div>

      <div class="developer-page-about-text">
        <p>Платформа «Побеждай» объединяет ведущих девелоперов России — компании, чьи проекты формируют современную
          архитектуру городов и задают новые стандарты качества жизни
        </p>
        <p>Партнёрская сеть «Побеждай» охватывает более 30 регионов России и продолжает активно расширяться. Мы
          обеспечиваем застройщикам новые каналы продаж, прозрачную аналитику и прямой доступ к покупателям по всей
          стране
        </p>
        <p>Благодаря этому покупатели получают доступ только к актуальным, достоверным и безопасным предложениям, а
          застройщики — к аудитории, готовой к осознанному выбору.Мы ценим партнёров, которые строят не только дома, но
          и доверие.
        </p>
      </div>
    </div>
  </section>

  <section class="developer-page-cooperation-container">


    <div class="developer-page-cooperation-logo-container">
      <div class="developer-page-cooperation-logo-wrapper">
        <img src="@/assets/images/logo.svg" alt="Логотип" class="developer-page-cooperation-logo">
      </div>
    </div>


    <div class="developer-page-cooperation container">
      <div class="developer-page-cooperation-text">
        <h3 class="developer-page-cooperation-title">Сотрудничество</h3>
        <p>Сотрудничество с «Побеждай» — это современная модель партнёрства, основанная на технологиях, аналитике и
          уважении к времени партнёра
        </p>
        <p>Мы берём на себя ключевые задачи по продвижению и продаже объектов, чтобы застройщик мог сосредоточиться на
          главном — создании качественного продукта
        </p>
        <p>
          <b>Станьте частью профессионального сообщества девелоперов. Размещайте свои проекты на платформе, получайте
            квалифицированные заявки и управляйте продажами через единое решение</b>
        </p>

        <Button type="link" href="/" class="developer-page-cooperation-link">Регистрация</Button>
      </div>

      <div class="developer-page-cooperation-advantage-list">

        <AdvantageItem title="Комплексное продвижение">
          Платформа аккумулирует целевой трафик, работает с партнёрской сетью и обеспечивает высокую конверсию
        </AdvantageItem>

        <AdvantageItem title="Прозрачная аналитика">
          Платформа аккумулирует целевой трафик, работает с партнёрской сетью и обеспечивает высокую конверсию
        </AdvantageItem>

        <AdvantageItem title="Интеграция и автоматизация">
          Платформа аккумулирует целевой трафик, работает с партнёрской сетью и обеспечивает высокую конверсию
        </AdvantageItem>

        <AdvantageItem title="Юридическое сопровождение">
          Платформа аккумулирует целевой трафик, работает с партнёрской сетью и обеспечивает высокую конверсию
        </AdvantageItem>

        <AdvantageItem title="Персональная поддержка">
          Платформа аккумулирует целевой трафик, работает с партнёрской сетью и обеспечивает высокую конверсию
        </AdvantageItem>

      </div>
    </div>
  </section>

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

  &-about {
    display: flex;
    gap: 50px;
    margin-bottom: 90px !important;

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
      padding-top: 25px;
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

  &-cooperation {
    display: flex;
    gap: 10%;

    &-container {
      position: relative;
      background-image: url("@/assets/images/layer/layer1.png");
      background-size: cover;
      min-height: 400px;
      display: block;
      padding: 143px 0 80px 0;
    }

    &-logo {
      display: block;
      width: 100%;
      height: 100%;
      object-fit: cover;

      &-container {
        position: absolute;
        top: -50px;
        left: 49.5%;
        transform: translateX(-49.5%);
        //width: 210px;
        //height: 110px;
        width: 8%;
        height: 10%;
      }

      &-wrapper {
        position: relative;
      }
    }

    &-text {
      font-family: var(--font-family);
      font-weight: 400;
      font-size: 14px;
      line-height: 150%;
      color: $bo-color-name;
      max-width: 440px;
      width: 100%;

      p {
        &:not(:last-child) {
          margin-bottom: 15px;
        }
      }

      b {
        font-weight: 500;
      }
    }

    &-advantage {
      &-list {
        max-width: 550px;
        width: 100%;
        display: flex;
        flex-direction: column;
        gap: 5px;
      }
    }

    &-title {
      font-family: var(--second-family);
      font-weight: 300;
      font-size: 30px;
      line-height: 140%;
      text-transform: uppercase;
      color: $bo-color-name;
      margin-bottom: 15px;
    }

    &-link {
      margin-top: 30px;
    }
  }
}
</style>
