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
                        <div class="form-group" :class="{'error':invalid.professional}">
                            <label for="professional">Profesional: *</label>
                            <select  name="professional" id="professional" class="form-control" v-model="professionalSelected.person_id">
                                <option disabled value="">Selecciona</option>
                                <option 
                                v-for="selectedProfessional in selectProfessionals" 
                                :key="selectedProfessional.id" 
                                :value="selectedProfessional.id">
                                    {{ selectedProfessional.fullName}}
                                </option>
                            </select>
                            <p class="message" v-for="(e_professional, index) in errors.professional" :key="index">{{e_professional}}</p>
                        </div>  
                        <p class="small black">* Datos obligatorios </p>
                        <div class="row">
                            <div class="form-group col-6" :class="{'error':invalid.initDate}">
                                <label for="dateInit">Fecha de inicio:</label>
                                <Datepicker 
                                    v-model="professionalSelected.dateInit" 
                                    autoApply 
                                    :enableTimePicker="false" 
                                    locale="es"
                                    :format-locale="es"
                                    format="dd/MM/yyyy"
                                    :inputClassName="invalid.initDate ? 'form-control error': 'form-control'"
                                    
                                ></Datepicker>
                                <p class="message" v-for="(e_initDate, index) in errors.initDate" :key="index">{{e_initDate}}</p>
                            </div>
                            <div class="form-group col-6" :class="{'error':invalid.endDate}">
                                <label for="dateEnd">Fecha final:</label>
                                <Datepicker 
                                    v-model="professionalSelected.dateEnd" 
                                    autoApply 
                                    :enableTimePicker="false" 
                                    locale="es"
                                    :format-locale="es"
                                    format="dd/MM/yyyy"
                                    :inputClassName="invalid.endDate ? 'form-control error': 'form-control'"
                                ></Datepicker>
                                <p class="message" v-for="(e_endDate, index) in errors.endDate" :key="index">{{e_endDate}}</p>
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
                            <div class="col-12">
                                <table class="table table-borderless table-responsive card-1 p-4 table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center" v-for="(value, name) in tableData.header" :key="name">{{value}}</th>
                                            <th class="text-center w-25">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template v-if="tableData.data.length == 0">
                                            <tr>
                                                <td align="center" :colspan="Object.keys(this.tableData.header).length +1"> No existen Registros</td>
                                            </tr>
                                        </template>
                                        <template v-else>
                                            <tr v-for="(value, index) in tableData.data" :key="index">
                                                <td class="align-middle text-center">{{index+1}}</td>
                                                <template v-for="(val, ind) in value">
                                                    <td class="align-middle" v-if="ind != 'person_id' && ind!='companyId'">{{val}}</td>
                                                </template>
                                                <td class="text-center align-middle p-1" v-if="tableData.buttons.length > 0">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <template v-for="(nameButton, i) in tableData.buttons" :key="i">
                                                            <template v-if="nameButton.type == 'button'">
                                                                <button
                                                                    class="btn btn-sm"
                                                                    data-bs-toggle="tooltip" 
                                                                    data-bs-placement="bottom"
                                                                    :title="nameButton.title"
                                                                    :class="nameButton.classStyle"
                                                                    @click="handle_function_call(nameButton.action, tableData.data[index].person_id)"
                                                                >
                                                                    <i class="material-icons text-white">{{nameButton.icon}}</i>
                                                                </button>
                                                            </template>
                                                            <template v-if="nameButton.type == 'routeButton'">
                                                                <router-link 
                                                                    :to="{ 
                                                                        name:nameButton.name, 
                                                                        params:{
                                                                            companyId:body[index].id
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
                                            </tr>  
                                        </template>                      
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    
                </div>
                
                <div v-if="activeItem == 1" class="col-12 tab-pane fade" :class="{ 'active show': isActive(1) }" id="1">
                    <div class="caja mb-30">
                        <div class="row">
                            <div class="col-6">
                                <h3>Profesionales Seleccionados</h3>
                            </div>
                            <div class="col-12">
                                <table class="table table-borderless table-responsive card-1 p-4 table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center" v-for="(value, name) in tableData.header" :key="name">{{value}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template v-if="tableData.data.length == 0">
                                            <tr>
                                                <td align="center" :colspan="Object.keys(this.tableData.header).length +1"> No existen Registros</td>
                                            </tr>
                                        </template>
                                        <template v-else>
                                            <tr v-for="(value, index) in tableData.data" :key="index">
                                                <td class="align-middle text-center">{{index+1}}</td>
                                                <template v-for="(val, ind) in value">
                                                    <td class="align-middle" v-if="ind != 'person_id' && ind!='companyId'">{{val}}</td>
                                                </template>
                                            </tr>  
                                        </template>                      
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-4 col-lg-6">
                    <button @click="$router.go(-1)" class="button secondary sm-block">Go Back</button>
                    <!-- <router-link :to="-1">
                        Cancelar
                    </router-link> -->
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
    import moment from 'moment'
    export default {
        components: {
            Datepicker,
            
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
                    person_id:'',
                    dateInit:ref(),
                    dateEnd:ref(),
                    companyId:''
                },
                professionals:[],
                selectProfessionals:[],
                tableData:{
                    header:{
                        0:'#',
                        1:'Profesional',
                        2:'Fecha inicio',
                        3:'Fecha Fin'
                    },
                    data:[],
                    buttons:
                    [
                        {
                            type:'button',
                            action:"eliminarProfesional",
                            icon:"Eliminar",
                            classStyle:"btn-danger",
                            icon:"delete",
                            title:"Ver Usuarios",
                            action:"deleteProfessionalSelected"
                        }
                    ],
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
                    let people_data = false
                    let dateInit_field = false
                    let dateEnd_field = false
                    // name
                    if(this.tableData.data.length === 0){
                        this.errors.professional = ['Debe seleccionar al menos un profesional']
                        this.errors.initDate = ['Debe seleccionar la fecha de inicio del profesional']
                        this.errors.endDate = ['Debe seleccionar la fecha de fin del profesional']
                        people_data = false;
                        dateInit_field = false
                        dateEnd_field = false
                    }else{
                        people_data = true
                        dateInit_field = true
                        dateEnd_field = true
                    }

                    if(people_data && dateInit_field && dateEnd_field){
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
                await axios.post('/api/professional',this.tableData.data).then(({data})=>{
                    this.$router.push({name:'profesionalesAsociados'})
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
                await axios.get('/api/professional').then(({data})=>{
                    this.professionals = data.people;
                    this.selectProfessionals = data.people;
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
                this.reiniciaMensajesError();
                console.log(this.selectProfessionals)
                let people_data = false
                let dateInit_field = false
                let dateEnd_field = false

                if(this.professionalSelected.person_id == ''){
                    this.errors.professional = ['Debe seleccionar al menos un profesional']
                    people_data = false;
                }else{
                    people_data = true;
                }

                if(this.professionalSelected.dateInit == undefined){
                    this.errors.initDate = ['Debe seleccionar la fecha de inicio del profesional']
                    dateInit_field = false
                }else{
                    dateInit_field = true
                }

                if(this.professionalSelected.dateEnd == undefined){
                    this.errors.endDate = ['Debe seleccionar la fecha de fin del profesional']
                    dateEnd_field = false
                }else{
                    dateEnd_field = true
                }

                if(people_data && dateInit_field && dateEnd_field){
                    let person = {
                        person_id:this.professionalSelected.person_id,
                        fullName:this.professionals.find(x => x.id === this.professionalSelected.person_id).fullName,
                        date_init:moment(this.professionalSelected.dateInit).format('DD-MM-YYYY'),
                        date_end:moment(this.professionalSelected.dateEnd).format('DD-MM-YYYY'),
                        companyId:this.companyId
                    }
                    this.tableData.data.push(person);
                    this.professionalSelected = {
                        person_id:'',
                        dateInit:ref(),
                        dateEnd:ref(),
                        companyId:''
                    },
                    this.updateProfessionalList();
                }
                this.mostrarErrores();
                
            },
            handle_function_call(function_name, val) {
                this[function_name](val)
            },
            deleteProfessionalSelected(value){
                console.log(value);
                const objWithIdIndex = this.tableData.data.findIndex((obj) => obj.person_id === value);
                this.tableData.data.splice(objWithIdIndex, 1);
                this.updateProfessionalList();
            },
            updateProfessionalList(){
                let profesionals = this.professionals.filter(ar => !this.tableData.data.find(rm => (rm.person_id === ar.id) ))
                console.log(profesionals)
                this.selectProfessionals = profesionals;
            },
        },
        mounted(){
            this.getPeople();
            console.log(this.selectProfessionals)
        }
    }
</script>