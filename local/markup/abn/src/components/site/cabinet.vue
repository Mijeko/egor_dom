<script lang="ts">
import {defineComponent} from 'vue'
import type BxUserDto from "@/dto/bitrix/BxUserDto.ts";
import SigninForm from "@/components/site/form/signin-form.vue";

export default defineComponent({
  name: "Cabinet",
  components: {SigninForm: SigninForm},
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
      showModal: false
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
  <v-dialog max-width="500" v-model="showModal" v-if="!isAuthorized">
    <template v-slot:activator="{ props: activatorProps }">

      <div
        v-bind="activatorProps"
        class="ui-cabinet"
      >
        <img class="ui-cabinet__icon" src="@/assets/images/icons/cabinet.svg" alt="Кабинет">
        <div class="ui-cabinet__label">Профиль</div>
      </div>

    </template>

    <template v-slot:default="{ isActive }">
      <SigninForm />
    </template>
  </v-dialog>
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
</style>
