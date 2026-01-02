<script lang="ts">
import {defineComponent} from 'vue'

export default defineComponent({
  name: "ContactsWithIcon",
  props: {
    suffix: {
      type: String,
      default: null,
    },
    phone: {
      type: String,
      default: '+7 (000) 000-00-00',
    },
    email: {
      type: String,
      default: 'popugau@gmail.com',
    },
  },
  computed: {
    phoneComputed: function () {
      return this.phone;
    }
  }
})
</script>

<template>
  <ul class="with-icon">

    <li class="with-icon-item" v-if="phone">
      <slot v-if="$.slots.phoneIcon" name="phoneIcon"></slot>
      <img v-else class="with-icon-item__icon" src="@/assets/images/icons/phone-tg.svg" alt="Телефон">
      <a :href="`tel:${phoneComputed}`" class="with-icon-item__text">{{ phone }}</a>
    </li>

    <li class="with-icon-item" v-if="email">
      <slot v-if="$.slots.emailIcon" name="emailIcon"></slot>
      <img v-else class="with-icon-item__icon" src="@/assets/images/icons/email.svg" alt="Email">
      <a :href="`mailto:${email}`" class="with-icon-item__text">{{ email }}</a>
    </li>

    <li class="with-icon-item">
      <slot v-if="$.slots.gpsIcon" name="gpsIcon"></slot>
      <img v-else class="with-icon-item__icon" src="@/assets/images/icons/gps2.svg" alt="Адрес">
      <div class="with-icon-item__text">Офис ООО фирма "Побеждай", Россия, Новосибирск, Аэродромная 44</div>
    </li>

  </ul>
</template>

<style lang="scss">
@use '@/styles/system/variable' as *;

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
