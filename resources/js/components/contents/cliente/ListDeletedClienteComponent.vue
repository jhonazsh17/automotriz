<template>
    <div>
        
        <div>
            <div v-if="loading" class="text-center">
                Cargando...
            </div>
            <div v-else>
                <div class="row">
                    <div class="col-md-4">
                        <input class="form-control" placeholder="Buscar Cliente"/>
                    </div>
                    
                </div>
                <table class="table table-bordered" style="margin-top:1.3em">
                    <thead>
                        <tr class="text-center">
                            <th>
                                N°
                            </th>
                            <th>
                                Nombres y Apellidos
                            </th>
                            <th>
                                DNI
                            </th>
                            <th>
                                Teléfono
                            </th>
                            <th>
                                Dirección
                            </th>
                            <th>
                                Ciudad
                            </th>
                            <th>
                                Provincia
                            </th>
                            <th>
                                Departamento
                            </th>
                            <th>
                                Opciones
                            </th>
                        </tr>
                    </thead>
                    <tbody v-if="currentClientes.length>0">
                        <tr  v-for="(cliente, index) in currentClientes" v-bind:key="index" style="color:#bbb">
                            <td class="text-center">{{index+1}}</td>
                            <td><a href="#" style="color:#bbb" @click.prevent="detail(cliente)">{{cliente.nombres}} {{cliente.apellidos}}</a></td>
                            <td class="text-center">{{cliente.dni}}</td>
                            <td class="text-center">{{cliente.nro_telefono}}</td>
                            <td>{{cliente.direccion}}</td>
                            <td class="text-center">{{ubigeo.getDistricts(cliente.ciudad).name}}</td>
                            <td class="text-center">{{ubigeo.getProvinces(cliente.provincia).name}}</td>
                            <td class="text-center">{{ubigeo.getRegions(cliente.departamento).name}}</td>
                            <td width="200px" class="text-center">
                                <button class="btn btn-light btn-sm" @click="editCliente(cliente)"><i class="far fa-edit"></i> Restablecer</button>
                            </td>
                        </tr>
                    </tbody>
                    <tbody v-else>
                        <tr class="text-center">
                            <td colspan="9">
                                Aún no tienes Clientes en la Base de Datos.
                            </td>   
                        </tr>      
                    </tbody>
                    
                </table>
                <hr>
                <div>
                    <button class="btn btn-light">
                        <i class="fas fa-trash-restore-alt"></i> Clientes Eliminados
                    </button>
                </div>
            </div>
            
        </div>

    </div>
</template>

<script>

export default {
    data(){
        return {
            load: "loading.gif",
            loading: true,
            clientes: [],
            currentClientes: [],
            ubigeo:"",
        }
    },
    created(){
        this.getAllClientes();
        this.getAllConcesionarios();
        this.ubigeo = new Ubigeo();
        var _this = this;
        setTimeout(function(){
            _this.$store.state.clienteEdited = "";
            _this.$store.state.clienteInserted = "";
            _this.$store.state.clienteRemoved = "";
        }, 3000);
        
    },
    methods: {
        getAllClientes(){
            var _this = this;
            const url = "/getting/clientes";
            axios.get(url).then(function (response) {
                _this.clientes = response.data;
                _this.clientes.forEach(function(element){
                    if(element.estado==0){
                        _this.currentClientes.push(element); 
                    }
                });
                _this.loading = false;
            }).catch(function (error) {
                //error
            });
        },
        getAllConcesionarios(){
            var _this = this;
            const url = "/getting/concesionarios";
            axios.get(url).then(function (response) {
				_this.concesionarios = response.data; 
            }).catch(function (error) {
                //error
			});
        },
        detail(cliente){
            this.$store.state.currentContent = this.$store.state.subItems[6];
            this.$store.state.clienteDetail = cliente;
        },
        editCliente(cliente){
            this.$store.state.currentContent = this.$store.state.subItems[4];
            this.$store.state.clienteEdit = cliente;
        },
        removeCliente(cliente){
            this.$store.state.currentContent = this.$store.state.subItems[5];
            this.$store.state.clienteRemove = cliente;
        },
        goCrearCliente(cliente){
            this.$store.state.currentContent = this.$store.state.subItems[1];
        }
    }
}
</script>