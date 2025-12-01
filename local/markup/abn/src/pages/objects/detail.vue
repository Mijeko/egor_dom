<script lang="ts">
import {defineComponent} from 'vue'
import type BuildObjectDto from "@/dto/entity/BuildObjectDto.ts";
import BuildObjectService from "@/service/BuildObjectService.ts";
import Price from "@/core/price.ts";
import {Swiper, SwiperSlide} from 'swiper/vue';
import type BxImage from "@/dto/bitrix/BxImage.ts";
import {FreeMode, Navigation, Thumbs} from 'swiper/modules';
import type {Swiper as SwiperType} from 'swiper/types';
import type ApartmentDto from "@/dto/entity/ApartmentDto.ts";

export interface CharItem {
  key: string;
  value: string;
}

export default defineComponent({
  name: "detail",
  components: {Swiper, SwiperSlide},
  props: {
    buildObject: {
      type: Object as PropType<BuildObjectDto>,
      default: () => {
        return {};
      }
    },
  },
  data: () => {
    return {
      thumbsSwiper: null as SwiperType | null,
      modules: [FreeMode, Navigation, Thumbs],
    };
  },
  methods: {
    setThumbsSwiper(swiper: any) {
      this.thumbsSwiper = swiper;
    },
    gallery(obj: BuildObjectDto): BxImage[] {

      if (!obj.gallery) {
        return [];
      }

      let gallery: BxImage[] = obj.gallery;

      gallery = gallery.filter((img: BxImage) => {
        return img?.src && typeof img?.src === 'string';
      });

      return gallery;
    },
  },
  computed: {
    apartmentList(): ApartmentDto[] {
      return [];
    },
    Price() {
      return Price
    },
    minPrice(object: BuildObjectDto): number {
      return BuildObjectService.minPrice(object);
    },
    chars(): CharItem[] {

      let r: CharItem[] = [];

      r.push({key: 'Город', value: 'Барнаул'});
      r.push({key: 'Адрес', value: 'ул. Ленина 101'});
      r.push({key: 'Тип сделки', value: 'Новостройка'});
      r.push({key: 'Этаж / Этажность', value: '5 / 25'});
      r.push({key: 'Срок сдачи', value: '3 кв. 2026'});
      r.push({key: 'Статус объекта', value: 'Строится'});
      r.push({key: 'Юридическая проверка', value: 'Проверено платформой «Побеждай»'});

      return r;
    }
  }
})
</script>

