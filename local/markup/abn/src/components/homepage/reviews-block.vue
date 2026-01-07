<script lang="ts">
import {defineComponent} from 'vue';
import {Swiper, SwiperSlide} from 'swiper/vue';
import {Navigation} from 'swiper/modules';
import type {ReviewDto} from "@/dto/entity/ReviewDto.ts";
import type {NavigationOptions} from "swiper/types";

export default defineComponent({
  name: "ReviewsBlock",
  components: {Swiper, SwiperSlide},
  props: {
    reviews: {
      type: Array as PropType<ReviewDto[]>,
      default: () => [],
    }
  },
  data: () => {
    return {
      modules: [Navigation],
      navigation: {
        nextEl: '.reviews-block-slider-next',
        prevEl: '.reviews-block-slider-prev',
      } as NavigationOptions,
    };
  }
})
</script>

<template>
  <section class="reviews-block-container container" v-if="reviews.length > 0">
    <h3 class="reviews-block-title page-title h1">Отзывы пользователей</h3>

    <swiper
      :modules="modules"
      :navigation
      :slidesPerView="3"
      :spaceBetween="60"
      class="mySwiper reviews-block-slider"
    >
      <swiper-slide class="review-card-slide" v-for="(review,index) in reviews" :key="index">
        <div class="review-card">
          <div class="review-card-header">
            <div class="review-card-author">{{ review.author }}</div>
            <div class="review-card-date">{{ review.date }}</div>
          </div>
          <div class="review-card-body">{{ review.text }}</div>
        </div>
      </swiper-slide>

      <div class="reviews-block-slider-prev">
        <svg width="12" height="10" viewBox="0 0 12 10" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M6.75 0.75L10.75 4.75L6.75 8.75M0.75 0.750001L4.75 4.75L0.75 8.75" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </div>
      <div class="reviews-block-slider-next">
        <svg width="12" height="10" viewBox="0 0 12 10" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M6.75 0.75L10.75 4.75L6.75 8.75M0.75 0.750001L4.75 4.75L0.75 8.75" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </div>


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

  &-slider {
    padding-bottom: 70px;

    &-prev, &-next {
      position: absolute;
      top: auto;
      bottom: 0;
      padding: 16px 25px;
      border: 1px solid #f9f9f9;
      border-radius: 50px;
      cursor: pointer;

      &.swiper-button-disabled {
        background: #f6f6f6;

        svg {
          path {
            stroke: #cacaca;
          }
        }
      }

      &:not(.swiper-button-disabled) {
        box-shadow: 0 0 20px 0 rgba(139, 139, 139, 0.1);
        background: #9fccff;
      }
    }

    &-prev {
      left: 45%;
      transform: translateX(-45%);

      svg {
        transform: rotate(180deg);
      }
    }

    &-next {
      right: 45%;
      transform: translateX(45%);
    }
  }
}
</style>
