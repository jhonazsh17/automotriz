<template>
    <div>
        <div v-if="list" >
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
                    <tbody v-if="clientes.length>0">
                        <tr  v-for="(cliente, index) in clientes" v-bind:key="index">
                            <td class="text-center">{{index+1}}</td>
                            <td><a href="#" @click.prevent="detail(cliente.id)">{{cliente.nombres}} {{cliente.apellidos}}</a></td>
                            <td class="text-center">{{cliente.dni}}</td>
                            <td class="text-center">{{cliente.nro_telefono}}</td>
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
                                Aún no tienes Clientes en la Base de Datos.
                            </td>   
                        </tr>      
                    </tbody>
                    
                </table>
            </div>
            
        </div>

        <div v-if="edit">
            <edit-cliente-component :clienteEdit="thisCliente"></edit-cliente-component>
        </div>

        <div v-if="remove">
            <remove-cliente-component :clienteRemove="thisCliente"></remove-cliente-component>
        </div>
    </div>
</template>

<script>

import EditClienteComponent from './EditClienteComponent.vue';
import RemoveClienteComponent from './RemoveClienteComponent.vue';

export default {
    data(){
        return {
            load: "loading.gif",
            loading: true,
            clientes: [],
            ubigeo:"",
            list: true,
            edit: false,
            remove: false,
            thisCliente: {}
        }
    },
    components: {
        EditClienteComponent,
        RemoveClienteComponent
    },
    created(){
        this.getAllClientes();
        this.ubigeo = new Ubigeo();
    },
    methods: {
        getAllClientes(){
            var _this = this;
            const url = "/getting/clientes";
            axios.get(url).then(function (response) {
                _this.clientes = response.data;
                _this.loading = false;
                console.log(response.data);
            }).catch(function (error) {
                console.log(error);
            });
        },
        detail(id){
            console.log(id);
        },
        editCliente(cliente){
            this.list = false;
            this.edit = true;
            this.remove = false;
            this.thisCliente = cliente;
        },
        removeCliente(cliente){
            this.list = false;
            this.edit = false;
            this.remove = true;
            this.thisCliente = cliente;
        }
    }
}
</script>