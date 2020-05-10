<template>
    <div class="list-group list-submenu">
        <ul class="nav flex-column" >
            <li class="nav-item" v-for="(subItem, index) in subItems" v-bind:key="index">
                <a class="nav-link" href="#" v-if="subItem.parent==parent&&subItem.inMenu==true" @click="showContent(subItem)">{{subItem.title}}</a>
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
            subItems: this.$store.state.subItems,
        }
    },
    created(){
        this.$store.state.currentContent = this.subItems[0];
        console.log(this.$store.state.currentContent);
    },
    methods: {
        showContent(subItem) {
            this.$store.state.currentContent = subItem;
            //this.$emit('getEmitContent', subItem);  
        }
    }
}
</script>