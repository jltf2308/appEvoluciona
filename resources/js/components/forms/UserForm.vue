<template>
    <div class="content sm">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <h3>Agregar Usuario</h3>
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
                        <h2 class="inline-b mr-15">Proporciona personales</h2>
                        <div class="row">
                            <div class="form-group col-6" :class="{'error':invalid.first_name}">
                                <label for="first_name">Nombre: *</label>
                                <input type="text" name="first_name" class="form-control" id="first_name" placeholder="Nombre" v-model="personData[0].first_name">
                                <p class="message" v-for="(e_first_name, index) in errors.first_name" :key="index">{{e_first_name}}</p>
                            </div>
                            <div class="form-group col-6" :class="{'error':invalid.last_name}">
                                <label for="last_name">Apellido: *</label>
                                <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Apellido" v-model="personData[0].last_name">
                                <p class="message" v-for="(e_last_name, index) in errors.last_name" :key="index">{{e_last_name}}</p>
                            </div>
                            <div class="form-group col-6" :class="{'error':invalid.register_number}">
                                <label for="register_number">Identificación: *</label>
                                <input type="text" name="register_number" class="form-control" id="register_number" placeholder="Identificación" v-model="personData[0].register_number">
                                <p class="message" v-for="(e_register_number, index) in errors.register_number" :key="index">{{e_register_number}}</p>
                            </div>
                            <div class="form-group col-6" :class="{'error':invalid.email}">
                                <label for="email">Correo eléctronico: *</label>
                                <input type="text" name="email" class="form-control" id="email" placeholder="Correo eléctronico" v-model="personData[0].email">
                                <p class="message" v-for="(e_email, index) in errors.email" :key="index">{{e_email}}</p>
                            </div>
                            <div class="form-group col-6" :class="{'error':invalid.position}">
                                <label for="position">Cargo: *</label>
                                <input type="text" name="position" class="form-control" id="position" placeholder="Cargo" v-model="personData[0].position">
                                <p class="message" v-for="(e_position, index) in errors.position" :key="index">{{e_position}}</p>
                            </div>
                            <div class="form-group col-6" :class="{'error':invalid.type}">
                                <label for="last_name">Tipo de Usuario: *</label>
                                <select  name="type" id="type" class="form-control" v-model="personData[0].type">
                                    <option disabled value="">Selecciona</option>
                                    <option 
                                        v-for="type in typeUsers" 
                                        :key="type.id" 
                                        :value="type.id">
                                            {{ type.name}}
                                    </option>
                                </select>
                                <p class="message" v-for="(e_last_name, index) in errors.type" :key="index">{{e_last_name}}</p>
                            </div>
                        </div>                   
                    </div>
                </div>

                <div v-if="activeItem == 1" class="col-12 tab-pane fade" :class="{ 'active show': isActive(1) }" id="1">
                    <div class="caja sm mb-15 especial">
                        <h2 class="inline-b mr-15">Proporciona los datos de Usuario</h2>
                        <div class="row">
                            <div class="form-group col-12" :class="{'error':invalid.userEmail}">
                                <label for="email">Correo eléctronico: *</label>
                                <input type="text" name="email" class="form-control" id="email" placeholder="Correo eléctronico" v-model="personData[1].userEmail">
                                <p class="message" v-for="(e_email, index) in errors.userEmail" :key="index">{{e_email}}</p>
                            </div>
                            <div class="form-group col-6" :class="{'error':invalid.password}">
                                <label for="password">Contraseña: *</label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Contraseña" v-model="personData[1].password">
                                <p class="message" v-for="(e_password, index) in errors.password" :key="index">{{e_password}}</p>
                            </div>
                            <div class="form-group col-6" :class="{'error':invalid.confirmPassword}">
                                <label for="confirmPassword">Confirma Contraseña: *</label>
                                <input type="password" name="confirmPassword" class="form-control" id="confirmPassword" placeholder="Confirma Contraseña" v-model="personData[1].confirmPassword">
                                <p class="message" v-for="(e_confirmPassword, index) in errors.confirmPassword" :key="index">{{e_confirmPassword}}</p>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div v-if="activeItem == 2" class="col-12 tab-pane fade" :class="{ 'active show': isActive(2) }" id="1">
                    <div class="caja mb-30">
                        <h3 class="inline-b mr-15">Datos personales</h3>
                        <div class="row">
                            <div class="col-6">
                                <p><span class="bold">Nombre: </span><br> {{ personData[0].first_name}} </p>
                            </div>
                            <div class="col-6">
                                <p><span class="bold">Apellido: </span><br> {{ personData[0].last_name}} </p>
                            </div>
                            <div class="col-6">
                                <p><span class="bold">Identificación: </span><br> {{ personData[0].register_number}} </p>
                            </div>
                            <div class="col-6">
                                <p><span class="bold">Correo eléctronico: </span><br> {{ personData[0].email}} </p>
                            </div>
                            <div class="col-6">
                                <p><span class="bold">Cargo: </span><br> {{ personData[0].position}} </p>
                            </div>
                            <div class="col-6">
                                <p><span class="bold">Tipo de Usuario: </span><br> {{ typeUsers.find(element => element.id == personData[0].type).name}} </p>
                            </div>
                        </div>
                        <h3 class="inline-b mr-15">Datos Usuario</h3>
                        <div class="row">
                            <div class="col-6">
                                <p><span class="bold">Email Usuario: </span><br> {{ personData[1].userEmail}} </p>
                            </div>
                            <div class="col-6">
                                <p><span class="bold">Contraseña: </span><br> {{ personData[1].password}} </p>
                            </div>
                        </div>
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
                    <button v-if="activeItem < 2" type="button" class="button main" @click.prevent="setActive(parseInt(activeItem) + parseInt(1))">Siguiente <i class="ri-arrow-right-s-line"></i></button>
                    <button v-if="activeItem == 2" type="button" class="button main" @click.prevent="save()">{{ processing ? "Espere" : "Guardar" }} <i class="ri-arrow-right-s-line"></i></button>
                </div>
            </div>
        </div>
    </div>

