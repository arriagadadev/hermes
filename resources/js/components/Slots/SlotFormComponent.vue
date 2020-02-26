<template>
    <main>
        <v-card>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="bgc-white bdrs-3 p-20">
                            <h4 v-if="create" class="c-grey-900"><router-link to="/devices" >Devices</router-link>/<router-link :to="'/device/' + $route.params.device" ><span v-text="$route.params.device"></span></router-link>/New slot</h4>
                            <h4 v-else class="c-grey-900"><router-link to="/devices" >Devices</router-link>/<router-link :to="'/device/' + $route.params.device"><span v-text="$route.params.device"></span></router-link>/slot/<router-link :to="'/device/' + $route.params.device + '/slot/' + $route.params.slot" ><span v-text="$route.params.slot"></span></router-link>/edit</h4>
                            <v-form
                                ref="form"
                                v-model="valid"
                                lazy-validation
                            >
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-2 form-group">
                                            <v-text-field
                                                v-model="slot.alias"
                                                label="Slot alias"
                                                :rules="[rules.required]"
                                            ></v-text-field>
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <v-text-field
                                                v-model="slot.parameter_name"
                                                label="Parameter name"
                                                :rules="[rules.required, rules.jsonKey]"
                                            ></v-text-field>
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <v-text-field
                                                v-model="slot.title"
                                                label="Title"
                                                :rules="[rules.required]"
                                            ></v-text-field>
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <v-select
                                                :items="variables"
                                                item-text="name"
                                                item-value="id"
                                                label="Variable"
                                                v-model="slot.variable_id"
                                                :rules="[rules.required]"
                                            ></v-select>
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <v-select
                                                :items="unitsOfMeasurement"
                                                item-text="name"
                                                item-value="id"
                                                label="Unit of measurement"
                                                v-model="slot.unit_of_measurement_id"
                                                :rules="[rules.required]"
                                            ></v-select>
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <v-select
                                                :items="displayModes"
                                                item-text="name"
                                                item-value="id"
                                                label="Display mode"
                                                v-model="slot.display_mode_id"
                                                :rules="[rules.required]"
                                            ></v-select>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 form-group">
                                            <v-color-picker v-model="slot.color"></v-color-picker>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-1 form-group">
                                            <v-switch
                                                v-model="slot.active"
                                                color="#00c7ff"
                                                :label="slot.active ? 'Active': 'Inactive'"
                                            ></v-switch>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 text-left">
                                            <v-btn class="mr-4" @click="submit()">Save</v-btn>
                                        </div>
                                        <div class="col-6 text-right">
                                            <router-link v-if="!create" :to="'/device/' + $route.params.device + '/slot/' + $route.params.slot + '/calibrator'">
                                                <v-btn class="mr-4">Calibrator</v-btn>
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
                slot: {
                    id: 0,
                    alias: '',
                    unit_of_measurement_id: '',
                    variable_id: '',
                    display_mode_id: '',
                    title: '',
                    color: '#336699',
                    active: true,
                    parameter_name: ''
                },
                valid: true,
                create: true,
                displayModes: [],
                variables: [],
                unitsOfMeasurement: []
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
                axios.post('/organization/' + this.$organization.slug + '/device/' + this.$route.params.device + '/slot', {
                    slot: this.slot
                })
                .then(r => {
                    this.slot = r.data.slot;
                    this.$notification.success("The slot has been created successfully", {timer: 3});
                    setTimeout(()=>{this.$router.push('/device/' + this.$route.params.device + '/slot/' + this.slot.parameter_name + '/edit');this.create=false;}, 1000);
                })
                .catch(error => {this.$handleRequestError(error)});
            },
            updateDevice(){
                axios.put('/organization/' + this.$organization.slug + '/device/' + this.$route.params.device + '/slot', {
                    slot: this.slot
                })
                .then(r => {
                    this.slot = r.data.slot;
                    this.$notification.success("The slot has been updated successfully", {timer: 3});
                    if(this.slot.parameter_name != this.$route.params.slot){
                        setTimeout(()=>{this.$router.push('/device/' + this.$route.params.device + '/slot/' + this.slot.parameter_name + '/edit');this.create=false;}, 1000);
                    }
                })
                .catch(error => {this.$handleRequestError(error)});
            },
            getSlot(route){
                axios.get('/organization/' + this.$organization.slug + '/device/' + route.params.device + '/slot/' + route.params.slot).then(r => {
                    var response = r.data;
                    this.slot = response.slot;
                })
                .catch(error => {this.$handleRequestError(error)});
            },
            getVariables() {
                axios.get('/variables').then(r => {
                    var response = r.data;
                    this.variables = response.variables;
                })
                .catch(error => {this.$handleRequestError(error)});
            },
            getDisplayModes() {
                axios.get('/display-modes').then(r => {
                    var response = r.data;
                    this.displayModes = response.displayModes;
                })
                .catch(error => {this.$handleRequestError(error)});
            },
            activateEditMode(route){
                this.create = false;
                this.getSlot(route);
            },
            setMode(route){
                if(route.name != "new-slot"){
                    this.activateEditMode(route);
                }else{
                    this.create = true;
                    this.clearForm();
                }
            },
            clearForm(){
                this.$refs.form.resetValidation();
                this.slot.id = 0;
                this.slot.alias = '';
                this.slot.unit_of_measurement_id = '';
                this.slot.display_mode_id = '';
                this.slot.variable_id = '';
                this.slot.title = '';
                this.slot.color = '#336699';
                this.slot.parameter_name = '';
                this.slot.active = true;
            },
            updateUnitOfMeasurementList(variable){
                this.unitsOfMeasurement = variable.units_of_measurement;
                console.log(variable);
            }
        },
        mounted() {
            this.getVariables();
            this.getDisplayModes();
            this.setMode(this.$route);
        },
        watch: {
            $route(to, from) {
              this.setMode(to);
            },
            'slot.variable_id': function(to, from) {
                let selectedVariable = this.variables.find((variable)=> {return variable.id == to});
                if(selectedVariable){
                    this.unitsOfMeasurement = selectedVariable.units_of_measurement;
                    this.slot.unit_of_measurement_id = this.unitsOfMeasurement[0] ? this.unitsOfMeasurement[0].id : '';
                }
            }
        }
    }
</script>