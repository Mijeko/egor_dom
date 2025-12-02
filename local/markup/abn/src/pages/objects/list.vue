<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import type BuildObjectDto from "@/dto/entity/BuildObjectDto.ts";
import CatalogFilter from "@/components/filter/catalog-filter.vue";
import Pagination from "@/components/site/pagination.vue";
import type ApartmentDto from "@/dto/entity/ApartmentDto.ts";

import multiStoryBuilding from '@/assets/images/multiStoryBuilding.jpg';
import userDown from '@/assets/images/user-down.svg';
import listCheck from '@/assets/images/graph.png';
import ItemBg from "@/components/site/block-with-stat/item-bg.vue";
import ItemImage from "@/components/site/block-with-stat/item-image.vue";
import ItemBigNumber from "@/components/site/block-with-stat/item-big-number.vue";
import ItemWithIcon from "@/components/site/block-with-stat/item-with-icon.vue";
import BlockWithStat from "@/components/site/block-with-stat/block-with-stat.vue";
import AdvantageItem from "@/components/developer/advantage-item.vue";
import DeveloperSearch from "@/components/developer/developer-search.vue";
import DeveloperList from "@/components/developer/developer-list.vue";

export default defineComponent({
  name: "list",
  data: () => {
    return {
      multiStoryBuilding: multiStoryBuilding,
      userDown: userDown,
      listCheck: listCheck,
    };
  },
  components: {ItemBg, ItemImage, ItemBigNumber, ItemWithIcon, BlockWithStat, AdvantageItem, DeveloperSearch, DeveloperList, Pagination, CatalogFilter},
  props: {
    buildObjects: {
      type: Array as PropType<BuildObjectDto[]>
    }
  },
  computed: {
    apartmentList(): ApartmentDto[] {


      let res: ApartmentDto[] = [];

      this.buildObjects?.forEach((objectDto: BuildObjectDto, index, array) => {
        if (Array.isArray(objectDto.apartments)) {
          res.push(...objectDto.apartments);
        }
      });

      return res;
    }
  }
})
</script>

<template>


  <section class="catalog-page">
    <div class="catalog-page-header">
      <h1 class="page-title h1">Каталог недвижимости</h1>
    </div>
    <div class="catalog-page-body">

      <CatalogFilter/>

      <div class="catalog-container container">
        <div class="catalog">
          <BuildObjectItem
            v-for="obj in buildObjects"
            :buildObject="obj"
          />

        </div>

        <Pagination/>

        <div class="map-objects container">
          <Map
            :apartmentList="apartmentList"
          />
        </div>


        <BlockWithStat>

          <ItemWithIcon :iconSrc="listCheck">
            Полное сопровождение сделки — всё под контролем специалистов платформы
          </ItemWithIcon>

          <ItemImage :src="multiStoryBuilding"/>

          <ItemBigNumber>
            <template #heading>+ 10 000</template>
            <template #text>Объектов по всей стране Актуальные предложения напрямую от застройщиков, агентств и частных продавцов</template>
          </ItemBigNumber>

          <ItemBigNumber>
            <template #heading>100%</template>
            <template #text>Юридическая экспертиза и контроль документов</template>
          </ItemBigNumber>

          <ItemWithIcon :iconSrc="userDown">
            Постоянно растущая база проверенных компаний
          </ItemWithIcon>


          <ItemBg>
            «Побеждай» — это не просто цифровая платформа.
            Это экосистема, объединяющая участников рынка недвижимости в едином технологичном пространстве
          </ItemBg>

        </BlockWithStat>
      </div>
    </div>


  </section>

</template>

<style lang="scss">
@use '@/styles/system/variable' as *;

.map-objects {
  width: 100%;
  height: 500px;
  overflow: hidden;
  border-radius: 20px;
  margin-top: 60px !important;
}

.catalog-page {
  margin-bottom: 60px;

  &-body {
    display: flex;
    align-items: flex-start;
    justify-content: center;
    gap: 30px;
    margin-top: 40px;
  }
}

.catalog {
  width: 100%;
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  gap: 30px;
  margin-bottom: 30px;


  &-container {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    justify-content: flex-start;
    // @over
    margin: 0 !important;
  }

  .build-object-card {
    max-width: calc(33% - 20px);
    width: 100%;
  }
}

</style>