<template>
  <div class="build-object-detail container">

    <div class="build-object-detail-left">
      <swiper
        class="build-object-detail-slider"
        v-if="buildObject?.gallery && thumbsSwiper"
        :spaceBetween="10"
        :navigation="true"
        :thumbs="{ swiper: thumbsSwiper }"
        :pagination="true"
        :modules
      >
        <swiper-slide v-for="(image,index) in gallery(buildObject)">
          <img
            v-if="image.src"
            :src="image.src"
            :alt="`${buildObject.name} ${index}`"
          >
        </swiper-slide>
      </swiper>


      <swiper
        @swiper="setThumbsSwiper"
        :spaceBetween="10"
        :slidesPerView="4"
        :freeMode="true"
        :watchSlidesProgress="true"
        :modules="modules"
        class="mySwiper"
      >
        <swiper-slide v-for="(image,index) in gallery(buildObject)" class="build-object-detail-slider-slide">
          <img
            v-if="image.src"
            :src="image.src"
            :alt="`${buildObject.name} ${index}`"
            class="build-object-detail-slider-slide__image"
          >
        </swiper-slide>
      </swiper>
    </div>

    <div class="build-object-detail-right">

      <h1 class="build-object-detail-title page-title h1">{{ buildObject.name }}</h1>

      <div class="build-object-detail-developer">{{ buildObject.developer?.name }}</div>

      <div class="build-object-detail-chars">

        <div class="build-object-detail-chars-row" v-for="char in chars">
          <div class="build-object-detail-chars-key">{{ char.key }}</div>
          <div class="build-object-detail-chars-value">{{ char.value }}</div>
        </div>

      </div>

      <div class="build-object-detail-control">
        <div class="build-object-detail-price">
          от {{ Price.format(minPrice) }}
        </div>

        <button class="sign-view-button">
          Записаться на просмотр
        </button>

        <button class="add-favorite">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M3.80674 6.20641C4.70687 5.30655 5.92755 4.80104 7.20034 4.80104C8.47313 4.80104 9.69381 5.30655 10.5939 6.20641L12.0003 7.61161L13.4067 6.20641C13.8495 5.74796 14.3792 5.38229 14.9648 5.13072C15.5504 4.87916 16.1803 4.74675 16.8176 4.74121C17.455 4.73567 18.087 4.85712 18.6769 5.09847C19.2668 5.33982 19.8028 5.69623 20.2534 6.14691C20.7041 6.5976 21.0605 7.13353 21.3019 7.72343C21.5432 8.31333 21.6647 8.9454 21.6591 9.58274C21.6536 10.2201 21.5212 10.8499 21.2696 11.4356C21.0181 12.0212 20.6524 12.5508 20.1939 12.9936L12.0003 21.1884L3.80674 12.9936C2.90688 12.0935 2.40137 10.8728 2.40137 9.60001C2.40137 8.32722 2.90688 7.10654 3.80674 6.20641V6.20641Z" stroke="#739AFE" stroke-width="1.5" stroke-linejoin="round"/>
          </svg>
        </button>

      </div>


      <div class="build-object-detail-description">
        <div class="build-object-detail-description__title">Описание</div>
        <div class="build-object-detail-description__text">
          {{ buildObject.description ?? 'Современный жилой комплекс бизнес-класса «Победа Парк» расположен в зелёной зоне ЮАО, всего в 15 минутах от метро Коломенская. Проект сочетает комфорт, архитектуру европейского уровня и продуманную инфраструктуру. ' }}
        </div>
        <div class="build-object-detail-description__more">Читать полностью</div>
      </div>

    </div>
  </div>

  <div class="build-object-detail-map container">
    <Map
      :apartmentList="apartmentList"
    />
  </div>

  <div class="build-object-detail-house container">

    <img src="@/assets/images/vertical-house.png" class="build-object-detail-house__home" alt="Дом">

    <svg width="555" height="350" viewBox="0 0 555 350" fill="none" xmlns="http://www.w3.org/2000/svg" class="build-object-detail-house__round1">
      <circle cx="277.5" cy="249.5" r="277.5" fill="#6893FF"/>
    </svg>

    <svg width="850" height="350" viewBox="0 0 850 350" fill="none" xmlns="http://www.w3.org/2000/svg" class="build-object-detail-house__round2">
      <circle cx="425" cy="250" r="425" fill="#5A85F2"/>
    </svg>

    <div class="build-object-detail-house-text">
      <h3 class="build-object-detail-house-text__title">от 20 000 руб</h3>
      <p>За рекомендацию. Простой способ заработать — приглашайте покупателей и получайте вознаграждение после сделки</p>
      <h3 class="build-object-detail-house-text__title">24/7 на связи</h3>
      <p>Доступ из личного кабинета. Все операции онлайн: объекты, заявки, сделки и выплаты — в одном месте</p>

      <Button class="build-object-detail-house-join">Регистрация</Button>
    </div>

  </div>
</template>

<style lang="scss">
@use '@/styles/system/variable' as *;

