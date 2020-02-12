<template>
    <main>
        <v-card class="card-btn-floating">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="bgc-white bdrs-3 p-20">
                            <h4 class="c-grey-900">Devices</h4>
                            <v-text-field
                                v-model="filter"
                                label="Filter by alias or identifier"
                                v-on:keyup="getDevices()"
                                clearable
                                class="search-bar"
                                @click:clear="clearFilter"
                            ></v-text-field>
                            <v-simple-table>
                                <template v-slot:default>
                                    <thead>
                                        <tr>
                                            <th class="text-left">Identifier</th>
                                            <th class="text-left">Alias</th>
                                            <th class="text-left">Type</th>
                                            <th class="text-left">Technology</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="device in paginator.data" :key="device.id">
                                            <td><router-link :to="'/device/'+device.id">{{ device.identifier }}</router-link></td>
                                            <td>{{ device.alias }}</td>
                                            <td>{{ device.device_type }}</td>
                                            <td>{{ device.technology_type }}</td>
                                        </tr>
                                    </tbody>
                                </template>
                            </v-simple-table>
                            <pagination class="paginator" :data="paginator" @pagination-change-page="getDevices"></pagination>
                        </div>
                    </div>

                </div>
            </div>
            <v-fab-transition>
                <router-link to="/device/new-device">
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
                paginator: {},
                filter: '',
                fab: false
            }
        },
        methods:{
            getDevices(page = 1) {
                axios.get('/organization/' + this.$organization.id + '/devices?page=' + page + '&filter=' + this.filter).then(r => {
                    var response = r.data;
                    this.paginator = response;
                })
                .catch(error => {this.$handleRequestError(error)});
            },
            clearFilter(){
                Vue.nextTick(()=>{this.filter='';this.getDevices();});
            }
        },
        mounted() {
            this.getDevices();
        }
    }
</script>