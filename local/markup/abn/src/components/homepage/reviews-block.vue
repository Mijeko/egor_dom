<script lang="ts">
import {defineComponent} from 'vue'

export default defineComponent({
  name: "ReviewsBlock"
})
</script>

<template>
  <section class="reviews-block-container">
    <h3 class="reviews-block-title">Отзывы пользователей</h3>

    <div class="reviews-block">

      <div class="review-card">
        <div class="review-card-header">
          <div class="review-card-author">Сергей В.</div>
          <div class="review-card-date">21.02.2025 г.</div>
        </div>
        <div class="review-card-body">
          <p>Мы объединяем на одной платформе всех участников рынка — от застройщиков до инвесторов. Даём каждому возможность зарабатывать, инвестировать и покупать недвижимость легко и безопасно.Все сделки проходят прозрачно, быстро и с юридическим сопровождением.</p>
        </div>
      </div>
      
    </div>
  </section>
</template>

<style scoped>

</style>
