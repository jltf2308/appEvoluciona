<template>
    <div class="content sm">
        <div class="container">
        <div class="row">
            <div class="col-6">
                <h3>Agregar Profesional</h3>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-12">
                <div>
                    <ul class="steps sm">
                        <li v-for="(tab, index) in tabs" :key="index" :class="{ active: isActive(index) }">
                            <a>{{tab}}</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div v-if="activeItem == 0" class="col-12 tab-pane fade" :class="{ 'active show': isActive(0) }" id="0">
                <div class="caja sm mb-15 especial">
                    <h2 class="inline-b mr-15">Proporciona los datos del Profesional</h2> 
                    <div class="form-group" :class="{'error':invalid.business_name}">
                        <label for="business_name">Nombre de la empresa*:</label>
                        <input type="text" name="business_name" class="form-control" id="business_name" placeholder="Nombre de la empresa" v-model="companyData.business_name">
                        <p class="message" v-for="(e_business_name, index) in errors.business_name" :key="index">{{e_business_name}}</p>
                    </div>
                    <div class="form-group" :class="{'error':invalid.register_number}">
                        <label for="register_number">Número fiscal*: </label>
                        <input type="text" name="register_number" class="form-control" id="register_number" placeholder="Número fiscal" style="text-transform:uppercase;" v-model="companyData.register_number">
                        <p class="message" v-for="(e_register_number, index) in errors.register_number" :key="index">{{e_register_number}}</p>
                    </div>
                </div>
            </div>
            
            <div v-if="activeItem == 1" class="col-12 tab-pane fade" :class="{ 'active show': isActive(1) }" id="1">
                <div class="caja mb-30">
                    <h3 class="inline-b mr-15">Datos del profesional</h3>
                    <p><span class="bold">Razón social de la empresa: </span><br> {{ companyData.business_name}} </p>
                    <p><span class="bold">Número fiscal: </span><br> {{ companyData.register_number }} </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-4 col-lg-6">
                <router-link :to="{name:'clientes'}" class="button secondary sm-block">
                    Cancelar
                </router-link>
            </div>
            <div class="col-12 col-md-8 col-lg-6 text-end hidden-md-down">
                <button v-if="activeItem > 0" type="button" class="button secondary mr-15" @click.prevent="setActive(parseInt(activeItem) - parseInt(1))">
                    Anterior <i class="ri-arrow-left-s-line"></i>
                </button>
                <button v-if="activeItem < 1" type="button" class="button main" @click.prevent="setActive(parseInt(activeItem) + parseInt(1))">Siguiente <i class="ri-arrow-right-s-line"></i></button>
                <button v-if="activeItem == 1" type="button" class="button main" @click.prevent="save()">{{ processing ? "Espere" : "Guardar" }} <i class="ri-arrow-right-s-line"></i></button>
            </div>
        </div>
    </div>
    </div>

</template>
<script>
    import router from '@/router';
    import axios from 'axios';
    export default {
        data() {
            return {
                tabs:{
                    0: 'Datos de la empresa',
                    1: 'Persona de contacto',
                    2: 'Resumen',
                },
                activeItem: 0,
                companyData:{},
                personData:{},
                invalid:{
                    business_name:0,
                    register_number:0,
                    name:0,
                    lastName:0,
                    identity:0,
                    email:0,
                },
                errors:{},
                processing:false
            }
        },
        methods: {
            isActive (menuItem) {
                return this.activeItem == menuItem
            },
            setActive (menuItem) {
                this.reiniciaMensajesError();
                if(menuItem > this.activeItem){                    
                    this.validarCampos(this.activeItem, menuItem);
                }else{
                    this.activeItem = menuItem;
                }                             
            },
            reiniciaMensajesError(){
                this.errors = {}
                for(let inval in this.invalid) {
                    this.invalid[inval]=0;
                }
            },
            validarCampos(active, next){                
                if(active === 0){
                    let business_name_field = false
                    let register_number_field = false
                    if(!this.companyData.hasOwnProperty('business_name') || this.companyData.business_name == ''){
                        this.errors.business_name = ['El campo Nombre de la empresa es requerido']
                        business_name_field = false
                    }else{
                        business_name_field = true
                    }
                    if(!this.companyData.hasOwnProperty('register_number') || this.companyData.register_number == ''){
                        this.errors.register_number = ['El campo Número fiscal  es requerido']
                        register_number_field = false
                    }else{
                        register_number_field = true
                    }
                    if(business_name_field && register_number_field){
                        this.activeItem = next
                    }
                    this.mostrarErrores();
                }
                // else if(active === 1){
                //     let name_field = false;
                //     let lastName_field = false;
                //     let identity_field = false;
                //     let email_field = false;
                //     if(!this.personData.hasOwnProperty('name') || this.personData.name == ''){
                //         this.errors.business_name = ['El campo Nombre es requerido']
                //         name_field = false
                //     }else{
                //         name_field = true
                //     }
                //     if(!this.personData.hasOwnProperty('lastName') || this.personData.lastName == ''){
                //         this.errors.register_number = ['El campo Apellido es requerido']
                //         lastName_field = false
                //     }else{
                //         lastName_field = true
                //     }
                //     if(!this.personData.hasOwnProperty('identity') || this.personData.identity == ''){
                //         this.errors.register_number = ['El campo Identificación Fiscal es requerido']
                //         identity_field = false
                //     }else{
                //         identity_field = true
                //     }
                //     if(!this.personData.hasOwnProperty('email') || this.personData.email == ''){
                //         this.errors.register_number = ['El campo Correo Electrónico es requerido']
                //         email_field = false
                //     }else{
                //         email_field = true
                //     }

                //     if(name_field && lastName_field && identity_field && email_field){
                //         this.activeItem = next
                //     }
                //     this.mostrarErrores();
                // }
            },
            mostrarErrores(){
                for(let error in this.errors) {
                    console.log('error', error)
                    switch(error){
                        case 'business_name':
                            this.invalid.business_name = 1;
                            break;
                        case 'register_number':
                            this.invalid.register_number = 1;
                            break;
                    }
                }
            },
            async save(){
                this.processing = true
                // let data = {};
                // data.companyData = this.companyData;
                // data.personData = this.personData;
                await axios.get('/sanctum/csrf-cookie')
                await axios.post('/api/company',this.companyData).then(({data})=>{
                    this.$router.push({name:'clientes'})
                }).catch(({response})=>{
                    if(response.status===422){
                        this.validationErrors = response.data.errors
                    }else{
                        this.validationErrors = {}
                        alert(response.data.message)
                    }
                }).finally(()=>{
                    this.processing = false
                })
            }
        },
    }
</script>