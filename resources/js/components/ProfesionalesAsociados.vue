<template>
    <div class="container">
        <div class="row">
            <div class="col-6">
                <h3>Profesionales Asociados al cliente: {{companyName}}</h3>
            </div>
            <div class="col-6 text-end align-middle">
                <router-link :to="{
                        name:'asociarProfesionalesForm',
                        params:{ companyId:companyId }
                    }" class="btn btn-primary">
                    Asociar Nuevo Profesional
                </router-link>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-12">
                <table class="table table-borderless table-responsive card-1 p-4 table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center" v-for="(value, name) in header" :key="name">{{value}}</th>
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
                                <template  v-if="buttons.length > 0">
                                    <td class="text-center align-middle p-1">
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
                                                    <router-link 
                                                        :to="{ 
                                                            name:nameButton.name, 
                                                            params:{
                                                                companyId:body[index].id,
                                                                companyName:body[index].business_name
                                                            }
                                                        }" 
                                                        :title="nameButton.title"
                                                        :class="nameButton.classStyle"
                                                        class="btn btn-sm"
                                                        data-bs-toggle="tooltip" 
                                                        data-bs-placement="bottom">
                                                        <i class="material-icons text-white">{{nameButton.icon}}</i>
                                                    </router-link>

                                                </template>
                                            </template>
                                        </div>
                                    </td>
                                </template>
                            </tr>  
                        </template>                      
                    </tbody>
                </table>
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
    name:"profesionalesAsociados",
    props:{
        companyId: {
            required: true,
        },
        companyName: {
            type:String,
            required: true,
        },
    },
    components:{
        TableComponent
    },
    data(){
        return {
            
            header:{
                0:'#',
                1:'Número registro fiscal',
                2:'Nombre y Apellido',
                3:'Correo Electrónico',
                4:'Cargo',
                5:'Fecha Inicio',
                6:'Fecha Fin'
            },
            body:[],
            processing:false,
            buttons:[
            ],
        }
    },
    methods:{
        async getPeople(){
            try {
                await axios.get('/sanctum/csrf-cookie');
                const res= await axios.get('/api/professional/'+this.companyId)
                this.body = res.data.people
            } catch ({ response: { data: data_1 } }) {
                console.log(response)
            }
        },
    },
    mounted(){
        // this.companyId = this.$route.params.companyId
        this.getPeople();
        // console.log(this.companyId)

    }
}
</script>