<script lang="ts">
import {defineComponent} from 'vue'

export default defineComponent({
  name: "DeveloperIcons"
})
</script>

<template>

  <section class="developer-icon-container container">
    <div class="developer-icon-list">

      <div class="developer-icon-item">
        <img class="developer-icon-icon" src="@/assets/images/icons/developers/1.png">
      </div>

      <div class="developer-icon-item">
        <img class="developer-icon-icon" src="@/assets/images/icons/developers/2.png">
      </div>

      <div class="developer-icon-item">
        <img class="developer-icon-icon" src="@/assets/images/icons/developers/3.png">
      </div>

      <div class="developer-icon-item">
        <img class="developer-icon-icon" src="@/assets/images/icons/developers/4.png">
      </div>

      <div class="developer-icon-item">
        <img class="developer-icon-icon" src="@/assets/images/icons/developers/5.png">
      </div>

      <div class="developer-icon-item">
        <img class="developer-icon-icon" src="@/assets/images/icons/developers/6.png">
      </div>
    </div>

    <div class="developer-icon-text">
      Все объекты проходят юридическую и документальную проверку. Все сделки сопровождаются нашими экспертами, а выплаты партнёрам проходят по
    </div>
  </section>

</template>

<style lang="scss">
@use '@/styles/system/variable' as *;

.developer-icon {
  &-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 30px;
    margin-bottom: 80px !important;
  }

  &-list {
    display: flex;
    gap: 10px;
  }

  &-item {
    max-width: 16%;
    width: 100%;
  }

  &-icon {
    width: 100%;
    object-fit: contain;
  }

  &-text {
    max-width: 594px;
    font-family: var(--font-family);
    font-weight: 500;
    font-size: 14px;
    line-height: 150%;
    text-align: center;
    color: $gray-color;
  }
}
</style>
