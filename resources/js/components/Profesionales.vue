<template>
    <div class="container">
        <div class="row">
            <div class="col-6">
                <h3>Profesionales</h3>
            </div>
            <div class="col-6 text-end align-middle">
                <router-link :to="{name:'profesionalForm'}" class="btn btn-primary">
                    Agregar Nuevo Profesional
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
    name:"profesionales",
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
                4:'Cargo'
            },
            body:[],
            processing:false,
            buttons:[
                
            ]
        }
    },
    methods:{
        async getPeople(){
            try {
                await axios.get('/sanctum/csrf-cookie');
                const res= await axios.get('/api/person')
                this.body = res.data.people
            } catch ({ response: { data: data_1 } }) {
                console.log(response)
            }
        },
    },
    mounted(){
        this.getPeople();
    }
}
</script>