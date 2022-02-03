<template>

    <div class="container mt-1">
        <div class="card">
            <div class="card-header">
                Types
            </div>
            <div class="card-body">
                <div>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Add" v-model="form.type" ref="type">
                        <div class="input-group-append">
                            <button class="btn btn-success" type="submit" @click="addItem()"><i class="fa fa-arrow-right"></i></button>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="d-flex" v-for="type in types" :key="type.id">
                        <div class="flex-grow-1">{{type.type}}</div>
                        <div class="">
                            <button class="btn btn-sm fa fa-trash text-danger" @click="delItem($event)" :value="type.id"></button>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        
        mounted(){
            this.getTypes();

        },
        data(){
            return {
                types: [],
                form: {type: ''}
            }

        },
        methods: {

            getTypes(){

                axios.get('type/list')
                    .then((response) => {
                        this.types = response.data;
                        this.eventHub.$emit('getTypeList',this.types);

                    })
            },
              delItem(event){

                let val = event.target.value;
                axios.delete('type/'+val)
                    .then((response) => {
                        this.getTypes();
                    })

            },

            addItem(){
                axios.post('type',this.form)
                    .then((response) => {
                        this.getTypes(); 


                        this.form.type = '';


                    })
            }




        }


    }
</script>