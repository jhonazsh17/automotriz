<template>
    <div>
        <h4>El Cliente: [{{cliente.nombres}} {{cliente.apellidos}}] será removido de tu Lista.</h4>
        <p>
            ¿Estás seguro de realizar esta acción?
        </p>
        <div>
            <button class="btn btn-danger" @click="eliminar(cliente)">
                Eliminar
            </button>
            <button class="btn btn-light" @click="backList()">
                <i class="fa fa-arrow-left"></i> Volver
            </button>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            cliente: this.$store.state.clienteRemove
        }    
    },
    methods:{
        eliminar(cliente){
            var _this = this;
            const url = "/removing/cliente";
            axios.put(url, cliente).then(function (response) {
                _this.$store.state.clienteRemoved = response.data;
                _this.$store.state.currentContent = _this.$store.state.subItems[2];
            }).catch(function (error) {
                console.log(error);
            });
        },
        backList(){
            this.$store.state.clienteRemoved = "";
            this.$store.state.clienteEdited = "";
            this.$store.state.clienteInserted = "";
            this.$store.state.currentContent = this.$store.state.subItems[2];
        }
    }
}
</script>