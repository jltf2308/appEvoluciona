import axios from 'axios'
import router from '@/router'

export default {
    namespaced: true,
    state:{
        company:{},
        companies:[],
    },
    getters:{
        company(state){
            return state.company
        },
        companies(state){
            return state.companies
        }
    },
    mutations:{
        SET_COMPANY (state, value) {
            state.company = value
        },
        SET_COMPANIES (state, value) {
            state.companies = value
        }
    },
    actions:{
        async getCompanies({commit}){
            try {
                await axios.get('/sanctum/csrf-cookie');
                const { data } = await axios.get('/api/company')
                commit('SET_COMPANIES', data)
            } catch ({ response: { data: data_1 } }) {
                commit('SET_COMPANIES', [])
            }
        },
        async getCompany({commit, id}){
            try {
                const { data } = await axios.get('/api/v1/company/'+id)
                commit('SET_COMPANY', data)
            } catch ({ response: { data: data_1 } }) {
                commit('SET_COMPANY', [])
            }
        },
    }
}