<script lang="ts">
import {defineComponent} from 'vue'
import type BxUserDto from "@/dto/bitrix/BxUserDto.ts";

export default defineComponent({
  name: "ShortSideInfo",
  props: {
    user: {
      type: Object as PropType<BxUserDto>,
      default: () => {
        return {};
      }
    }
  }
})
</script>

<template>
  <div class="short-side-info">
    <div class="short-side-info-left">
      <img
        :src="user.avatar?.src"
        :alt="user.name"
        class="short-side-info-avatar"
      >
    </div>
    <div class="short-side-info-body">
      <div class="short-side-info-text --with-icon">
        <div>
          {{ user.name }}
        </div>
        <a href="/profile/settings/" class="link">
          <div class="icon"></div>
        </a>
      </div>
      <div class="short-side-info-text">{{ user.email }}</div>
    </div>
  </div>
</template>

<style lang="scss">
@use '@/styles/system/variable' as *;

.short-side-info {
  display: flex;
  gap: 20px;
  margin-bottom: 30px;

  &-body {
    display: flex;
    flex-direction: column;
    gap: 3px;
  }

  &-avatar {
    display: block;
    width: 60px;
    height: 60px;
    object-fit: cover;
    overflow: hidden;
    border-radius: 50%;
  }

  &-text {
    font-family: var(--font-family);
    font-weight: 500;
    font-size: 14px;
    line-height: 170%;
    color: $bo-color-name;

    &.--with-icon {
      display: flex;
      gap: 10px;
      align-items: flex-start;
      justify-content: flex-start;

      .link {
        margin-left: auto;
      }

      .icon {
        width: 16px;
        height: 16px;
        background-image: url("@/assets/images/icons/pencil.svg");
        background-size: cover;
        cursor: pointer;
      }
    }
  }
}
</style>
