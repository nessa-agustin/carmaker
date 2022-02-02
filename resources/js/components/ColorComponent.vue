<template>

    <div class="container">
        <div>
            <div class="d-flex" v-for="color in colors" :key="color.id">
                <div class="flex-grow-1">{{color.color}}</div>
                <div class="">
                    <button class="btn btn-sm fa fa-trash text-danger" @click="delItem($event)" :value="color.id"></button>
                </div>
            </div>
        </div>
        <div>
            <div class="input-group mt-3">
                <input type="text" class="form-control" placeholder="Add" v-model="form.color" ref="color">
                <div class="input-group-append">
                    <button class="btn btn-success" type="submit" @click="addItem()">Submit</button>
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
                        this.types = response.data;
                        this.eventHub.$emit('getColors',this.colors);

                    })
            }




        }


    }
</script>