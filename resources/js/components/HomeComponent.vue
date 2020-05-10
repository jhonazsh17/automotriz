<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 padding-supr-right-7">
                <menu-component v-on:content="currentContent"></menu-component>
            </div>
            <div class="col-md-10 padding-supr-left-7">
                <content-menu-item-component :thisContent="contentValue"></content-menu-item-component>
            </div>
        </div>
    </div>
</template>

<script>
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
        currentContent(value){ 
            this.contentValue = value;
        }
    }
}
</script>