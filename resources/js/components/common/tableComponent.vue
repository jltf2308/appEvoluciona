<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <table class="table table-borderless table-responsive card-1 p-4 table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center" v-for="(value, name) in header" :key="name">{{value}}</th>
                            <th class="text-center w-25">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template v-if="body.length == 0">
                            <tr>
                                <td align="center" :colspan="Object.keys(this.header).length +1"> No existen Registros</td>
                            </tr>
                        </template>
                        <template v-else>
                            <tr v-for="(value, name) in body" :key="name">
                                <td class="align-middle text-center">{{name+1}}</td>
                                <template v-for="(val, index) in value">
                                    <td class="align-middle" v-if="index != 'id' && index != 'type'">{{val}}</td>
                                </template>
                                <td class="text-center align-middle p-1">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-warning btn-sm">
                                            <i class="material-icons text-white">edit</i>
                                        </button>
                                        <button type="button" class="btn btn-info btn-sm">
                                            <i class="material-icons text-white">visibility</i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm">
                                            <i class="material-icons text-white">delete</i>
                                        </button>
                                    </div>
                                </td>
                            </tr>  
                        </template>                      
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name:"tableComponent",
        props:{
            header:{
                type:Object,
                required:true,
            },
            body:{
                type:Array,
                required:true
            }
        },
        data(){
            return {
                
            }
        },
        methods:{

        },
        mounted(){
            // console.log(Object.keys(this.header).length);
        }
    }
</script>