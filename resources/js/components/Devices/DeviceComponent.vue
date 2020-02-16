<template>
    <main>
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
                v-if="!create"
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
    </main>
</template>

<script>
    export default {
        data (){
            return {
                device: {},
                fab: false
            }
        },
        methods:{
            getDevice(){
                axios.get('/device/' + this.$route.params.id).then(r => {
                    var response = r.data;
                    this.device = response.device;
                })
                .catch(error => {this.$handleRequestError(error)});
            },
        },
        mounted() {
            this.getDevice();
        }
    }
</script>