</template>
<script>
    import axios from 'axios';
    export default {
        props:['companyId'],
        data() {
            return {
                tabs:{
                    0: 'Datos personales',
                    1: 'Datos usuario',
                    2: 'Resumen',
                },
                activeItem: 0,
                personData:[
                    {
                        first_name:'',
                        last_name:'',
                        register_number:'',
                        email:'',
                        position:'',
                        type:'',
                        company_id:this.companyId,
                    },
                    {
                        userEmail:'',
                        password:'',
                        confirmPassword:''
                    }
                ],
                invalid:{
                    first_name:0,
                    last_name:0,
                    register_number:0,
                    email:0,
                    position:0,
                    type:0,
                    userEmail:0,
                    password:0,
                    confirmPassword:0,
                },
                errors:{},
                processing:false,
                typeUsers:[
                    {
                        id:'Admin',
                        name:'Administrador'
                    },
                    {
                        id:'Client',
                        name:'Cliente'
                    },
                    
                ]
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
                    let type_field = false
                    if(this.personData[0].first_name == ''){
                        this.errors.first_name = ['El campo Nombre requerido']
                        first_name_field = false
                    }else{
                        first_name_field = true
                    }
                    if(this.personData[0].last_name == ''){
                        this.errors.last_name = ['El campo Apellido requerido']
                        last_name_field = false
                    }else{
                        last_name_field = true
                    }
                    if(this.personData[0].register_number == ''){
                        this.errors.register_number = ['El campo Identificación requerido']
                        register_number_field = false
                    }else{
                        register_number_field = true
                    }
                    if(this.personData[0].email == ''){
                        this.errors.email = ['El campo Correo electrónico requerido']
                        email_field = false
                    }else{
                        email_field = true
                    }
                    if(this.personData[0].position == ''){
                        this.errors.position = ['El campo Cargo requerido']
                        position_field = false
                    }else{
                        position_field = true
                    }
                    if(this.personData[0].type == ''){
                        this.errors.type = ['El campo Tipo de usuario requerido']
                        type_field = false
                    }else{
                        type_field = true
                    }

                    if(first_name_field &&
                        last_name_field &&
                        register_number_field &&
                        email_field &&
                        position_field &&
                        type_field
                    ){
                        this.activeItem = next
                    }
                    this.mostrarErrores();
                }
                else if(active === 1){
                    let email_field = false;
                    let password_field = false;
                    let confirmPassword_field = false;

                    if(this.personData[1].userEmail == ''){
                        this.errors.userEmail = ['El campo email requerido']
                        email_field = false
                    }else{
                        email_field = true
                    }

                    if(this.personData[1].password == ''){
                        this.errors.password = ['El campo contraseña requerido']
                        password_field = false
                    }else if(this.personData[1].password.length < 8){
                        this.errors.password = ['La contraseña debe contener minimo 8 caracteres']
                        password_field = false
                    }else{
                        password_field = true
                    }
                    
                    if(this.personData[1].confirmPassword == ''){
                        this.errors.confirmPassword = ['El campo confirmar contraseña requerido']
                        confirmPassword_field = false
                    }else if (this.personData[1].password != this.personData[1].confirmPassword){
                        this.errors.confirmPassword = ['No coincide la contraseña']
                        confirmPassword_field = false
                    }else{
                        confirmPassword_field = true
                    }

                    if(email_field && password_field && confirmPassword_field){
                        this.activeItem = next
                    }
                    this.mostrarErrores();
                }
            },
            mostrarErrores(){
                for(let error in this.errors) {
                    this.invalid[error] = 1;
                }
            },
            async save(){
                this.processing = true
                await axios.get('/sanctum/csrf-cookie')
                await axios.post('/api/user',this.personData).then(({data})=>{
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
        mounted(){
            
        }
    }
</script>