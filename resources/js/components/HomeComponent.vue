<template>
    <div class="container-fluid">
        <div class="row">
            <!-- template izquierdo -->
            <div class="col-md-2 padding-supr-right-7">
                <menu-component v-on:content="currentContent"></menu-component>
            </div>
            <!-- fin -->

            <!-- template derecho -->
            <div class="col-md-10 padding-supr-left-7">
                <content-menu-item-component :thisContent="contentValue"></content-menu-item-component>
            </div>
            <!-- fin -->
        </div>
    </div>
</template>

<script>
// importando componentes
import ContentMenuItemComponent from './contents/ContentMenuItemComponent.vue';
import MenuComponent from './menu/MenuComponent.vue';

export default {
    data(){
        return {
            contentValue: {}
        }
    },
    components: { ContentMenuItemComponent, MenuComponent },
    methods: { 
        // obtiene el valor del subitem seleccionado
        currentContent(value){ 
            this.contentValue = value;
        }
    }
}
</script>