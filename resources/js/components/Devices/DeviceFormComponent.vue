<template>
    <main>
        <v-card>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="bgc-white bdrs-3 p-20">
                            <h4 v-if="create" class="c-grey-900"><router-link to="/devices" >Devices</router-link>/New device</h4>
                            <h4 v-else class="c-grey-900"><router-link to="/devices" >Devices</router-link>/<router-link :to="'/device/' + device.id" ><span v-text="device.identifier"></span></router-link>/edit</h4>
                            <v-form
                                ref="form"
                                v-model="valid"
                                lazy-validation
                            >
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-3 form-group">
                                            <v-text-field
                                                v-model="device.identifier"
                                                label="Identifier"
                                                :rules="[rules.required]"
                                            ></v-text-field>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <v-text-field
                                                v-model="device.alias"
                                                label="Device alias"
                                                :rules="[rules.required]"
                                            ></v-text-field>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <v-select
                                                :items="deviceTypes"
                                                item-text="name"
                                                item-value="id"
                                                label="Device type"
                                                v-model="device.device_type_id"
                                                :rules="[rules.required]"
                                            ></v-select>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <v-select
                                                :items="technologyTypes"
                                                item-text="name"
                                                item-value="id"
                                                label="Technology type"
                                                v-model="device.technology_type_id"
                                                :rules="[rules.required]"
                                            ></v-select>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <v-text-field
                                                v-model="device.scope"
                                                label="Scope"
                                                :rules="[rules.integer]"
                                            ></v-text-field>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <v-text-field
                                                v-model="device.latitude"
                                                label="Latitude"
                                                :rules="[rules.realNumber, rules.latitude]"
                                            ></v-text-field>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <v-text-field
                                                v-model="device.longitude"
                                                label="Longitude"
                                                :rules="[rules.realNumber,rules.longitude]"
                                            ></v-text-field>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <v-text-field
                                                v-model="device.altitude"
                                                label="Altitude"
                                                :rules="[rules.realNumber]"
                                            ></v-text-field>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <v-switch
                                                v-model="device.active"
                                                color="#00c7ff"
                                                :label="device.active ? 'Active': 'Inactive'"
                                            ></v-switch>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <v-switch
                                                v-model="device.has_gps"
                                                color="#00c7ff"
                                                :label="device.has_gps ? 'Has GPS': 'doesn\'t have GPS'"
                                            ></v-switch>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 text-left">
                                            <v-btn class="mr-4" @click="submit()">Save</v-btn>
                                        </div>
                                        <div class="col-6 text-right">
                                            <router-link v-if="!create" :to="'/device/' + device.id + '/slots'">
                                                <v-btn class="mr-4">Slots</v-btn>
                                            </router-link>
                                        </div>
                                    </div>
                                </div>
                            </v-form>
                        </div>
                    </div>

                </div>
            </div>
        </v-card>
    </main>
</template>

<script>
    import validator from '../Mixins/Validator';
    export default {
        mixins: [validator],
        data (vm){
            return {
                device: {
                    id: 0,
                    identifier: '',
                    alias: '',
                    device_type_id: 0,
                    technology_type_id: 0,
                    scope: 0,
                    latitude: '',
                    longitude: '',
                    altitude: '',
                    active: true,
                    has_gps: false,
                    organization_id: vm.$organization.id
                },
                valid: true,
                create: true,
                deviceTypes: [],
                technologyTypes: []
            }
        },
        methods:{
            submit(){
                if(this.$refs.form.validate()){
                    if(this.create){
                        this.storeDevice();
                    }else{
                        this.updateDevice();
                    }
                }

            },
            storeDevice(){
                axios.post('/device', {
                    device: this.device
                })
                .then(r => {
                    this.device = r.data.device;
                    this.$notification.success("The device has been created successfully", {timer: 3});
                    setTimeout(()=>{this.$router.push('/device/' + this.device.id + '/edit');this.create=false;}, 1000);
                })
                .catch(error => {this.$handleRequestError(error)});
            },
            updateDevice(){
                axios.put('/device', {
                    device: this.device
                })
                .then(r => {
                    this.device = r.data.device;
                    this.$notification.success("The device has been updated successfully", {timer: 3});
                })
                .catch(error => {this.$handleRequestError(error)});
            },
            getDevice(route){
                axios.get('/device/' + route.params.id).then(r => {
                    var response = r.data;
                    this.device = response.device;
                })
                .catch(error => {this.$handleRequestError(error)});
            },
            getDeviceTypes() {
                axios.get('/device-types').then(r => {
                    var response = r.data;
                    this.deviceTypes = response.deviceTypes;
                })
                .catch(error => {this.$handleRequestError(error)});
            },
            getTechnologyTypes() {
                axios.get('/technology-types').then(r => {
                    var response = r.data;
                    this.technologyTypes = response.technologyTypes;
                })
                .catch(error => {this.$handleRequestError(error)});
            },
            activateEditMode(route){
                this.create = false;
                this.getDevice(route);
            },
            setMode(route){
                if(route.name != "new-device"){
                    this.activateEditMode(route);
                }else{
                    this.create = true;
                    this.clearForm();
                }
            },
            clearForm(){
                this.$refs.form.resetValidation();
                this.device.id = 0;
                this.device.identifier = '';
                this.device.alias = '';
                this.device.device_type_id = 0;
                this.device.technology_type_id = 0;
                this.device.scope = 0;
                this.device.latitude = '';
                this.device.longitude = '';
                this.device.altitude = '';
                this.device.active = true;
                this.device.has_gps = false;
                this.organization_id = this.$organization.id;
            }
        },
        mounted() {
            this.getDeviceTypes();
            this.getTechnologyTypes();
            this.setMode(this.$route);
        },
        watch: {
            $route(to, from) {
              this.setMode(to);
            }
        }
    }
</script>