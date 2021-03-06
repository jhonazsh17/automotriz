export default {
	state: {
		//toda la data store
		titleContent: "",
		clienteInsert: "",
		clienteInserted: "",
		clienteEdit: "",
		clienteEdited: "",
		clienteReset: "",
		clienteRemove: "",
		clienteDetail: "",
		clienteRemoved: "",
		currentContent: {},
		subItems: [
			{
				title: "Panel Principal",
				id: 0,
				parent: 0,
				inMenu: false
			},
			{
				title: "Crear Cliente",
				id: 1,
				parent: 1,
				inMenu: true
			},
			{
				title: "Lista de Clientes",
				id: 2,
				parent: 1,
				inMenu: true
			},
			{
				title: "Generar Reporte",
				id: 3,
				parent: 2,
				inMenu: true
			},
			{
				title: "Editar Cliente",
				id: 4,
				parent: 1,
				inMenu: false,
			},
			{
				title: "Eliminar Cliente",
				id: 5,
				parent: 1,
				inMenu: false
			},
			{
				title: "Detalle de Cliente",
				id: 6,
				parent: 1,
				inMenu: false
			},
			{
				title: "Clientes Eliminados",
				id: 7,
				parent: 1,
				inMenu: false
			}
		],
		concesionarios: [],
    },
	getters: {},
	actions: {
		
	},
	mutations: {
		
    }
}