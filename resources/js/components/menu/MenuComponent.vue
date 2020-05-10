<template>
    <div class="card">
        <div class="card-body padding-supr">
            <ul class="nav flex-column " >
                <li class="nav-item " v-for="(item, index) in items" v-bind:key="index" >
                    <a class="nav-link list-menu" href="#" >{{item.title}}</a>
                    <submenu-component :parent="item.id"></submenu-component> 
                </li>
            </ul>
        </div>
    </div>
    
</template>

<script>
import SubmenuComponent from './SubMenuComponent.vue'; 

export default {
    data(){
        return {
            items: [
                {
                    title: "CLIENTES",
                    id: 1
                },
                {
                    title: "REPORTES",
                    id: 2
                }
            ]
        }
    },   
    mounted(){

    },
    methods:{
    },
    components: { SubmenuComponent }
}
</script>