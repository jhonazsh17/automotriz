<template>
    <div>
        
        <div>
            <!-- template de carga -->
            <div v-if="loading" class="text-center">
                Cargando...
            </div>
            <!-- fin -->

            <!-- template de lista de clientes eliminados-->
            <div v-else>
                <div class="row">
                    <div class="col-md-4">
                        <input class="form-control" placeholder="Buscar por Nombres y Apellidos" @keyup="filterByName()" v-model="wordSearch"/>
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
                                Concesionario
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

                    <!-- template de datos del clientes eliminados -->
                    <tbody v-if="currentClientes.length>0">
                        <tr  v-for="(cliente, index) in currentClientes" v-bind:key="index" style="color:#bbb">
                            <td class="text-center">{{index+1}}</td>
                            <td><a href="#" style="color:#bbb" @click.prevent="detail(cliente)">{{cliente.nombres}} {{cliente.apellidos}}</a></td>
                            <td class="text-center">{{cliente.dni}}</td>
                            <td class="text-center">{{cliente.concesionario_id}}</td>
                            <td>{{cliente.direccion}}</td>
                            <td class="text-center">{{ubigeo.getDistricts(cliente.ciudad).name}}</td>
                            <td class="text-center">{{ubigeo.getProvinces(cliente.provincia).name}}</td>
                            <td class="text-center">{{ubigeo.getRegions(cliente.departamento).name}}</td>
                            <td width="200px" class="text-center">
                                <button class="btn btn-light btn-sm" @click="resetCliente(cliente)"><i class="fas fa-user-check"></i>&nbsp; Restablecer</button>
                            </td>
                        </tr>
                    </tbody>
                    <!-- fin -->

                    <!-- template de mensaje sin clientes eliminados -->
                    <tbody v-else>
                        <tr class="text-center">
                            <td colspan="9">
                                Aún no tienes Clientes Eliminados.
                            </td>   
                        </tr>      
                    </tbody>
                    <!-- fin -->
                    
                </table>
                <hr>  
                <div>
                    <button class="btn btn-light" @click="backList()"><i class="fa fa-arrow-left" ></i> &nbsp;Volver</button>
                </div>
                
            </div>
            <!-- fin -->
            
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
            wordSearch:""
        }
    },
    created(){
        this.getAllClientes();
        this.ubigeo = new Ubigeo();        
    },
    methods: {
        // función que obtiene los clientes eliminados
        getAllClientes(){
            const url = "/getting/clientes";
            var _this = this;
            axios.get(url).then(function (response) {
                _this.currentClientes = [];
                _this.clientes = response.data;
                _this.clientes.forEach(function(element){
                    if(element.estado=='0'){
                        _this.currentClientes.push(element);
                    }
                });
                _this.loading = false;
            }).catch(function (error) {
                //error
            });
        },

        // función que obtiene la lista de clientes eliminados filtrados por nombres
        filterByName(){
            var _this = this;
            if(this.wordSearch!=""){
                const url = "/getting/clientes/by/name/"+this.wordSearch;
                _this.clientes = [];
                this.axiosGetClientes(url);
            }else{
                this.getAllClientes();
            }
            
        },

        //función que obtiene la data de clientes de forma asíncrona
        axiosGetClientes(url){
            var _this = this;
            axios.get(url).then(function (response) {
                _this.currentClientes = [];
                _this.clientes = response.data;
                _this.clientes.forEach(function(element){
                    if(element.estado=='0'){
                        _this.currentClientes.push(element);
                    }
                });
                _this.loading = false;
            }).catch(function (error) {
                //error
            });
        },

        // función que muestra el detalle de cliente eliminado
        detail(cliente){
            this.$store.state.currentContent = this.$store.state.subItems[6];
            this.$store.state.clienteDetail = cliente;
        },

        // función que restablece un cliente eliminado
        resetCliente(cliente){
            var _this = this;
            const url = "/resetting/cliente/"+cliente.id;
            axios.put(url).then(function (response) {
                if(response.data){
                    _this.$store.state.currentContent = _this.$store.state.subItems[2];
                    _this.$store.state.clienteReset = response.data;
                }
            }).catch(function (error) {
                //error
            });
        },

        // función que retorna a la lista de clientes
        backList(cliente){
            this.$store.state.currentContent = this.$store.state.subItems[2];
        }
    }
}
</script>