.build-object-detail {
  display: flex;
  gap: 70px;

  &-left {
    flex: 1 1 550px;
    width: 550px;
  }

  &-right {
    flex: 1 1 auto;
    width: 550px;

  }

  &-developer {
    margin-bottom: 30px;
    font-family: var(--second-family);
    font-weight: 300;
    font-size: 16px;
    line-height: 120%;
    color: $bo-color-name;
  }

  &-chars {

    display: flex;
    flex-direction: column;
    gap: 5px;
    margin-bottom: 40px;

    &-row {
      display: flex;
      align-items: flex-start;
      justify-content: space-between;
    }

    &-key {
      font-family: var(--font-family);
      font-weight: 500;
      font-size: 14px;
      line-height: 220%;
      color: $bo-char-label;

    }

    &-value {
      font-family: var(--font-family);
      font-weight: 400;
      font-size: 14px;
      line-height: 220%;
      text-align: right;
      color: $bo-color-name;

    }
  }

  &-control {
    display: flex;
    align-items: center;
    justify-content: flex-start;

    .add-favorite {
      margin-left: 20px;
    }
  }

  &-price {
    font-family: var(--second-family);
    font-weight: 400;
    font-size: 20px;
    line-height: 120%;
    text-transform: uppercase;
    color: $bo-color-name;
    padding-right: 50px;
  }

  &-description {
    display: flex;
    flex-direction: column;
    gap: 10px;
    align-items: flex-start;
    justify-content: flex-start;

    &__title {
      font-family: var(--second-family);
      font-weight: 400;
      font-size: 16px;
      line-height: 140%;
      text-align: center;
      color: $bo-color-name;
    }

    &__text {
      font-family: var(--font-family);
      font-weight: 400;
      font-size: 14px;
      line-height: 150%;
      color: $bo-color-name;
    }

    &__more {
      font-family: var(--font-family);
      font-weight: 500;
      font-size: 14px;
      line-height: 220%;
      color: $bo-char-label;
    }
  }

  &-map {
    width: 100%;
    height: 400px;
    margin-top: 60px !important;
    margin-bottom: 80px !important;
  }

  &-house {
    position: relative;
    background: $house-bg;
    border-radius: 30px;
    padding-bottom: 15% !important;
    width: 100%;
    margin-bottom: 90px !important;

    &__home {
      position: absolute;
      bottom: 0;
      left: 0;
      z-index: 3;
    }

    &__round1 {
      position: absolute;
      left: 50%;
      top: 50%;
      transform: translate(-50%, -50%);
      z-index: 2;
      height: 100%;
      object-fit: contain;
    }

    &__round2 {
      position: absolute;
      left: 50%;
      top: 50%;
      transform: translate(-50%, -50%);
      z-index: 1;
      height: 100%;
      object-fit: contain;
    }

    &-text {
      position: absolute;
      right: 10%;
      top: 50%;
      transform: translate(10%, -50%);
      z-index: 4;
      max-width: 445px;
      width: 100%;

      &__title {
        font-family: var(--second-family);
        font-weight: 500;
        font-size: 24px;
        line-height: 140%;
        text-transform: uppercase;
        color: $white-color;

        &:not(:first-child) {
          margin-top: 20px;
        }
      }

      p {
        font-family: var(--font-family);
        font-weight: 600;
        font-size: 14px;
        line-height: 150%;
        color: $white-color;
      }
    }

    &-join {
      margin-top: 40px;
    }
  }
}

.sign-view-button {
  font-family: var(--font-family);
  font-weight: 500;
  font-size: 14px;
  line-height: 100%;
  color: $bod;
  border: 1px $bod solid;
  padding: 17px 32px;
  border-radius: 30px;
  transition: 0.4s ease all;

  &:hover {
    background-color: $bod;
    color: $white-color;
  }
}

.add-favorite {
  border: 1px solid $bod;
  border-radius: 50%;
  line-height: 1;
  padding: 10px;
  transition: all 0.4s ease;

  svg {
    path {
      transition: all 0.4s ease;
    }
  }

  &:hover {
    background-color: $bod;

    svg {
      path {
        stroke: $white-color;
      }
    }
  }
}
</style>
