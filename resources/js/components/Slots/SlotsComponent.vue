<template>
    <main>
        <v-card class="card-btn-floating">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="bgc-white bdrs-3 p-20">
                            <h4 class="c-grey-900">Slots</h4>
                            <v-simple-table>
                                <template v-slot:default>
                                    <thead>
                                        <tr>
                                            <th class="text-left">Alias</th>
                                            <th class="text-left">Parameter name</th>
                                            <th class="text-left">Variable</th>
                                            <th class="text-left">Unit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="slot in slots" :key="slot.id">
                                            <td><router-link :to="'/device/'+$route.params.device+'/slot/'+slot.id">{{ slot.alias }}</router-link></td>
                                            <td><em>{{ slot.parameter_name }}</em></td>
                                            <td>{{ slot.variable_name }}</td>
                                            <td>{{ slot.unit_of_measurement_name }} ({{ slot.unit_of_measurement_symbol }})</td>
                                        </tr>
                                    </tbody>
                                </template>
                            </v-simple-table>
                        </div>
                    </div>

                </div>
            </div>
            <v-fab-transition>
                <router-link :to="'/device/'+$route.params.device+'/slot/new-slot'">
                    <v-btn
                        absolute
                        top
                        right
                        color="blue darken-2"
                        dark
                        outlined
                        small
                        fab
                        class="table-fab"
                    >
                        <v-icon>add</v-icon>
                    </v-btn>
                </router-link>
            </v-fab-transition>
        </v-card>
    </main>
</template>

<script>
    export default {
        data (){
            return {
                slots: []
            }
        },
        methods:{
            getSlots() {
                axios.get('/organization/' + this.$organization.slug + '/device/' + this.$route.params.device + '/slots').then(r => {
                    var response = r.data;
                    this.slots = response.slots;
                })
                .catch(error => {this.$handleRequestError(error)});
            }
        },
        mounted() {
            this.getSlots();
        }
    }
</script>