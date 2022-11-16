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
            <TableComponent :header="header" :body="body" :buttons="buttons"></TableComponent>
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
            },
            body:[],
            processing:false,
            buttons:[
                // {
                //     color:"btn-info",
                //     toolTip:"Ver Profesionales Asociados",
                //     icon:"group_add",
                // }
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