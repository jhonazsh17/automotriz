<template>
    <div class="row" >
        <div class="col-md-12" v-if="$store.state.currentContent.id==0">
            <panel-component></panel-component>
        </div>
        <div class="col-md-12" v-if="$store.state.currentContent.id==1">
            <create-cliente-component></create-cliente-component>
        </div>
        <div class="col-md-12" v-if="$store.state.currentContent.id==2">
            <list-clientes-component></list-clientes-component>
        </div>
        <div class="col-md-12" v-if="$store.state.currentContent.id==4">
            <edit-cliente-component></edit-cliente-component>
        </div>
        <div class="col-md-12" v-if="$store.state.currentContent.id==5">
            <remove-cliente-component></remove-cliente-component>
        </div>
        <div class="col-md-12" v-if="$store.state.currentContent.id==6">
            <detail-cliente-component></detail-cliente-component>
        </div>
        <div class="col-md-12" v-if="$store.state.currentContent.id==7">
            <list-deleted-cliente-component></list-deleted-cliente-component>
        </div>
    </div>
</template>

<script>

import CreateClienteComponent from './cliente/CreateClienteComponent.vue';
import ListClientesComponent from './cliente/ListClientesComponent.vue';
import PanelComponent from './PanelComponent.vue';
import EditClienteComponent from './cliente/EditClienteComponent.vue';
import RemoveClienteComponent from './cliente/RemoveClienteComponent.vue';
import DetailClienteComponent from './cliente/DetailClienteComponent.vue';
import ListDeletedClienteComponent from './cliente/ListDeletedClienteComponent.vue';

export default {
    props: ['content'],
    data(){
        return {
            
        }    
    },
    components:{
        CreateClienteComponent,
        ListClientesComponent,
        PanelComponent,
        EditClienteComponent,
        RemoveClienteComponent,
        DetailClienteComponent,
        ListDeletedClienteComponent,
    }
}
</script>