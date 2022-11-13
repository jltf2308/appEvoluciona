<template>
    <div class="container">
        <div class="row">
            <div class="col-6">
                <h3>Clientes</h3>
            </div>
            <div class="col-6 text-end align-middle">
                <router-link :to="{name:'clientesForm'}" class="btn btn-primary">
                    Agregar Nuevo Cliente
                </router-link>
            </div>
        </div>
        <br>
        <div class="row">
            <TableComponent :header="header" :body="body" :buttons="buttons"></TableComponent>
        </div>
    </div>
</template>

<script>
import TableComponent from './common/tableComponent.vue';
export default {
    name:"Clientes",
    components:{
        TableComponent
    },
    data(){
        return {
            header:{
                0:'#',
                1:'Número registro fiscal',
                2:'Nombre empresa',
            },
            body:[],
            processing:false,
            
            buttons:[
                {
                    routeParams:{
                        haveParams:true,
                        name:"profesionalesAsociados",
                        params:[
                            "companyId",
                            "companyName",
                        ],
                    },
                    classStyle:"btn-danger",
                    icon:"group_add",
                    title:"Ver Profesionales Asociados",
                }
            ]
        }
    },
    methods:{
        async getCompanies(){
            try {
                await axios.get('/sanctum/csrf-cookie');
                const res= await axios.get('/api/company')
                this.body = res.data.companies
            } catch ({ response: { data: data_1 } }) {
                console.log(response)
            }
        },
    },
    mounted(){
        this.getCompanies();
    }
}
</script>