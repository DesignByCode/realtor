<template>
    <div>
        <div class="panel panel--default">
            <div class="panel__header">Google Map</div>
            <div class="panel__body ">
                <div ref="map" id="map"></div>
            </div>
        </div>

        <div class="panel panel--default">
            <div class="panel__header">Google Panorama</div>
            <div class="panel__body ">
                <div ref="pano" id="pano"></div>
            </div>
        </div>

    </div>

</template>

<script>
    export default {
        name: "GoogleMap",
        data() {
            return {
                map: null,
                place: null,
                marker: null,
                panorama: null,
                mapType: 'roadmap',
                services: null,
                places: null,
                panoOptions: {
                    motionTracking: true,
                    motionTrackingControl: true,
                    linksControl: true,
                    panControl: true,
                    enableCloseButton: true
                }
            }
        },
        methods: {
            callback(results, status) {
                if (status == google.maps.places.PlacesServiceStatus.OK) {
                    for (var i = 0; i < results.length; i++) {
                        var place = results[i];
                        createMarker(results[i]);
                    }
                }
                console.log(results)
            },
            loadMap() {
                this.map = new google.maps.Map(this.$refs.map, {
                    center: {lat: -30.559482, lng: 22.937505999999985},
                    zoom: 5,
                    mapTypeId: this.mapType,
                    // disableDefaultUI: false,
                    gestureHandling: 'cooperative'
                })
                this.panorama = new google.maps.StreetViewPanorama(this.$refs.pano, {
                    position: {lat: -30.559482, lng: 22.937505999999985},
                    pov: {
                        heading: 34,
                        pitch: 10
                    },
                    ...this.panoOptions
                })
                this.map.setStreetView(this.panorama)
                this.marker = new google.maps.Marker({
                    position: {lat: -30.559482, lng: 22.937505999999985},
                    map: this.map,
                    draggable: true
                })


                this.marker.addListener('draged', function() {
                    alert()
                })


            }
        },
        mounted() {
            this.loadMap()
            bus.$on('submit', (payload) => {
                this.marker.setMap(null)
                this.map.setCenter(payload)
                this.marker = new google.maps.Marker({position: payload, map: this.map, draggable: true, animation: google.maps.Animation.DROP,})
                this.panorama = new google.maps.StreetViewPanorama(
                    this.$refs.pano,
                    {
                        position: payload,
                        ...this.panoOptions
                    }
                )
                this.map.setZoom(18);


                this.places = {
                    location: payload,
                    radius: '3000',
                    type: ['shopping_mall']
                }

                this.services =  new google.maps.places.PlacesService(this.map);

                this.services.nearbySearch(this.places, this.callback);



            })
        }
    }
</script>

<style lang="sass" scoped>
    .panel__body
        display: flex
        flex-direction: column
        #pano,
        #map
            position: relative
            min-height: 300px
            background: #eee
            flex: 1
        .header-button
            float: right
</style>
