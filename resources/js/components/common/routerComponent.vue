<template>
    <!-- <router-link :to="routeParams" 
        :title="title"
        class="btn btn-sm"
        :class="classStyle"
        data-bs-toggle="tooltip" 
        data-bs-placement="bottom">
        <i class="material-icons text-white">{{icon}}</i>
    </router-link> -->
    <button
        class="btn btn-sm"
        :class="classStyle"
        data-bs-toggle="tooltip" 
        data-bs-placement="bottom"
        :title="title"
        @click="moveTo(routeParams, paramId, paramName)"
    ><i class="material-icons text-white">{{icon}}</i></button>
</template>

<script>
import router from '@/router'
export default {
    name:"routerComponent",
    props:{
        routeTo:{
            type:String
        },
        routeParams:{
            type:Object
        },
        classStyle:{
            type:String
        },
        icon:{
            type:String
        },
        title:{
            type:String
        },
        paramId:{
            type:Number
        },
        paramName:{
            type:String
        }
    },
    methods:{
        moveTo(buttonParams, paramId=null, paramName=null){
            let routerParams={}
            if(buttonParams.haveParams){
                routerParams.name = buttonParams.name
                routerParams.params = {}
                routerParams.params[buttonParams.params[0]] = paramId;
                routerParams.params[buttonParams.params[1]] = paramName;
            }
            router.push(routerParams)
        }
    },
    mounted(){
        
    }
}
</script>