<script lang="ts">
import {defineComponent} from 'vue';
import {Swiper, SwiperSlide} from 'swiper/vue';
import {Navigation} from 'swiper/modules';

export default defineComponent({
  name: "ReviewsBlock",
  components: {Swiper, SwiperSlide},
  data: () => {
    return {
      modules: [Navigation]
    };
  }
})
</script>

<template>
  <section class="reviews-block-container container">
    <h3 class="reviews-block-title page-title h1">Отзывы пользователей</h3>


    <swiper
      :navigation="true"
      :modules="modules"
      :slidesPerView="3"
      :spaceBetween="60"
      class="mySwiper reviews-block"
    >
      <swiper-slide class="review-card-slide">
        <div class="review-card">
          <div class="review-card-header">
            <div class="review-card-author">Сергей В.</div>
            <div class="review-card-date">21.02.2025 г.</div>
          </div>
          <div class="review-card-body">
            <p>Мы объединяем на одной платформе всех участников рынка — от застройщиков до инвесторов. Даём каждому возможность зарабатывать, инвестировать и покупать недвижимость легко и безопасно.Все сделки проходят прозрачно, быстро и с юридическим сопровождением.</p>
          </div>
        </div>
      </swiper-slide>
      <swiper-slide class="review-card-slide">
        <div class="review-card">
          <div class="review-card-header">
            <div class="review-card-author">Сергей В.</div>
            <div class="review-card-date">21.02.2025 г.</div>
          </div>
          <div class="review-card-body">
            <p>Мы объединяем на одной платформе всех участников рынка — от застройщиков до инвесторов. Даём каждому возможность зарабатывать, инвестировать и покупать недвижимость легко и безопасно.Все сделки проходят прозрачно, быстро и с юридическим сопровождением.</p>
          </div>
        </div>
      </swiper-slide>
      <swiper-slide class="review-card-slide">
        <div class="review-card">
          <div class="review-card-header">
            <div class="review-card-author">Сергей В.</div>
            <div class="review-card-date">21.02.2025 г.</div>
          </div>
          <div class="review-card-body">
            <p>Мы объединяем на одной платформе всех участников рынка — от застройщиков до инвесторов. Даём каждому возможность зарабатывать, инвестировать и покупать недвижимость легко и безопасно.Все сделки проходят прозрачно, быстро и с юридическим сопровождением.</p>
          </div>
        </div>
      </swiper-slide>
      <swiper-slide class="review-card-slide">
        <div class="review-card">
          <div class="review-card-header">
            <div class="review-card-author">Сергей В.</div>
            <div class="review-card-date">21.02.2025 г.</div>
          </div>
          <div class="review-card-body">
            <p>Мы объединяем на одной платформе всех участников рынка — от застройщиков до инвесторов. Даём каждому возможность зарабатывать, инвестировать и покупать недвижимость легко и безопасно.Все сделки проходят прозрачно, быстро и с юридическим сопровождением.</p>
          </div>
        </div>
      </swiper-slide>
      <swiper-slide class="review-card-slide">
        <div class="review-card">
          <div class="review-card-header">
            <div class="review-card-author">Сергей В.</div>
            <div class="review-card-date">21.02.2025 г.</div>
          </div>
          <div class="review-card-body">
            <p>Мы объединяем на одной платформе всех участников рынка — от застройщиков до инвесторов. Даём каждому возможность зарабатывать, инвестировать и покупать недвижимость легко и безопасно.Все сделки проходят прозрачно, быстро и с юридическим сопровождением.</p>
          </div>
        </div>
      </swiper-slide>
      <swiper-slide class="review-card-slide">
        <div class="review-card">
          <div class="review-card-header">
            <div class="review-card-author">Сергей В.</div>
            <div class="review-card-date">21.02.2025 г.</div>
          </div>
          <div class="review-card-body">
            <p>Мы объединяем на одной платформе всех участников рынка — от застройщиков до инвесторов. Даём каждому возможность зарабатывать, инвестировать и покупать недвижимость легко и безопасно.Все сделки проходят прозрачно, быстро и с юридическим сопровождением.</p>
          </div>
        </div>
      </swiper-slide>
      <swiper-slide class="review-card-slide">
        <div class="review-card">
          <div class="review-card-header">
            <div class="review-card-author">Сергей В.</div>
            <div class="review-card-date">21.02.2025 г.</div>
          </div>
          <div class="review-card-body">
            <p>Мы объединяем на одной платформе всех участников рынка — от застройщиков до инвесторов. Даём каждому возможность зарабатывать, инвестировать и покупать недвижимость легко и безопасно.Все сделки проходят прозрачно, быстро и с юридическим сопровождением.</p>
          </div>
        </div>
      </swiper-slide>
    </swiper>
  </section>
</template>

<style lang="scss">
@use '@/styles/system/variable' as *;

.review-card {
  &-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    margin-bottom: 20px;
  }

  &-author {
    font-family: var(--font-family);
    font-weight: 500;
    font-size: 14px;
    line-height: 150%;
    color: $bo-color-name;
  }

  &-date {
    font-family: var(--font-family);
    font-weight: 500;
    font-size: 14px;
    line-height: 150%;
    color: $fast-search-color;
  }

  &-body {
    font-family: var(--font-family);
    font-weight: 400;
    font-size: 14px;
    line-height: 150%;
    color: $bo-color-name;
  }
}

.reviews-block {

  &-title {
    margin-bottom: 30px;
  }

  &-container {
    margin-bottom: 80px !important;
  }
}
</style>
