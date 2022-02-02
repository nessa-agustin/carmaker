<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div id="accordion">

                <div class="card">
                    <div class="card-header">
                        <a class="card-link" data-toggle="collapse" href="#manufacturer">Manufacturer</a>
                    </div>
                    <div id="manufacturer" class="collapse show" data-parent="#accordion">
                        <div class="card-body">
                            <type-component></type-component>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <a class="collapsed card-link" data-toggle="collapse" href="#type">Type</a>
                    </div>
                    <div id="type" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <type-component></type-component>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                    <a class="collapsed card-link" data-toggle="collapse" href="#color">Color</a>
                    </div>
                    <div id="color" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <color-component></color-component>
                        </div>
                    </div>
                </div>

            </div>
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
                                <!-- <input id="name" type="text" class="form-control" v-model="form.manufacturer"> -->
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
                                    <option value="1">Sedan</option>
                                    <option value="2">HatchBack</option>
                                    <option value="3">SUV</option>
                                    <option value="4">MPV</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Color</label>

                            <div class="col-md-6">
                                <select v-model="form.color" class="form-control">
                                    <option value="">[Select]</option>
                                    <option value="1">Black</option>
                                    <option value="2">White</option>
                                    <option value="3">Maroon</option>
                                    <option value="4">Blue</option>
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
        },

        data() {
            return {
                carsData: [],
                manufData: [],
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
                // console.log(id);

                axios.get('carmaker/'+ id)
                    .then((response) => {

                        let car = response.data.car;

                        this.form.name = car.car_name;
                        this.form.manufacturer = car.manufacturer;
                        this.form.type = car.type;
                        this.form.color = car.color;
                    })

            },
            // getMnfc(){

            //     EventBus.$on('getManuf',this.manufData)
            //     console.log(this.manufData)
            // }




        }
    }
</script>