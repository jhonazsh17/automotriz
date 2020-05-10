<template>
    <div>
        <h3>Cliente: {{cliente.nombres}} {{cliente.apellidos}}</h3> 
        <p>
            DNI: {{cliente.dni}} <br>      
            Teléfono: {{cliente.nro_telefono}}<br>
            Dirección: {{cliente.direccion}}<br>
            Ciudad: {{cliente.ciudad}}<br>
            Provincia: {{cliente.provincia}}<br>
            Departamento: {{cliente.departamento}}<br>
            Estado: <span class="badge badge-warning" v-if="cliente.estado==1">Activo</span>
                    <span v-else class="badge badge-secondary">De Baja</span>
        </p>

        <div>
            <button @click="backList()" class="btn btn-light">
                <i class="fa fa-arrow-left" ></i> &nbsp;Volver
            </button>
        </div>
    </div> 
</template>

<script>
export default {
    data(){
        return {
            cliente: this.$store.state.clienteDetail,
        }
    },
    methods: {
        backList(){
            console.log('hola');
            this.$store.state.currentContent = this.$store.state.subItems[2];
        }
    }
}
</script>