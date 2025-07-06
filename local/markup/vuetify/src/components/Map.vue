<script lang="ts">
import {defineComponent, type PropType} from 'vue'
import type ApartmentDto from "@/dto/entity/ApartmentDto.ts";
import Price from "@/core/Price.ts";

declare var ymaps3: any;


interface popupWithImageDto {
  update?: (data: object) => void;
}

export default defineComponent({
  name: "Map",
  props: {
    apartmentList: {
      type: Array as PropType<ApartmentDto[]>,
      default: [],
    },
    lat: {
      type: Number,
      default: 0,
    },
    lon: {
      type: Number,
      default: 0,
    },
  },
  data: function () {
    return {
      popUp: null
    };
  },
  methods: {
    async loadMap() {
      await ymaps3.ready;
      const {YMap, YMapDefaultSchemeLayer, YMapMarker, YMapDefaultFeaturesLayer} = ymaps3;
      ymaps3.import.registerCdn('https://cdn.jsdelivr.net/npm/{package}', '@yandex/ymaps3-default-ui-theme@0.0');


      let map = new YMap(
        document.getElementById('app'),
        {
          location: {
            center: [this.lon, this.lat],
            zoom: 18
          },
          showScaleInCopyrights: true
        },
        [
          new YMapDefaultSchemeLayer({}),
          new YMapDefaultFeaturesLayer({}),
        ]
      );

      let listApart = this.apartmentList;

      let contentElement = document.createElement('div');
      contentElement.style = 'width:40px; height:40px; cursor:pointer;';
      contentElement.addEventListener('click', function () {

        let popupHtml = document.createElement('div');
        popupHtml.id = 'customPopup'
        popupHtml.classList.add('custom-popup');

        let popupTitle = document.createElement('div');
        popupTitle.classList.add('custom-popup__title');
        popupTitle.textContent = 'Доступные квартиры';

        let popupBody = document.createElement('div');
        popupBody.classList.add('custom-popup__body');

        let htmlListApartment = document.createElement('div');
        htmlListApartment.classList.add('list-apartments');

        for (let apartIndex in listApart) {
          let apart = listApart[apartIndex];

          let apartRow = document.createElement('div');
          let apartRowTitle = document.createElement('div');
          apartRowTitle.classList.add('list-apartments-item__title')
          apartRowTitle.textContent = apart.name;

          let apartRowSubTitle = document.createElement('div');
          apartRowSubTitle.classList.add('list-apartments-item__sub-title');
          apartRowSubTitle.textContent = Price.format(apart.price);

          apartRow.append(apartRowTitle);
          apartRow.append(apartRowSubTitle);

          htmlListApartment.append(apartRow);
        }

        popupBody.append(htmlListApartment);

        let popupFooter = document.createElement('div');
        popupFooter.classList.add('custom-popup__body');

        let buttonClose = document.createElement('button');
        buttonClose.classList.add('custom-popup__close-btn');
        buttonClose.textContent = 'Закрыть';
        buttonClose.id = 'closeCustomPopup';

        popupFooter.append(buttonClose);

        popupHtml.append(popupTitle);
        popupHtml.append(popupBody);
        popupHtml.append(popupFooter);

        document.getElementById('app')?.append(popupHtml);

        document.getElementById('closeCustomPopup')?.addEventListener('click', function () {
          document.getElementById('customPopup')?.remove();
        });

      })
      let iconElement = document.createElement('img');
      iconElement.style = 'width:100%; object-fit:contain;';
      iconElement.src = '/local/templates/main/images/icons/map-marker.png';

      contentElement.append(iconElement);

      let marker = new YMapMarker({
          coordinates: [this.lon, this.lat],
        },
        contentElement
      );

      map.addChild(marker);
    },
  },
  mounted() {
    this.loadMap();
  },
})
</script>

<template>
  <div id="app" style="width: 100%; height:500px;  position: relative; "></div>
</template>

<style lang="scss">
.custom-popup {
  width: 40%;
  height: 60%;
  background: white;
  //border: 1px red solid;
  position: absolute;
  left: 0;
  top: 0;
  margin-top: 15px;
  margin-left: 15px;

  display: flex;
  flex-direction: column;
  justify-content: space-between;
  gap: 10px;
  padding: 10px;
  border-radius: 10px;
  box-shadow: 4px 4px 8px 0 rgba(34, 60, 80, 0.2);

  &__title {
    font-weight: bold;
  }

  &__body {
    max-height: 70%;
    overflow-y: scroll;
  }

  &__footer {
  }

  &__close-btn {
    border-radius: 4px;
    border: 1px silver solid;
    padding: 3px 10px;

  }
}

.list-apartments {
  display: flex;
  flex-direction: column;
  gap: 10px;

  &-item {
    &__title {
      font-weight: 700;
    }

    &__sub-title {
      color: silver;
    }
  }
}


</style>
