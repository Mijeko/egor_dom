<script lang="ts">
import {defineComponent} from 'vue'

declare var ymaps3: any;


interface popupWithImageDto {
  update?: (data: object) => void;
}

export default defineComponent({
  name: "Map",
  props: {
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


      let popupWithImage: popupWithImageDto = {};

      // Create a custom popup
      const PopupWithImage = () => {
        const popupElement = document.createElement('div');
        popupElement.classList.add('popup');

        const imageElement = document.createElement('img');
        imageElement.src = '../waves.png';
        imageElement.alt = 'waves';
        imageElement.classList.add('image');

        const popupContentElement = document.createElement('div');
        popupContentElement.classList.add('popup__content');

        const popupElementText = document.createElement('div');
        popupElementText.classList.add('popup__text');

        const popupElementTextTitle = document.createElement('div');
        popupElementTextTitle.classList.add('popup__text_title');
        popupElementTextTitle.textContent = 'Title of that pop up';
        popupElementText.appendChild(popupElementTextTitle);

        const popupElementTextContent = document.createElement('div');
        popupElementTextContent.classList.add('popup__text_content');
        popupElementTextContent.textContent =
          'Some useful information about a place. You can add whatever you want: pictures, buttons, different headings.';
        popupElementText.appendChild(popupElementTextContent);

        const buttonElement = document.createElement('button');
        buttonElement.onclick = () => {
          if (popupWithImage !== undefined) {
            popupWithImage?.update?.({
              popup: {
                show: false
              }
            });
          }
        };
        buttonElement.classList.add('button');
        buttonElement.textContent = 'Close';

        popupContentElement.appendChild(imageElement);
        popupContentElement.appendChild(popupElementText);

        popupElement.appendChild(popupContentElement);
        popupElement.appendChild(buttonElement);

        return popupElement;
      };

      // Create a custom popup

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

      let contentElement = document.createElement('div');
      contentElement.style = 'width:40px; height:40px;';
      let iconElement = document.createElement('img');
      iconElement.style = 'width:100%; object-fit:contain;';
      iconElement.src = '/local/templates/main/images/icons/map-marker.png';

      contentElement.append(iconElement);

      popupWithImage = new YMapMarker({
          coordinates: [this.lon, this.lat],
          onClick() {
            if (popupWithImage !== undefined) {
              popupWithImage?.update?.({popup: {show: true}});
            }
          },
          popup: {content: PopupWithImage, position: 'right'},
        },
        contentElement
      );

      map.addChild(popupWithImage);
    },
  },
  mounted() {
    this.loadMap();
  },
})
</script>

<template>
  <div id="app" style="width: 100%; height:500px;"></div>
</template>

<style lang="scss">

@import '@yandex/ymaps3-default-ui-theme/dist/esm/index.css';

</style>
