<template>
    <div>
        <h4>El Cliente: [{{cliente.nombres}} {{cliente.apellidos}}] será removido de tu Lista.</h4>
        <p>
            ¿Estás seguro de realizar esta acción?
        </p>
        <div>
            <button class="btn btn-danger" @click="eliminar()">
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
    props: ['clienteRemove'],
    data(){
        return {
            cliente: this.clienteRemove
        }    
    },
    methods:{
        eliminar(){
            console.log('holita');
            var _this = this;
            const url = "/removing/cliente";
            axios.put(url, this.cliente).then(function (response) {
                console.log(response); 
            }).catch(function (error) {
                console.log(error);
            });
        },
        backList(){
            console.log('hola');
        }
    }
}
</script>