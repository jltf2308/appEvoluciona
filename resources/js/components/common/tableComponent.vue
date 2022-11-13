<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <table class="table table-borderless table-responsive card-1 p-4 table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center" v-for="(value, name) in header" :key="name">{{value}}</th>
                            <th class="text-center w-25" v-if="buttons.length > 0">Acciones</th>
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
                                <td class="text-center align-middle p-1" v-if="buttons.length > 0">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <template v-for="(nameButton, name) in buttons" :key="name">
                                            <routerComponent
                                                :routeParams="nameButton.routeParams"
                                                :classStyle="nameButton.classStyle"
                                                :title="nameButton.title"
                                                :icon="nameButton.icon"
                                                :paramId="value.id"
                                                :paramName="value.business_name"
                                            ></routerComponent>
                                            <!-- <router-link 
                                                :to="{
                                                    name:nameButton.to, 
                                                    params:{ 
                                                        companyId:value.id,
                                                        companyName:value.bussinesName
                                                    },
                                                }" 
                                                :class="nameButton.color"
                                                :title="nameButton.toolTip"
                                                class="btn btn-sm" data-bs-toggle="tooltip"  data-bs-placement="bottom">
                                                <i class="material-icons text-white">{{nameButton.icon}}</i>
                                            </router-link> -->
                                            <!-- <button type="button" class="btn btn-sm" :class="value.color" data-bs-toggle="tooltip" data-bs-placement="bottom" :title="value.toolTip">
                                                <i class="material-icons text-white">{{value.icon}}</i>
                                            </button> -->
                                        </template>
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
    import routerComponent from './routerComponent.vue'
    export default {
        name:"tableComponent",
        components:{
            routerComponent
        },
        props:{
            header:{
                type:Object,
                required:true,
            },
            body:{
                type:Array,
                required:true
            },
            buttons:{
                type:Array,
                required:true,
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