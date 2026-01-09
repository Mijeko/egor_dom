<script lang="ts">
import {defineComponent} from 'vue'
import type BxUserDto from "@/dto/bitrix/BxUserDto.ts";
import SigninForm from "@/components/site/form/signin-form.vue";
import SignupForm from "@/components/site/form/signup-form.vue";
import ModalContent from "@/components/site/modal/element/modal-content.vue";

export default defineComponent({
  name: "Cabinet",
  components: {ModalContent, SigninForm, SignupForm},
  props: {
    user: {
      type: Object as PropType<BxUserDto>,
      default: () => {
        return {};
      }
    }
  },
  data: function () {
    return {
      tab: null,
      showModal: false,
      content: [
        {
          title: 'Авторизация',
          render: () => {
            return h(SigninForm);
          }
        },
        {
          title: 'Регистрация',
          render: () => {
            return h(SignupForm);
          }
        },
      ],
    };
  },
  computed: {
    isAuthorized(): boolean {

      if (this.user && this.user.id) {
        return true;
      }

      return false;
    }
  }
})
</script>

<template>
  <BaseModernModal max-width="850" v-if="!isAuthorized">
    <template #activator="{activatorProps}">
      <div
        v-bind="activatorProps"
        class="ui-cabinet"
      >
        <img class="ui-cabinet__icon" src="@/assets/images/icons/cabinet.svg" alt="Кабинет">
        <div class="ui-cabinet__label">Профиль</div>
      </div>
    </template>

    <template #backgroundImage>
      <img src="@/assets/images/modal/bg/auth.png" class="modal-image" alt="Новый пользователь">
    </template>

    <template #content>
      <v-tabs
        v-model="tab"
        grow
        class="auth-tab"
      >
        <v-tab :text="contentItem.title" :key="index" :value="index" v-for="(contentItem,index) in content"></v-tab>
      </v-tabs>

      <v-tabs-window v-model="tab">
        <v-tabs-window-item
          v-for="(contentItem, index) in content"
          :key="index"
          :value="index"
        >
          <div class="auth-tab-content">
            <component :is="contentItem.render"/>
          </div>
        </v-tabs-window-item>
      </v-tabs-window>
    </template>
  </BaseModernModal>
  <a
    href="/profile/"
    v-else
    class="ui-cabinet"
  >
    <img class="ui-cabinet__icon" src="@/assets/images/icons/cabinet.svg" alt="Кабинет">
    <div class="ui-cabinet__label">Профиль</div>
  </a>
</template>

<style lang="scss">

@use "@/styles/system/variable" as *;

.ui-cabinet {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 10px;
  background: $light-blue-color;
  padding: 3px 19px 3px 3px;
  border-radius: 19px;
  cursor: pointer;
  text-decoration: none;

  &__icon {
  }

  &__label {
    font-family: var(--font-family);
    font-weight: 500;
    font-size: 14px;
    line-height: 120%;
    color: $blacked;
  }
}

.auth-tab {
  height: auto !important;

  .v-slide-group__content {
    gap: 10px;
    flex: unset;
  }

  .v-btn {
    height: auto !important;
    padding: 10px !important;
    border-radius: 20px !important;
    margin: 0 !important;

    &.v-tab-item--selected {
      background: $about-mark;
    }

    &__content {
      color: $bo-color-name;
    }
  }

  .v-tab__slider {
    display: none;
  }


  &-content {
    padding: 25px 0 15px 0;
  }
}
</style>
