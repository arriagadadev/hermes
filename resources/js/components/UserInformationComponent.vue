<template>
    <div>
        <h6 class="c-grey-900">Change your basic information</h6>
        <div class="mT-30">
            <v-form
            ref="form"
            v-model="valid"
            lazy-validation
            >
                <div class="form-group">
                    <v-text-field
                        v-model="email"
                        label="E-mail address"
                        disabled
                    ></v-text-field>
                    <small id="emailHelp" class="form-text text-muted">You can't change this information.</small>
                </div>
                <div class="form-group">
                    <v-text-field
                        v-model="name"
                        :rules="nameRules"
                        label="Name"
                        required
                    ></v-text-field>
                </div>
                <v-btn class="mr-4" @click="submit()">Save</v-btn>
            </v-form>
        </div>
    </div>
</template>

<script>
    export default {
        data: () => ({
            valid: true,
            email: '',
            name: '',
            nameRules: [
                v => !!v || 'Name is required',
            ]
        }),

        methods: {
            submit() {
                if(!this.$refs.form.validate()){
                    return;
                }
                axios.put('/user', {
                    name: this.name
                })
                .then(r => {
                    this.$notification.success("Your information has been updated successfully", {timer: 3});
                })
                .catch(error => {this.$handleRequestError(error)});
            },
            getUserInformation() {
                axios.get('/user').then(r => {
                    var response = r.data;
                    this.email = response.email;
                    this.name = response.name;
                })
                .catch(error => {this.$handleRequestError(error)});
            }
        },

        mounted() {
            this.getUserInformation();
        }
    }
</script>