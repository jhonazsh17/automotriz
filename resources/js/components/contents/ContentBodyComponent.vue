<template>
    <div class="row" >
        <div class="col-md-12" v-if="content.id==1">
            <create-cliente-component></create-cliente-component>
        </div>
        <div class="col-md-12" v-if="content.id==2">
            <list-clientes-component></list-clientes-component>
        </div>
    </div>
</template>

<script>

import CreateClienteComponent from './cliente/CreateClienteComponent.vue';
import ListClientesComponent from './cliente/ListClientesComponent.vue';

export default {
    props: ['content'],
    data(){
        return {
        }    
    },
    components:{
        CreateClienteComponent,
        ListClientesComponent,
    }
}
</script>