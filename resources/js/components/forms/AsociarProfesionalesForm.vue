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
                    <div class="form-group" :class="{'error':invalid.professional}">
                        <label for="professional">Profesional: *</label>
                        <select  name="professional" id="professional" class="form-control" v-model="professionalSelected.id" @change="onChange($event.target.value)">
                            <option disabled value="">Selecciona</option>
                            <option 
                            v-for="selectedProfessional in professionals" 
                            :key="selectedProfessional.id" 
                            :value="selectedProfessional.id">
                                {{ selectedProfessional.fullName}}
                            </option>
                        </select>
                        <p class="message" v-for="(e_professional, index) in errors.professional" :key="index">{{e_professional}}</p>
                        <!-- <p class="message">Selecciona el país.</p> -->
                    </div>  
                    <p class="small black">* Datos obligatorios </p>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="dateInit">Fecha de inicio:</label>
                            <Datepicker 
                                :enableTimePicker="false"
                                :closeOnAutoApply="true"
                                position="right"
                                locale="es"
                                :format-locale="es"
                                inline autoApply
                                v-model="professionalSelected.dateInit"
                            ></Datepicker>
                        </div>
                        <div class="form-group col-6">
                            <label for="dateEnd">Fecha final:</label>
                            <Datepicker 
                                :enableTimePicker="false"
                                :closeOnAutoApply="true"
                                position="right"
                                :format-locale="es"
                                inline autoApply
                                v-model="professionalSelected.dateEnd"
                            ></Datepicker>
                        </div>
                    </div>
                    <br>
                    <div class="col-12 col-md-8 col-lg-6 text-end hidden-md-down">
                        <button type="button" class="button main" @click.prevent="addProfessional()">Agregar Profesional</button>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-6">
                            <h3>Profesionales Seleccionados</h3>
                        </div>
                        <TableComponent :header="tableData.header" :body="tableData.data"></TableComponent>
                    </div>
                </div>

                
            </div>
            
            <div v-if="activeItem == 1" class="col-12 tab-pane fade" :class="{ 'active show': isActive(1) }" id="1">
                <div class="caja mb-30">
                    <h3 class="inline-b mr-15">Profesionales Seleccionados</h3>
                    <!-- <p><span class="bold">Nombre: </span><br> {{ personData.first_name }} </p>
                    <p><span class="bold">Apellido: </span><br> {{ personData.last_name }} </p>
                    <p><span class="bold">Número de identificación: </span><br> {{ personData.register_number }} </p>
                    <p><span class="bold">Correo Electrónico: </span><br> {{ personData.email }} </p>
                    <p><span class="bold">Cargo: </span><br> {{ personData.position }} </p> -->
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
    import Datepicker from '@vuepic/vue-datepicker';
    import '@vuepic/vue-datepicker/dist/main.css'
    import { es } from 'date-fns/locale'
    import { ref } from 'vue'
    import TableComponent from '../common/tableComponent.vue';
    export default {
        components: {
            Datepicker,
            TableComponent
        },
        props:{
            companyId: {
                required: true,
            },
        },
        data() {
            return {
                es:es,
                tabs:{
                    0: 'Seleccione profesional',
                    1: 'Resumen',
                },
                activeItem: 0,
                personData:{},
                invalid:{
                    professional:0,
                    initDate:0,
                    endDate:0,
                },                
                errors:{},
                processing:false,
                professionalSelected:{
                    id:'',
                    dateInit:ref(),
                    dateEnd:ref()
                },
                professionals:[],
                tableData:{
                    header:{
                        0:'#',
                        1:'Profesional',
                        2:'Fecha inicio',
                        3:'Fecha Fin'
                    },
                    data:[],
                    buttons:{

                    }
                }
                
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
            },
            async getPeople(){
                this.processing = true;
                await axios.get('/sanctum/csrf-cookie');
                await axios.get('/api/person').then(({data})=>{
                    this.professionals = data.people;
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
            },
            addProfessional(){
                console.log(this.professionalSelected)
            }
        },
        mounted(){
            this.getPeople();
        }
    }
</script>