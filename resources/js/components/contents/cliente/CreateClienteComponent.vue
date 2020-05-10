<template>
    <div>
        <div class="alert alert-warning" role="alert" v-if="alertState">
            Revisar que todos los datos obligatorios con  <a href="#" class="alert-link">(*) asterisco</a> no esten vacíos.
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group margin-supr-bottom-5">
                    <label for="exampleInputEmail1">Concesionario *</label>
                    <select class="form-control" name="" id="" v-model="cliente.concesionario">
                        <option value="" disabled selected>Elegir Concesionario</option>
                        <option v-for="(concesionario, index) in concesionarios" v-bind:key="index" v-bind:value="concesionario.id" >
                            {{concesionario.nombre}}    
                        </option>
                    </select>
                </div>
            </div>
        </div>    
        <hr>
        <form @submit.prevent="saveCliente">
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
                        <input type="text" class="form-control"  placeholder="Ingresar Teléfono" v-model="cliente.telefono">
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
                        <select class="form-control" name="" id="" v-model="cliente.distrito">
                            <option value="" disabled selected>Elegir Distrito</option>
                            <option v-for="(distrito, index) in distritos" v-bind:key="index" v-bind:value="distrito.id">{{distrito.name}} </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3 padding-supr-left-7">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Fecha de Nacimiento</label>
                        <input type="date" class="form-control"  placeholder="Ingresar Departamento" v-model="cliente.fechaNacimiento">
                    </div>
                </div>
            </div>

            <div class="mt-1">
                <button type="submit" class="btn btn-success"><i class="far fa-save"></i>&nbsp; Guardar</button>
            </div>
            
            
        </form>
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
            cliente: {
                nombres: "",
                apellidos: "",
                dni: "",
                telefono: "",
                direccion: "",
                departamento: "01",
                provincia: "",
                distrito: "",
                fechaNacimiento: "",
                concesionario: ""
            },
            alertState: false,
        }    
    },
    created() {
        this.ubigeo = new Ubigeo();
        this.departamentos = this.ubigeo.getRegions();
        this.getAllConcesionarios();
        this.$store.state.clienteEdited = "";
        this.$store.state.clienteInserted = "";
        this.$store.state.clienteRemoved = "";
    },
    methods: {    
        saveCliente(){
            var _this = this;
            const url = "/sending/cliente";

            if(this.validateInputs()){
                axios.post(url, this.cliente).then(function (response) {
                    _this.$store.state.clienteInserted = response.data;
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
                this.cliente.telefono!=""&&
                this.cliente.direccion!=""){
                    return true;
            }else{
                return false;
            }
        },  
        changeDepartamento(){
            this.provincias = this.ubigeo.getRegions(this.cliente.departamento).provinces();            console.log(this.provincias);
        },
        changeProvincia(){
            this.distritos = this.ubigeo.getProvinces(this.cliente.provincia).districts();            console.log(this.provincias);
        }
    }
}
</script>