<script lang="ts">
import {defineComponent} from 'vue'

export default defineComponent({
  name: "PersonalMemberShort"
})
</script>

<template>
  <div class="personal-member">

    <div class="personal-member-header">
      <div class="personal-member-title">
        <slot name="title"></slot>
      </div>
      <div class="personal-member-actions">
        <slot name="actions"></slot>
      </div>
    </div>

    <div class="personal-member-list">
      <div class="personal-member-item">
        <div class="personal-member-item__avatar">
          <img src="@/assets/images/ava.jpg" class="personal-member-item__avatar-src" alt="Филатова">
        </div>
        <div class="personal-member-item__name">Елизавета Филатова Николаевна</div>
      </div>
    </div>

  </div>
</template>

<style lang="scss">
@use '@/styles/system/variable' as *;

.personal-member {
  display: flex;
  flex-direction: column;
  gap: 20px;
  border: 1px solid #e3e3e3;
  border-radius: 25px;
  padding: 30px 40px;
  margin-bottom: 20px;

  &-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  &-title {
    font-family: var(--second-family);
    font-weight: 400;
    font-size: 14px;
    line-height: 140%;
    color: $gray-color;
  }

  &-actions {
    display: flex;
    gap: 20px;
  }

  &-list {
    display: flex;
    flex-direction: column;
    gap: 5px;
  }

  &-item {
    display: flex;
    align-items: center;
    gap: 15px;

    &__avatar {
      width: 100%;
      max-width: 40px;
      padding-bottom: 5%;
      position: relative;
      border-radius: 50%;
      overflow: hidden;

      &-src {
        position: absolute;
        object-fit: cover;
        width: 100%;
        height: 100%;
      }
    }

    &__name {
      font-family: var(--font-family);
      font-weight: 400;
      font-size: 14px;
      line-height: 100%;
      text-align: right;
      color: $bo-color-name;
    }
  }
}
</style>
