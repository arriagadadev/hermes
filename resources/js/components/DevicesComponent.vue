<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="bgc-white bd bdrs-3 p-20">
                    <h4 class="c-grey-900 mB-20">Devices</h4>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Identifier</th>
                                <th scope="col">Alias</th>
                                <th scope="col">Device type</th>
                                <th scope="col">Technology type</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data (){
            return {
                deviceTypes: [],
                technologyTypes: [],
                devices: [],
                variables: [],
                displayModes: [],
                unitsOfMeasurement: [],
                icons: [],
                functionTypes: []

            }
        },
        mounted() {
            console.log('Devices component mounted.')
        }
    }
</script>