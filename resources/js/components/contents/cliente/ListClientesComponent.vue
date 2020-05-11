<template>
    <div>
        <div class="alert alert-success" role="alert" v-if="$store.state.clienteEdited!=''">
            Se ha actualizado el cliente <b>[{{$store.state.clienteEdited.nombres}} {{$store.state.clienteEdited.apellidos}}]</b>, con éxito. 
        </div>
        <div class="alert alert-success" role="alert" v-if="$store.state.clienteInserted!=''">
            Se ha creado el cliente <b>[{{$store.state.clienteInserted.nombres}} {{$store.state.clienteInserted.apellidos}}]</b>, con éxito. 
        </div>
        <div class="alert alert-success" role="alert" v-if="$store.state.clienteRemoved!=''">
            Se ha eliminado el cliente <b>[{{$store.state.clienteRemoved.nombres}} {{$store.state.clienteRemoved.apellidos}}]</b>. 
        </div>
        <div class="alert alert-success" role="alert" v-if="$store.state.clienteReset!=''">
            Se ha restablecido el cliente <b>[{{$store.state.clienteReset.nombres}} {{$store.state.clienteReset.apellidos}}]</b>. 
        </div>
        <div>
            <div v-if="loading" class="text-center">
                Cargando...
            </div>
            <div v-else>
                <div class="row">
                    <div class="col-md-3 padding-supr-right-7">
                        <input class="form-control" @keyup="filterByName()" v-model="wordSearch" placeholder="Buscar por Nombres y Apellidos"/>
                    </div>
                    <div class="col-md-3 padding-supr-left-7 padding-supr-right-7">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Buscar por DNI" @keyup="filterByDoc()" v-model="filterDoc">
                        </div>
                    </div>
                    <div class="col-md-3 padding-supr-left-7 padding-supr-rigth-7">
                        <div class="btn-group">
                            
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01"><i class="fa fa-filter"></i></label>
                                </div>
                                <select class="custom-select" @change="filterConcesionario()" v-model="filterValue">
                                    <option selected value="Todos Concesionarios">Todos Concesionarios</option>
                                    <option v-for="(concesionario, index) in concesionarios" :key="index" v-bind:value="concesionario.id" >{{concesionario.nombre}}</option>
                                    
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-3 text-right">
                        <div class="btn-group">
                            <button @click="goCrearCliente()" class="btn btn-success" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Crear Cliente
                            </button>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-striped" style="margin-top:1.3em">
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
                    <tbody v-if="currentClientes.length>0">
                        <tr  v-for="(cliente, index) in currentClientes" v-bind:key="index">
                            <td class="text-center">{{index+1}}</td>
                            <td><a href="#" @click.prevent="detail(cliente)">{{cliente.nombres}} {{cliente.apellidos}}</a></td>
                            <td class="text-center">{{cliente.dni}}</td>
                            <td class="text-center"><a href="#" class="badge badge-warning" @click.prevent="filterInListConcesionario(cliente.concesionario_id)">{{cliente.concesionario_name}}</a></td>
                            <td>{{cliente.direccion}}</td>
                            <td class="text-center">{{ubigeo.getDistricts(cliente.ciudad).name}}</td>
                            <td class="text-center">{{ubigeo.getProvinces(cliente.provincia).name}}</td>
                            <td class="text-center">{{ubigeo.getRegions(cliente.departamento).name}}</td>
                            <td width="200px" class="text-center">
                                <button class="btn btn-light btn-sm" @click="editCliente(cliente)"><i class="far fa-edit"></i> Editar</button>
                                <button class="btn btn-light btn-sm" @click="removeCliente(cliente)"><i class="far fa-trash-alt"></i> Eliminar</button>
                            </td>
                        </tr>
                    </tbody>
                    <tbody v-else>
                        <tr class="text-center">
                            <td colspan="9">
                                No hay Clientes.
                            </td>   
                        </tr>      
                    </tbody>
                    
                </table>
                <hr>
                <div>
                    <div class="row">
                        <div class="col-md-6">
                            <button class="btn btn-light" @click="goClientesDeleted()">
                                <i class="fas fa-trash-restore-alt" ></i> Clientes Eliminados
                            </button>
                        </div>
                        
                    </div>
                    
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
            concesionarios: [],
            filterValue: "Todos Concesionarios",
            wordSearch: "",
            filterDoc: ""
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
            _this.$store.state.clienteReset = "";
        }, 3000);
        
    },
    methods: {
        getAllClientes(){
            var _this = this;
            const url = "/getting/clientes";
            this.axiosGetClientes(url);
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
        filterInListConcesionario(concesionario_id){
            this.filterValue = concesionario_id;
            this.filterConcesionario();
        },
        filterConcesionario(){
            var _this = this;
            if(this.filterValue!="Todos Concesionarios"){
                const url = "/getting/clientes/by/concesionario/"+this.filterValue;
                _this.clientes = [];
                this.axiosGetClientes(url);
            }else{
                this.getAllClientes();
            }
        },
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
        filterByDoc(){
            var _this = this;
            if(this.filterDoc!=""){
                const url = "/getting/clientes/by/doc/"+this.filterDoc;
                _this.clientes = [];
                this.axiosGetClientes(url);
            }else{
                this.getAllClientes();
            }
            
        },
        axiosGetClientes(url){
            var _this = this;
            axios.get(url).then(function (response) {
                _this.currentClientes = [];
                _this.clientes = response.data;
                _this.clientes.forEach(function(element){
                    if(element.estado=='1'){
                        _this.currentClientes.push(element);
                    }
                });
                _this.loading = false;
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
        },
        goClientesDeleted(cliente){
            this.$store.state.currentContent = this.$store.state.subItems[7];
        }
    }
}
</script>