import * as ymaps3 from 'ymaps3';


window.map = null;


/**
 * @param params {{coordinates: Array, center: Array, defaultIcon: string, zoom: integer, rootElement: string, customization: Array}}
 */
async function main(params) {

    await ymaps3.ready;
    const {
        YMap,
        YMapDefaultSchemeLayer,
        YMapDefaultFeaturesLayer,
        YMapMarker,
    } = ymaps3;

    const {YMapClusterer, clusterByGrid} = await ymaps3.import('@yandex/ymaps3-clusterer@0.0.1');


    const COMMON_LOCATION_PARAMS = {easing: 'ease-in-out', duration: 2000};
    let geoCoords = params.coordinates.map((el, index) => {
        return {
            type: 'Feature',
            id: el.id,
            geometry: {type: 'Point', coordinates: el.coords},
            properties: {
                name: 'marker',
                description: ''
            }
        };
    });

    const map = new YMap(
        document.getElementById(params.rootElement),
        {
            location: {
                // Координаты центра карты
                center: params.center,
                // Уровень масштабирования
                zoom: params.zoom
            }
        },
        [
            new YMapDefaultSchemeLayer(),
            new YMapDefaultFeaturesLayer()
        ]
    );


    const marker = (feature) => {

        let _marker = params.coordinates.filter(coordItem => {
            return coordItem.id === feature.id;
        }).pop();

        if (!_marker) {
            return;
        }

        const markerContainerElement = document.createElement('div');
        markerContainerElement.classList.add('offices-map-marker-container');

        const markerText = document.createElement('div');
        markerText.id = feature.id;
        markerText.classList.add('offices-map-marker-text', 'hidden');
        markerText.innerText = _marker.name;

        markerContainerElement.onmouseover = () => {
            markerText.classList.replace('hidden', 'visible');
        };

        markerContainerElement.onmouseout = () => {
            markerText.classList.replace('visible', 'hidden');
        };

        const markerElement = document.createElement('div');
        markerElement.classList.add('marker');


        const markerImage = document.createElement('img');
        markerImage.src = params.defaultIcon;
        if (_marker.icon) {
            markerImage.src = _marker.icon;
        }
        markerImage.classList.add('image');

        markerElement.appendChild(markerImage);

        markerContainerElement.appendChild(markerText);
        markerContainerElement.appendChild(markerElement);

        return new YMapMarker(
            {
                coordinates: feature.geometry.coordinates
            },
            markerContainerElement
        );
    };

    const cluster = (coordinates, features) => {
        return new YMapMarker(
            {
                coordinates,
                onClick() {
                    const bounds = getBounds(features.map((feature) => feature.geometry.coordinates));
                    map.update({location: {bounds, ...COMMON_LOCATION_PARAMS}});
                }
            },
            circle(features.length).cloneNode(true)
        );
    };

    function circle(count) {
        const circle = document.createElement('div');
        circle.classList.add('offices-map-circle');
        circle.innerHTML = `
			<div class="offices-map-circle-content">
				<span class="offices-map-circle-text">${count}</span>
			</div>
		`;
        return circle;
    }

    function getBounds(coordinates) {
        let minLat = Infinity,
            minLng = Infinity;
        let maxLat = -Infinity,
            maxLng = -Infinity;

        for (const coords of coordinates) {
            const lat = coords[1];
            const lng = coords[0];

            if (lat < minLat) minLat = lat;
            if (lat > maxLat) maxLat = lat;
            if (lng < minLng) minLng = lng;
            if (lng > maxLng) maxLng = lng;
        }

        return [
            [minLng, minLat],
            [maxLng, maxLat]
        ];
    }


    const clusterer = new YMapClusterer({
        method: clusterByGrid({gridSize: 64}),
        features: geoCoords,
        marker,
        cluster
    });
    map.addChild(clusterer);


    if (typeof params.customization !== 'undefined') {
        const layer = new YMapDefaultSchemeLayer({
            customization: params.customization
        });
        map.addChild(layer);
    }


}


window.renderMap = main;