<template>
    <div class="container">
        <div class="row">
            <div class="col-2">
                <h3>Usuarios</h3>
            </div>
            <div class="col-10 text-end align-middle">
                <router-link :to="{name:'userForm'}" class="btn btn-primary">
                    Agregar Nuevo Usuario
                </router-link>
            </div>
        </div>
        <br>
        <div class="row">
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
                                    <tr v-for="(value, index) in body" :key="index">
                                        <td class="align-middle text-center">{{index+1}}</td>
                                        <template v-for="(val, ind) in value">
                                            <td class="align-middle" v-if="ind != 'id'">{{val}}</td>
                                        </template>
                                        <td class="text-center align-middle p-1" v-if="buttons.length > 0">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <template v-for="(nameButton, i) in buttons" :key="i">
                                                    <template v-if="nameButton.type == 'button'">
                                                        <button
                                                            class="btn btn-sm"
                                                            :class="nameButton.classStyle"
                                                            data-bs-toggle="tooltip" 
                                                            data-bs-placement="bottom"
                                                            :title="nameButton.title"
                                                            @click="handle_function_call(nameButton.action, body[index].id)"
                                                        >
                                                            <i class="material-icons text-white">{{nameButton.icon}}</i>
                                                        </button>
                                                    </template>
                                                    <template v-if="nameButton.type == 'routeButton'">
                                                    </template>
                                                    <!-- <routerComponent
                                                        :routeParams="nameButton.routeParams"
                                                        :classStyle="nameButton.classStyle"
                                                        :title="nameButton.title"
                                                        :icon="nameButton.icon"
                                                        :paramId="value.id"
                                                        :paramName="value.business_name"
                                                    ></routerComponent> -->
                                                    
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
        </div>
        <div class="row">
            <div class="col-12 align-middle">
                <router-link :to="{name:'clientes'}" class="btn btn-secondary">
                    Atras
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
    import TableComponent from './common/tableComponent.vue';
    export default {
        name:"Usuarios",
        components:{
            TableComponent
        },
        props:['companyId'],
        data(){
            return {
                header:{
                    0:'#',
                    1:'Email',
                    2:'Empresa',
                    3:'Tipo de usuario',
                },
                body:[],
                processing:false,
                
                buttons:[
                    {
                        type:'routeButton',
                        routeParams:{
                            haveParams:true,
                            name:"userForm",
                            params:[
                                "userId",
                            ],
                        },
                        classStyle:"btn-info",
                        icon:"edit",
                        title:"Editar Usuario",
                    },
                    {
                        type:'button',
                        classStyle:"btn-danger",
                        icon:"delete",
                        title:"Eliminar Usuario",
                        action:"deleteUser"
                    },
                    
                ]
            }
        },
        methods:{
            async getUsers(){
                try {
                    await axios.get('/sanctum/csrf-cookie');
                    const res= await axios.get('/api/company/'+ this.companyId +'/users')
                    this.body = res.data.users.map((value)=>{
                        return {
                            id:value.id,
                            email:value.email,
                            company:value.person.company.business_name,
                            type:value.person.type,
                        };
                    });
                } catch ({ response: { data: data_1 } }) {
                    console.log(response)
                }
            },
            deleteUser(value){
                console.log(value);
            },
            handle_function_call(function_name, value) {
                this[function_name](value)
            },
        },
        mounted(){
            this.getUsers();
        }
    }
</script>