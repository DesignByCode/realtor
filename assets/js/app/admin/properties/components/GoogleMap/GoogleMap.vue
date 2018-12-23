<template>
    <div>
        <div class="panel panel--default">
            <div class="panel__header">Google Map</div>
            <div class="panel__body">
                <div ref="map" id="map"></div>
                <div id="control"></div>
            </div>
        </div>

        <div class="panel panel--default">
            <div class="panel__header">Google Panorama</div>
            <div class="panel__body">
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
                mapType: 'roadmap'
            }
        },
        methods: {

            makeMap(){

            },
            loadMap() {

                this.map = new google.maps.Map(this.$refs.map, {
                    center: {lat: -30.559482, lng: 22.937505999999985},
                    zoom: 5,
                    mapTypeId: this.mapType,
                    disableDefaultUI: false,
                    gestureHandling: 'cooperative'
                })

                this.panorama = new google.maps.StreetViewPanorama(this.$refs.pano, {
                    position: {lat: -30.559482, lng: 22.937505999999985},
                    pov: {
                        heading: 34,
                        pitch: 10
                    }
                })

                this.map.setStreetView(this.panorama)

                this.marker = new google.maps.Marker({
                    position: {lat: -30.559482, lng: 22.937505999999985},
                    map: this.map,
                    draggable: true,
                    animation: google.maps.Animation.DROP
                })

                this.marker.addListener('draged', function() {
                    //TODO: drag marker to update new datat
                })

            }
        },
        mounted() {
            this.loadMap()

            bus.$on('google_autocomplete_submit', (payload) => {
                this.marker.setMap(null)
                this.map.setCenter(payload)

                this.marker = new google.maps.Marker({
                    position: {lat: payload.lat, lng: payload.lng},
                    map: this.map,
                    draggable: true,
                    animation: google.maps.Animation.DROP
                })

                this.panorama = new google.maps.StreetViewPanorama(
                    this.$refs.pano,
                    {
                        position: {
                            lat: payload.lat,
                            lng: payload.lng
                        },
                        pov: {
                            heading: 34,
                            pitch: 10
                        }
                    }
                )

                this.map.setZoom(18);
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
