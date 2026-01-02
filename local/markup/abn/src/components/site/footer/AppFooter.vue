<script lang="ts">
import {defineComponent} from 'vue'
import ContactsWithIcon from "@/components/site/contacts-with-icon.vue";

export default defineComponent({
  name: "AppFooter",
  components: {ContactsWithIcon}
})
</script>

<template>
  <footer class="footer">
    <div class="footer-container container">
      <div class="footer-row">
        <div class="footer-col">

          <a href="/" class="footer-logo">
            <img src="@/assets/images/logo-white.svg" alt="Логотип" class="footer-logo__img">
          </a>

          <div class="footer-short">
            Компания "Побеждай" ведёт свою деятельность с 2005 года
          </div>


        </div>
        <div class="footer-col">
          <div class="footer-menu-group">
            <ul class="footer-menu">
              <li class="footer-menu-item">
                <a class="footer-menu-link">Объекты</a>
              </li>
              <li class="footer-menu-item">
                <a class="footer-menu-link">Застройщики</a>
              </li>
              <li class="footer-menu-item">
                <a class="footer-menu-link">Помощь</a>
              </li>
            </ul>
            <ul class="footer-menu">
              <li class="footer-menu-item">
                <a class="footer-menu-link">Регистрация</a>
              </li>
              <li class="footer-menu-item">
                <a class="footer-menu-link">Вход</a>
              </li>
              <li class="footer-menu-item">
                <a class="footer-menu-link">Кабинет</a>
              </li>
            </ul>
          </div>
        </div>
        <div class="footer-col">
          <ContactsWithIcon/>
        </div>
      </div>
      <div class="footer-row">

      </div>
    </div>
  </footer>
</template>

<style lang="scss">
@use '@/styles/system/variable' as *;

.footer {
  background: $footer-bg;

  &-row {
    padding-top: 40px;
    padding-bottom: 20px;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 70px;
  }

  &-logo {
    position: relative;
    max-width: 200px;
    width: 100%;
    padding-bottom: 20%;
    display: block;
    margin-bottom: 20px;

    &__img {
      position: absolute;
      object-fit: cover;
      width: 100%;
      height: 100%;
    }
  }

  &-short {
    font-family: var(--font-family);
    font-weight: 400;
    font-size: 14px;
    line-height: 155%;
    color: $footer-short;
  }

  &-col {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    justify-content: flex-start;

    &:nth-child(1) {
      max-width: 210px;
      width: 100%;
    }
  }

  &-menu {
    display: flex;
    flex-direction: column;
    gap: 10px;

    &-group {
      display: flex;
      flex-direction: row;
      gap: 55px;
    }

    &-item {
      font-family: var(--font-family);
      font-weight: 500;
      font-size: 14px;
      line-height: 120%;
      color: $white-color;
    }

    &-link {
      font-weight: inherit;
      font-size: inherit;
      line-height: inherit;
      color: inherit;

    }
  }
}

</style>
