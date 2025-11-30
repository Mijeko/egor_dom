<script lang="ts">
import {defineComponent} from 'vue'

export default defineComponent({
  name: "BlockWithStat"
})
</script>

<template>
  <div class="developer-page-statistic-container container">
    <div class="developer-page-statistic">
      <slot/>
    </div>
  </div>
</template>

<style lang="scss">
@use '@/styles/system/variable' as *;

.developer-page {
  &-statistic {
    padding-top: 80px;
    padding-bottom: 134px;
    width: 100%;
    display: flex;
    gap: 30px 10px;
    flex-wrap: wrap;

    background-color: $white-color;
    color: $bo-color-name;

    &-item {
      overflow: hidden;
      position: relative;
      border: 1px solid $stat-border-color;
      border-radius: 25px;
      padding: 38px 35px;

      &:nth-child(1) {
        flex: 0 0 20%;
      }

      &:nth-child(2) {
        flex: 0 0 35%;
      }

      &:nth-child(3) {
        flex: 0 0 43%;
      }

      &:nth-child(4) {
        flex: 0 0 30%;
      }

      &:nth-child(5) {
        flex: 0 0 20%;
      }

      &:nth-child(6) {
        flex: 0 0 48%;
      }


      &.bg {
        background: $about-mark;
        padding: 50px 40px;
        font-family: var(--font-family);
        font-weight: 300;
        font-size: 16px;
        line-height: 155%;
        color: $bo-color-name;
      }

      &.img {
        padding: 0;
      }

      &__image {
        position: absolute;
        width: 100%;
        height: 100%;
        object-fit: cover;
      }

      .block-with-icon {
        &-icon {
          display: flex;
          align-items: flex-start;
          justify-content: flex-start;
          flex-direction: column;
          gap: 15px;

          &-wrap {
          }
        }

        &-text {
          font-family: var(--second-family);
          font-weight: 300;
          font-size: 12px;
          line-height: 155%;
          color: $bo-color-name;
        }
      }

      .block-with-stat {
        display: flex;
        flex-direction: column;
        gap: 10px;

        &-heading {
          font-family: var(--second-family);
          font-weight: 300;
          font-size: 48px;
          line-height: 140%;
          text-transform: uppercase;
          color: $bo-color-name;
        }

        &-text {
          font-family: var(--second-family);
          font-weight: 300;
          font-size: 12px;
          line-height: 155%;
          color: $bo-color-name;
        }
      }
    }

  }
}
</style>
