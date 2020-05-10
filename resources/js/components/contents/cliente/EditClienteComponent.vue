<template>
    <div>
        <div class="alert alert-warning" role="alert" v-if="alertState">
            Los datos obligatorios no deben estar vacíos.
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group margin-supr-bottom-5">
                    <label for="exampleInputEmail1">Concesionario *</label>
                    <select class="form-control" name="" id="" v-model="cliente.concesionario_id">
                        <option value="" disabled selected>Elegir Concesionario</option>
                        <option v-for="(concesionario, index) in concesionarios" v-bind:key="index" v-bind:value="concesionario.id" >
                            {{concesionario.nombre}}    
                        </option>
                    </select>
                </div>
            </div>
        </div>    
        <hr>
            <div class="row">
                <div class="col-md-6 padding-supr-right-7">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nombres *</label>
                        <input type="text" class="form-control"  placeholder="Ingresar nombres" v-model="cliente.nombres">
                    </div>
                </div>
                <div class="col-md-6 padding-supr-left-7">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Apellidos *</label>
                        <input type="text" class="form-control"  placeholder="Ingresar apellidos" v-model="cliente.apellidos">
                    </div>
                </div>
                <div class="col-md-3 padding-supr-right-7">
                    <div class="form-group">
                        <label for="exampleInputEmail1">DNI *</label>
                        <input type="text" class="form-control"  placeholder="Ingresar DNI" v-model="cliente.dni">
                    </div>
                </div>
                <div class="col-md-3 padding-supr-right-7 padding-supr-left-7">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Teléfono *</label>
                        <input type="text" class="form-control"  placeholder="Ingresar Teléfono" v-model="cliente.nro_telefono">
                    </div>
                </div>
                <div class="col-md-6 padding-supr-left-7">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Dirección *</label>
                        <input type="text" class="form-control"  placeholder="Ingresar Dirección" v-model="cliente.direccion">
                    </div>
                </div>
                <div class="col-md-3 padding-supr-right-7">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Departamento *</label>
                        <select class="form-control" name="" id="" @change="changeDepartamento()" v-model="cliente.departamento">
                            <option value="" disabled selected>Elegir Departamento</option>
                            <option v-for="(departamento, index) in departamentos" v-bind:key="index" v-bind:value="departamento.id">{{departamento.name}} </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3 padding-supr-right-7 padding-supr-left-7">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Provincia *</label>
                        <select class="form-control" name="" id="" @change="changeProvincia()" v-model="cliente.provincia">
                            <option value="" disabled selected>Elegir Provincia</option>
                            <option v-for="(provincia, index) in provincias" v-bind:key="index" v-bind:value="provincia.id">{{provincia.name}} </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3 padding-supr-right-7 padding-supr-left-7">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Distrito *</label>
                        <select class="form-control" name="" id="" v-model="cliente.ciudad">
                            <option value="" disabled selected>Elegir Distrito</option>
                            <option v-for="(distrito, index) in distritos" v-bind:key="index" v-bind:value="distrito.id">{{distrito.name}} </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3 padding-supr-left-7">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Fecha de Nacimiento</label>
                        <input type="date" class="form-control"  placeholder="Ingresar Departamento" v-model="cliente.fecha_nacimiento">
                    </div>
                </div>
            </div>
            <div class="mt-1">
                <button type="submit" class="btn btn-success" @click.prevent="saveChangesCliente"><i class="far fa-save"></i> &nbsp;Guardar Cambios</button>
                
                <button class="btn btn-light" @click="backList()"><i class="fa fa-arrow-left" ></i> &nbsp;Volver</button>
            </div>
            
            
        
    </div>
</template>

<script>
export default {
    data(){
        return {
            concesionarios: [],
            departamentos: [],
            provincias: [],
            distritos: [],
            ubigeo:"",
            cliente: this.$store.state.clienteEdit,
            alertState: false
        }    
    },
    created() {
        this.ubigeo = new Ubigeo();
        this.departamentos = this.ubigeo.getRegions();
        this.getAllConcesionarios();
        this.changeDepartamento();
        this.changeProvincia();
    },
    methods: {    
        saveChangesCliente(){
            var _this = this;
            const url = "/sending/new/changes/cliente";

            if(this.validateInputs()){
                axios.put(url, this.cliente).then(function (response) {
                    _this.$store.state.clienteEdited = response.data;
                    _this.$store.state.currentContent = _this.$store.state.subItems[2];
                }).catch(function (error) {
                    //error
                });
            }else{
                this.alertState = true;
                setTimeout(function(){
                    _this.alertState = false;
                }, 2000);
                
            }
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
        validateInputs(){
            if(this.cliente.concesionarios!=""&&
                this.cliente.departamentos!=""&&
                this.cliente.provincias!=""&&
                this.cliente.distritos!=""&&
                this.cliente.nombres!=""&&
                this.cliente.apellidos!=""&&
                this.cliente.dni!=""&&
                this.cliente.nro_telefono!=""&&
                this.cliente.direccion!=""){
                    return true;
            }else{
                return false;
            }
        },
        backList(){
            console.log('hola');
            this.$store.state.currentContent = this.$store.state.subItems[2];
        },
        changeDepartamento(){
            this.provincias = this.ubigeo.getRegions(this.cliente.departamento).provinces();
        },
        changeProvincia(){
            this.distritos = this.ubigeo.getProvinces(this.cliente.provincia).districts();
        }
    }
}
</script>