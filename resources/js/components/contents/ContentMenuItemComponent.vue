<template>
    <div class="card">
        <div class="card-header" >
            {{$store.state.currentContent.title}}
        </div>
        <div class="card-body">
            <content-body-component></content-body-component>
        </div>
    </div>
</template>

<script>

import ContentBodyComponent from './ContentBodyComponent.vue';

export default {
    name: "content-menu-item", 
    components: { ContentBodyComponent },
    data(){
        return {
        }
    },
    created(){
        this.thisContent = {
            title: "Panel Principal",
            id: 3,
            parent: 0
        };
        this.$store.state.titleContent = this.thisContent.title;
    },
    methods: {
        
    }
}
</script>