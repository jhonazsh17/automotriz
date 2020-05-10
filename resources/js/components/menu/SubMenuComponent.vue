<template>
    <div class="list-group list-submenu">
        <ul class="nav flex-column" >
            <li class="nav-item" v-for="(subItem, index) in subItems" v-bind:key="index">
                <a class="nav-link" href="#" v-if="subItem.parent==parent" @click="emitContent(subItem)">{{subItem.title}}</a>
            </li>
        </ul>
    </div>
</template>

<script>

export default {
    name: "submenu",
    props: ['parent'],
    data(){
        return {
            subItems: [
                {
                    title: "Crear Cliente",
                    id: 1,
                    parent: 1
                },
                {
                    title: "Lista de Clientes",
                    id: 2,
                    parent: 1
                },
                {
                    title: "Generar Reporte",
                    id: 3,
                    parent: 2
                }
            ]
        }
    },
    methods: {
        emitContent(subItem) {
            this.$emit('getEmitContent', subItem);  
        }
    }
}
</script>