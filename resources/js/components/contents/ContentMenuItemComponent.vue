<template>
    <div class="card">
        <div class="card-header" >
            {{$store.state.titleContent}}
        </div>
        <div class="card-body">
            <content-body-component :content="thisContent"></content-body-component>
        </div>
    </div>
</template>

<script>

import ContentBodyComponent from './ContentBodyComponent.vue';

export default {
    name: "content-menu-item",    
    props: ['thisContent'],
    components: { ContentBodyComponent },
    data(){
        return {
            title: ""
        }
    },
    created(){
        this.$store.state.titleContent = this.thisContent;
    },
    methods: {
        
    }
}
</script>