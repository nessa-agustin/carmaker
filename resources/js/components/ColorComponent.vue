<template>

    <div class="container mt-1">
        <div class="card">
            <div class="card-header">
                Colors
            </div>
            <div class="card-body">
                <div>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Add" v-model="form.color" ref="color">
                        <div class="input-group-append">
                            <button class="btn btn-success" type="submit" @click="addItem()"><i class="fa fa-arrow-right"></i></button>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="d-flex" v-for="color in colors" :key="color.id">
                        <div class="flex-grow-1">{{color.color}}</div>
                        <div class="">
                            <button class="btn btn-sm fa fa-trash text-danger" @click="delItem($event)" :value="color.id"></button>
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
            this.getColors();

        },
        data(){
            return {
                colors: [],
                form: {color: ''}
            }

        },
        methods: {

            getColors(){

                axios.get('color/list')
                    .then((response) => {
                        this.colors = response.data;
                        this.eventHub.$emit('getColorsList',this.colors);

                    })
            },
              delItem(event){

                let val = event.target.value;
                axios.delete('color/'+val)
                    .then((response) => {
                        this.getColors();
                    })

            },

            addItem(){

                if(this.form.color == ''){
                    alert('Field required');
                }else{
                    axios.post('color',this.form)
                    .then((response) => {
                        this.getColors(); 


                        this.form.color = '';


                    })
                }

                
            }




        }


    }
</script>