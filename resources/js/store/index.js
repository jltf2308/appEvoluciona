import { createStore } from 'vuex'
import createPersistedState from 'vuex-persistedstate'
import auth from '@/store/auth'
import company from '@/store/company'

const store = createStore({
    plugins:[
        createPersistedState()
    ],
    modules:{
        auth,
        company
    }
})

export default store