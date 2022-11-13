<template>
    <div class="content sm">
        <div class="container">
        <div class="row">
            <div class="col-6">
                <h3>Asociar Profesionales</h3>
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
                    <h2 class="inline-b mr-15">Selecciona el/los profesional(es) que deseas asociar al cliente </h2>
                    <!-- first_name -->
                    <div class="form-group" :class="{'error':invalid.first_name}">
                        <label for="first_name">Nombre*:</label>
                        <input type="text" name="first_name" class="form-control" id="first_name" placeholder="Nombre" v-model="personData.first_name">
                        <p class="message" v-for="(e_first_name, index) in errors.first_name" :key="index">{{e_first_name}}</p>
                    </div>
                    <!-- last_name -->
                    <div class="form-group" :class="{'error':invalid.last_name}">
                        <label for="last_name">Apellido*:</label>
                        <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Apellido" v-model="personData.last_name">
                        <p class="message" v-for="(e_last_name, index) in errors.last_name" :key="index">{{e_last_name}}</p>
                    </div>
                    <!-- register_number -->
                    <div class="form-group" :class="{'error':invalid.register_number}">
                        <label for="register_number">Número de identificación*:</label>
                        <input type="text" name="register_number" class="form-control" id="register_number" placeholder="Número de identificación" v-model="personData.register_number">
                        <p class="message" v-for="(e_register_number, index) in errors.register_number" :key="index">{{e_register_number}}</p>
                    </div>
                    <!-- email -->
                    <div class="form-group" :class="{'error':invalid.email}">
                        <label for="email">Correo Electrónico*:</label>
                        <input type="text" name="email" class="form-control" id="email" placeholder="Correo Electrónico" v-model="personData.email">
                        <p class="message" v-for="(e_email, index) in errors.email" :key="index">{{e_email}}</p>
                    </div>
                    <!-- position -->
                    <div class="form-group" :class="{'error':invalid.position}">
                        <label for="position">Cargo*:</label>
                        <input type="text" name="position" class="form-control" id="position" placeholder="Cargo" v-model="personData.position">
                        <p class="message" v-for="(e_position, index) in errors.position" :key="index">{{e_position}}</p>
                    </div>
                    
                </div>
            </div>
            
            <div v-if="activeItem == 1" class="col-12 tab-pane fade" :class="{ 'active show': isActive(1) }" id="1">
                <div class="caja mb-30">
                    <h3 class="inline-b mr-15">Datos del profesional</h3>
                    <p><span class="bold">Nombre: </span><br> {{ personData.first_name }} </p>
                    <p><span class="bold">Apellido: </span><br> {{ personData.last_name }} </p>
                    <p><span class="bold">Número de identificación: </span><br> {{ personData.register_number }} </p>
                    <p><span class="bold">Correo Electrónico: </span><br> {{ personData.email }} </p>
                    <p><span class="bold">Cargo: </span><br> {{ personData.position }} </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-4 col-lg-6">
                <router-link :to="{name:'profesionales'}" class="button secondary sm-block">
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
    import axios from 'axios';
    export default {
        props:{
            companyId: {
                required: true,
            },
        },
        data() {
            return {
                tabs:{
                    0: 'Datos del profesional',
                    1: 'Resumen',
                },
                activeItem: 0,
                personData:{},
                invalid:{
                    first_name:0,
                    last_name:0,
                    register_number:0,
                    email:0,
                    position:0,
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
                    let first_name_field = false
                    let last_name_field = false
                    let register_number_field = false
                    let email_field = false
                    let position_field = false

                    // name
                    if(!this.personData.hasOwnProperty('first_name') || this.personData.first_name == ''){
                        this.errors.first_name = ['El campo Nombre es requerido']
                        first_name_field = false
                    }else{
                        first_name_field = true
                    }

                    // last_name
                    if(!this.personData.hasOwnProperty('last_name') || this.personData.last_name == ''){
                        this.errors.last_name = ['El campo Apellido requerido']
                        last_name_field = false
                    }else{
                        last_name_field = true
                    }

                    // register_number
                    if(!this.personData.hasOwnProperty('register_number') || this.personData.register_number == ''){
                        this.errors.register_number = ['El campo Número de Identificación es requerido']
                        register_number_field = false
                    }else{
                        register_number_field = true
                    }

                    // email
                    if(!this.personData.hasOwnProperty('email') || this.personData.email == ''){
                        this.errors.email = ['El campo Correo Electrónico es requerido']
                        email_field = false
                    }else{
                        email_field = true
                    }

                    // position
                    if(!this.personData.hasOwnProperty('position') || this.personData.position == ''){
                        this.errors.position = ['El campo Cargo es requerido']
                        position_field = false
                    }else{
                        position_field = true
                    }                   

                    if(first_name_field && last_name_field && register_number_field && email_field && position_field){
                        this.activeItem = next
                    }
                    this.mostrarErrores();
                }
            },
            mostrarErrores(){
                for(let error in this.errors) {
                    switch(error){
                        case 'first_name':
                            this.invalid.first_name = 1;
                            break;
                        case 'last_name':
                            this.invalid.last_name = 1;
                            break;
                        case 'register_number':
                            this.invalid.register_number = 1;
                            break;
                        case 'email':
                            this.invalid.email = 1;
                            break;
                        case 'position':
                            this.invalid.position = 1;
                            break;
                    }
                }
            },
            async save(){
                this.processing = true
                // let data = {};
                // data.personData = this.personData;
                // data.personData = this.personData;
                await axios.get('/sanctum/csrf-cookie')
                await axios.post('/api/person',this.personData).then(({data})=>{
                    this.$router.push({name:'profesionales'})
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