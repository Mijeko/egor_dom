<script lang="ts">
import {defineComponent} from 'vue';
import {Swiper, SwiperSlide} from 'swiper/vue';
import {Navigation, Pagination} from 'swiper/modules';
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
      modules: [Navigation, Pagination],
      navigation: {
        nextEl: '.reviews-block-slider-next',
        prevEl: '.reviews-block-slider-prev',
      } as NavigationOptions,
      pagination: {
        el: '.reviews-block-slider-pagination',
        clickable: true,
      },
    };
  }
})
</script>

<template>
  <section class="reviews-block-container container" v-if="reviews.length > 0">
    <h3 class="reviews-block-title page-title h1">Отзывы пользователей</h3>

    <div class="reviews-block-slider-container">
      <swiper
        :modules="modules"
        :pagination
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
            <div class="review-card-body" v-html="review.text"></div>
          </div>
        </swiper-slide>

      </swiper>

      <div class="reviews-block-slider-pagination"></div>

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

    </div>

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
    margin-bottom: 60px;
  }

  &-container {
    margin-bottom: 150px !important;
  }

  &-slider {

    &-container {
      position: relative;
    }

    &-pagination {
      margin-top: 60px;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 5px;

      .swiper-pagination-bullet {
        color: $stat-border-color;
        background: $stat-border-color;
        opacity: 1;
        margin: 0 !important;

        &-active {
          color: $pagination-active;
          background: $pagination-active;
        }
      }
    }

    &-prev, &-next {
      position: absolute;
      top: 50%;
      padding: 16px 25px;
      border: 1px solid #f9f9f9;
      border-radius: 50px;
      cursor: pointer;


      svg {
        path {
          stroke: #cacaca;
        }
      }
    }

    &-prev {
      left: -30px;
      transform: translate(-30px, -50%);

      svg {
        transform: rotate(180deg);
      }
    }

    &-next {
      right: -30px;
      transform: translate(30px, -50%);
    }
  }
}
</style>
