<template>
    <div class="row" >
        <!-- template para el panel principal -->
        <div class="col-md-12" v-if="$store.state.currentContent.id==0">
            <panel-component></panel-component>
        </div>
        <!-- fin -->

        <!-- template para crear cliente -->
        <div class="col-md-12" v-if="$store.state.currentContent.id==1">
            <create-cliente-component></create-cliente-component>
        </div>
        <!-- fin -->

        <!-- template para mostrar lista clientes -->
        <div class="col-md-12" v-if="$store.state.currentContent.id==2">
            <list-clientes-component></list-clientes-component>
        </div>
        <!-- fin -->

        <!-- template para editar cliente -->
        <div class="col-md-12" v-if="$store.state.currentContent.id==4">
            <edit-cliente-component></edit-cliente-component>
        </div>
        <!-- fin -->

        <!-- template para eliminar un cliente -->
        <div class="col-md-12" v-if="$store.state.currentContent.id==5">
            <remove-cliente-component></remove-cliente-component>
        </div>
        <!-- fin -->

        <!-- template para ver detalle de cliente -->
        <div class="col-md-12" v-if="$store.state.currentContent.id==6">
            <detail-cliente-component></detail-cliente-component>
        </div>
        <!-- fin -->

        <!-- template para ver lista de clientes eliminados -->
        <div class="col-md-12" v-if="$store.state.currentContent.id==7">
            <list-deleted-cliente-component></list-deleted-cliente-component>
        </div>
        <!-- fin -->
    </div>
</template>

<script>

// importando componentes
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