<template>

    <div class="container">
        <div>
            <div class="d-flex" v-for="manufacturer in manufacturers" :key="manufacturer.id">
                <div class="flex-grow-1">{{manufacturer.manufacturer}}</div>
                <div class="">
                    <button class="btn btn-sm fa fa-trash text-danger" @click="delItem($event)" :value="manufacturer.id"></button>
                    <!-- <i class="fa fa-trash text-danger"></i> -->
                </div>
            </div>
        </div>
        <div>
            <div class="input-group mt-3">
                <input type="text" class="form-control" placeholder="Add" v-model="form.manufacturer" ref="manuf">
                <div class="input-group-append">
                    <button class="btn btn-success fa fa-arrow-right" type="submit" @click="addItem()"></button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    // import EventBus from '../event-bus.js';

    export default {
        mounted() {
            this.getManufacturers();

        },
        data(){
            return {
                manufacturers: [],
                form: {manufacturer: ''}
            }
        },
        methods: {

            getManufacturers(){
                axios.get('manufacturer/list')
                    .then((response) => {

                        this.manufacturers = response.data;
                        this.eventHub.$emit('getManuf',this.manufacturers);
                    })


            },

            delItem(event){

                let val = event.target.value;
                axios.delete('manufacturer/'+val)
                    .then((response) => {
                        this.getManufacturers();
                    })

            },

            addItem(){
                axios.post('manufacturer',this.form)
                    .then((response) => {
                        this.getManufacturers(); //setup watch something

                        // this.$refs.manuf.reset();

                        this.form.manufacturer = '';


                    })
            }
            
            

        }

        
    }
</script>
