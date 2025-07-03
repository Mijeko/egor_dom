<script lang="ts">
import {defineComponent} from 'vue'

declare var ymaps3: any;

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
  methods: {
    async loadMap() {
      await ymaps3.ready;
      const {YMap, YMapDefaultSchemeLayer} = ymaps3;


      let map = new YMap(
        document.getElementById('app'),
        {
          location: {
            center: [this.lon, this.lat],
            zoom: 15
          },
          showScaleInCopyrights: true
        },
        [new YMapDefaultSchemeLayer({})]
      );
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

<style scoped>

</style>
