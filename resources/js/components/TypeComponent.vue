<template>

    <div class="container">
        <div>
            <div class="d-flex" v-for="type in types" :key="type.id">
                <div class="flex-grow-1">{{type.type}}</div>
                <div class="">
                    <button class="btn btn-sm fa fa-trash text-danger" @click="delItem($event)" :value="type.id"></button>
                </div>
            </div>
        </div>
        <div>
            <div class="input-group mt-3">
                <input type="text" class="form-control" placeholder="Add" v-model="form.type" ref="type">
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
                        this.eventHub.$emit('getTyp',this.types);

                    })
            }




        }


    }
</script>