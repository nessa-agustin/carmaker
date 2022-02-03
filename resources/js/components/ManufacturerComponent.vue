<template>

    <div class="container">
        <div class="card">
            <div class="card-header">
               Manufacturers
            </div>
            <div class="card-body">
                <div>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Add" v-model="form.manufacturer" ref="manuf">
                        <div class="input-group-append">
                            <button class="btn btn-success" type="submit" @click="addItem()"><i class="fa fa-arrow-right"></i></button>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="d-flex" v-for="manufacturer in manufacturers" :key="manufacturer.id">
                        <div class="flex-grow-1">{{manufacturer.manufacturer}}</div>
                        <div class="">
                            <button class="btn btn-sm fa fa-trash text-danger" @click="delItem($event)" :value="manufacturer.id"></button>
                            <!-- <i class="fa fa-trash text-danger"></i> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>

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

                if(this.form.manufacturer == ''){
                    alert("field required");
                }else{
                     axios.post('manufacturer',this.form)
                    .then((response) => {
                        this.getManufacturers(); //setup watch something

                        // this.$refs.manuf.reset();

                        this.form.manufacturer = '';


                    })
                }

               
            }
            
            

        }

        
    }
</script>
