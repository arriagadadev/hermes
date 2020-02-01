<template>
    <div>
        <h6 class="c-grey-900">Change your password</h6>
        <div class="mT-30">
            <v-form
            ref="form"
            v-model="valid"
            lazy-validation
            >
                <div class="form-group">
                    <v-text-field
                        v-model="password"
                        :append-icon="showPassword ? 'visibility' : 'visibility_off'"
                        :rules="passwordRules"
                        :type="showPassword ? 'text' : 'password'"
                        label="Password"
                        hint="At least 8 characters"
                        counter
                        @click:append="showPassword = !showPassword"
                    ></v-text-field>
                </div>
                <div class="form-group">
                    <v-text-field
                        v-model="passwordConfirmation"
                        :append-icon="showPasswordConfirmation ? 'visibility' : 'visibility_off'"
                        :rules="passwordConfirmationRules"
                        :type="showPasswordConfirmation ? 'text' : 'password'"
                        label="Password confirmation"
                        hint="At least 8 characters"
                        counter
                        @click:append="showPasswordConfirmation = !showPasswordConfirmation"
                    ></v-text-field>
                </div>
                <v-btn class="mr-4" @click="submit()">Save</v-btn>
            </v-form>
        </div>
    </div>
</template>

<script>
    export default {
        data: (vm) => ({
            valid: true,
            password: '',
            passwordConfirmation: '',
            showPassword: false,
            showPasswordConfirmation: false,
            passwordRules: [
                v => !!v || 'Password is required',
                v => v.length >= 8 || 'Min 8 characters'
            ],
            passwordConfirmationRules: [
                v => !!v || 'Password confirmation is required',
                v => v.length >= 8 || 'Min 8 characters',
                v => v == vm.password || 'Passwords do not match'
            ]
        }),

        methods: {
            submit() {
                if(!this.$refs.form.validate()){
                    return;
                }
                axios.put('/change-password', {
                    password: this.password,
                    password_confirmation: this.passwordConfirmation
                })
                .then(r => {
                    this.password = "";
                    this.passwordConfirmation = "";
                    this.$refs.form.resetValidation();
                    this.$notification.success("Your information has been updated successfully", {timer: 3});
                })
                .catch(error => {this.$handleRequestError(error)});
            }
        }
    }
</script>