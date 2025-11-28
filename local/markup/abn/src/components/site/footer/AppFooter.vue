<script lang="ts">
import {defineComponent} from 'vue'

export default defineComponent({
  name: "AppFooter"
})
</script>

<template>
  <footer class="footer">
    <div class="footer-container container">
      <div class="footer-row">
        <div class="footer-col">

          <a href="/" class="footer-logo">
            <img src="@/assets/images/logo.svg" alt="Логотип" class="footer-logo__img">
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
          <ul class="with-icon">
            <li class="with-icon-item">
              <img class="with-icon-item__icon" src="@/assets/images/icons/phone-tg.svg" alt="Телефон">
              <a href="tel:+7 (000) 000-00-00" class="with-icon-item__text">+7 (000) 000-00-00</a>
            </li>
            <li class="with-icon-item">
              <img class="with-icon-item__icon" src="@/assets/images/icons/email.svg" alt="Email">
              <a href="mailto:email.ru" class="with-icon-item__text">email.ru</a>
            </li>
            <li class="with-icon-item">
              <img class="with-icon-item__icon" src="@/assets/images/icons/gps2.svg" alt="Адрес">
              <div class="with-icon-item__text">Офис ООО фирма "Побеждай", Россия, Новосибирск, Аэродромная 44</div>
            </li>
          </ul>
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

.with-icon {
  display: flex;
  flex-direction: column;
  gap: 10px;

  &-item {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    gap: 10px;
    font-family: var(--font-family);
    font-weight: 500;
    font-size: 14px;
    line-height: 130%;
    color: $white-color;

    &__icon {
    }

    &__text {
      font-weight: inherit;
      font-size: inherit;
      line-height: inherit;
      color: inherit;
    }
  }
}
</style>
