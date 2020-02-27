<template>
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <v-card class="card-btn-floating">
                        <div class="container-fluid">
                            <div class="bgc-white bdrs-3 p-20">
                                <h4 class="c-grey-900"><router-link to="/devices" >Devices</router-link>/<router-link :to="'/device/' + $route.params.device"><span v-text="$route.params.device"></span></router-link>/slot/<span v-text="$route.params.slot"></span></h4>
                                <p>
                                    <span v-text="slot.alias"></span><br/>
                                    Parameter name: <span v-text="slot.parameter_name"></span><br/>
                                    Variable: <span v-text="slot.variable_name + ' (' + slot.unit_of_measurement_symbol + ')'"></span><br/>
                                </p>
                                
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
                            <router-link :to="this.$route.params.slot + '/edit'">
                                <v-btn
                                    fab
                                    dark
                                    small
                                    color="green"
                                >
                                    <v-icon>edit</v-icon>
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
            </div>
        </div>

    </main>
</template>

<script>
    export default {
        data (){
            return {
                slot: {},
                fab: false
            }
        },
        methods:{
            getSlot(){
                axios.get('/organization/' + this.$organization.slug + '/device/' + this.$route.params.device + '/slot/' + this.$route.params.slot).then(r => {
                    var response = r.data;
                    this.slot = response.slot;
                })
                .catch(error => {this.$handleRequestError(error)});
            }
        },
        mounted() {
            this.getSlot();
        }
    }
</script>