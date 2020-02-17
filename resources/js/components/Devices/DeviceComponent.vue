<template>
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <v-card class="card-btn-floating">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="bgc-white bdrs-3 p-20">
                                        <h4 class="c-grey-900"><router-link to="/devices" >Devices</router-link>/<span v-text="device.identifier"></span></h4>
                                        <p>
                                            <span v-text="device.identifier"></span> - <span v-text="device.alias"></span><br/>
                                            Type: <span v-text="device.device_type"></span><br/>
                                            Technology: <span v-text="device.technology_type"></span><br/>
                                            <span v-text="device.last_seen ? device.last_seen : 'No data'"></span>
                                        </p>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <v-speed-dial
                            v-model="fab"
                            top
                            right
                            direction="bottom"
                            :open-on-hover="false"
                            transition="scale-transition"
                        >
                            <template v-slot:activator>
                                <v-btn
                                    v-model="fab"
                                    color="blue darken-2"
                                    dark
                                    outlined
                                    small
                                    fab
                                >
                                    <v-icon dark v-if="fab">clear</v-icon>
                                    <v-icon dark v-else>more_vert</v-icon>
                                </v-btn>
                            </template>
                            <router-link :to="this.$route.params.id + '/edit'">
                                <v-btn
                                    fab
                                    dark
                                    small
                                    color="green"
                                >
                                    <v-icon>edit</v-icon>
                                </v-btn>
                            </router-link>
                            <router-link :to="this.$route.params.id + '/slots'">
                                <v-btn
                                    fab
                                    dark
                                    small
                                    color="indigo"
                                >
                                    <v-icon>settings_input_component</v-icon>
                                </v-btn>
                            </router-link>
                            <v-btn
                                fab
                                dark
                                small
                                color="red"
                            >
                                <v-icon>delete</v-icon>
                            </v-btn>
                        </v-speed-dial>
                    </v-card>
                </div>
                <div class="col-md-6">
                    <v-card v-if="device.latitude && device.longitude">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="bgc-white bdrs-3 p-20">
                                        <div style="height: 160px; width: 100%">
                                            <l-map
                                              :zoom="zoom"
                                              :center="{ lat: device.latitude, lng: device.longitude }"
                                              :options="mapOptions"
                                              style="height: 100%"
                                            >
                                              <l-tile-layer
                                                :url="url"
                                                :attribution="attribution"
                                              />

                                              <l-marker :lat-lng="{ lat: device.latitude, lng: device.longitude }">
                                                <l-popup>
                                                  <div>
                                                    Device Pop up
                                                  </div>
                                                </l-popup>
                                              </l-marker>
                                            </l-map>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </v-card>
                </div>
            </div>
        </div>

    </main>
</template>

<script>
    import { Icon } from "leaflet";
    delete Icon.Default.prototype._getIconUrl;
    Icon.Default.mergeOptions({
      iconRetinaUrl: require('leaflet/dist/images/marker-icon-2x.png'),
      iconUrl: require('leaflet/dist/images/marker-icon.png'),
      shadowUrl: require('leaflet/dist/images/marker-shadow.png'),
    });
    export default {
        data (){
            return {
                device: {},
                fab: false,
                zoom: 13,
                url: 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
                attribution:
                    '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
                withPopup: {lat: 47.41322, lng: -1.219482},
                withTooltip: {lat: 47.41422, lng: -1.250482},
                currentZoom: 11.5,
                showParagraph: false,
                mapOptions: {
                    zoomSnap: 0.5
                }
            }
        },
        methods:{
            getDevice(){
                axios.get('/device/' + this.$route.params.id).then(r => {
                    var response = r.data;
                    this.device = response.device;
                })
                .catch(error => {this.$handleRequestError(error)});
            }
        },
        mounted() {
            this.getDevice();
        }
    }
</script>