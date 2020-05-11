<template>
    <!-- template panel padre derecho -->
    <div class="card">
        <div class="card-header" >
            {{$store.state.currentContent.title}}
        </div>
        <div class="card-body">
            <content-body-component></content-body-component>
        </div>
    </div>
    <!-- fin -->
</template>

<script>
// importando componente
import ContentBodyComponent from './ContentBodyComponent.vue';

export default {
    name: "content-menu-item", 
    components: { ContentBodyComponent }
}
</script>