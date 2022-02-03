<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <manufacturer-component></manufacturer-component>
            <type-component></type-component>
            <color-component></color-component>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Car Maker</div>

                <div class="card-body">

                     <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Select Car</label>

                            <div class="col-md-6">
                                <select class="form-control" @change="getCar($event)">
                                    <option value=""></option>
                                    <option v-for="car in carsData" :key="car.id" :value="car.id">{{car.car_name}}</option>
                                   
                                </select>
                            </div>
                        </div>

                    <form @submit="onSubmit" ref="carForm">
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Car Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" v-model="form.name">
                            </div>
                        </div>
                         <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Manufacturer</label>

                            <div class="col-md-6">
                                <select class="form-control" v-model="form.manufacturer">
                                    <option value="">[Select]</option>
                                    <option v-for="manuf in manufData" :key="manuf.id" :value="manuf.id">{{manuf.manufacturer}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Type</label>

                            <div class="col-md-6">
                                <select v-model="form.type" class="form-control">
                                    <option value="">[Select]</option>
                                    <option v-for="type in typeData" :key="type.id" :value="type.id">{{type.type}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Color</label>

                            <div class="col-md-6">
                                <select v-model="form.color" class="form-control">
                                    <option value="">[Select]</option>
                                    <option v-for="color in colorData" :key="color.id" :value="color.id">{{color.color}}</option>
                                </select>
                            </div>
                        </div>


                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    import eventHub from '../event-bus.js';

    export default {
        mounted(){
            this.getCars();
            this.eventHub.$on('getManuf',data => {
                this.manufData = data;
            });
            this.eventHub.$on('getTypeList',data => {
                this.typeData = data;
            });
            this.eventHub.$on('getColorsList',data => {
                this.colorData = data;
            });
        },

        data() {
            return {
                carsData: [],
                manufData: [],
                typeData: [],
                colorData: [],
                form: {
                    name: '',
                    manufacturer: '',
                    type: '',
                    color: ''
                },
            }
        },
        methods: {

            onSubmit(e){
                e.preventDefault();
                
                axios.post('carmaker',this.form)
                    .then((response) => {
                        // this.getCars();
                        this.$refs.carForm.reset();
                    })



            },

            getCars(){

                axios.get('carmaker/list')
                    .then((response) => {

                        this.carsData = response.data;

                    })


            },

            getCar(event){

                let id =  event.target.value;

                axios.get('carmaker/'+ id)
                    .then((response) => {

                        let car = response.data.car;

                        this.form.name = car.car_name;
                        this.form.manufacturer = car.manufacturer;
                        this.form.type = car.type;
                        this.form.color = car.color;
                    })

            },
          
        }
        
    }
</script>