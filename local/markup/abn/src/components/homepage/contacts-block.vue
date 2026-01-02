<script lang="ts">
import {defineComponent} from 'vue'
import ContactsWithIcon from "@/components/site/contacts-with-icon.vue";

export default defineComponent({
  name: "ContactsBlock",
  components: {ContactsWithIcon}
})
</script>

<template>
  <section class="contacts-block container">
    <div class="contacts-block-left">
      <h3 class="page-title contacts-block-title h1">Контакты</h3>
      <div class="contacts-block-info">
        <ContactsWithIcon>
          <template #phoneIcon>
            <img class="with-icon-item__icon" src="@/assets/images/icons/phone-tg-gray.svg" alt="Телефон">
          </template>
          <template #emailIcon>
            <img class="with-icon-item__icon" src="@/assets/images/icons/email-gray.svg" alt="E-mail">
          </template>
          <template #gpsIcon>
            <img class="with-icon-item__icon" src="@/assets/images/icons/gps2-gray.svg" alt="Адрес">
          </template>
        </ContactsWithIcon>
      </div>
      <div class="contacts-block-description">
        Компания "Побеждай" ведёт свою деятельность с 2005 года и зарекомендовала себя в качестве надёжного партнёра, действующего в интересах обеих сторон.
      </div>
    </div>
    <div class="contacts-block-right">
      <div>
        <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A4b4dfe125038ee2dde7c3359b924ec7bd0c3e38fc03d2cfe112e67acd1b7aa23&amp;width=100%25&amp;height=300&amp;lang=ru_RU&amp;scroll=true"></script>
      </div>
    </div>
  </section>
</template>

<style lang="scss">
@use '@/styles/system/variable' as *;

.contacts-block {
  display: flex;
  gap: 40px;

  &-title {
    margin-bottom: 30px;
  }

  &-left {
    max-width: 45%;
    width: 100%;
  }

  &-right {
    max-width: 45%;
    width: 100%;
  }

  &-info {
    .with-icon-item {
      color: #000;
    }
  }

  &-description {
    font-family: var(--font-family);
    font-weight: 400;
    font-size: 14px;
    line-height: 155%;
    color: $footer-short;
    margin-top: 33px;
  }
}
</style>
