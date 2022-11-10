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
            <TableComponent :header="header" :body="body"></TableComponent>
        </div>
    </div>
</template>

<script>
import TableComponent from './common/tableComponent.vue';
import { mapActions } from 'vuex'
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
            body:this.$store.state.company.companies.data,
            processing:false
        }
    },
    methods:{
        ...mapActions({
            getCompanies:'company/getCompanies'
        }),
    },
    created(){
        this.getCompanies();
    }
}
</script>