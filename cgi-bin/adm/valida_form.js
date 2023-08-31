$( document ).ready( function () {
	
	/*
	$("#formulario").validate({
		errorLabelContainer: $("#formulario div.error"),
		wrapper: 'li'	
	});

	$("#fisica").validate({
		errorLabelContainer: $("#fisica div.error"),
		wrapper: 'li'
		
	});

	$("#juridica").validate({
		errorLabelContainer: $("#juridica div.error"),
		wrapper: 'li'
		
	});
	*/
	
	// Clientes PF
	$( "#fisica" ).validate( {
		rules: {
			nome: "required",
			email: {
				required: true,
				email: true
			}
		},
		messages: {
			nome: "",
			email: ""
		},
		errorElement: "em",
		errorPlacement: function ( error, element ) {
			// Add the `invalid-feedback` class to the error element
			error.addClass( "invalid-feedback" );
		
			if ( element.prop( "type" ) === "checkbox" ) {
				error.insertAfter( element.next( "label" ) );
			} else {
				error.insertAfter( element );
			}
		},
		highlight: function ( element, errorClass, validClass ) {
			$( element ).addClass( "is-invalid" ).removeClass( "is-validxxx" );
		},
		unhighlight: function (element, errorClass, validClass) {
			$( element ).addClass( "is-validxxxx" ).removeClass( "is-invalid" );
		}
	} );


	// Clientes PJ
	$( "#juridica" ).validate( {
		rules: {
			nome: "required",
			email: {
				required: true,
				email: true
			}
		},
		messages: {
			nome: "",
			email: ""
		},
		errorElement: "em",
		errorPlacement: function ( error, element ) {
			// Add the `invalid-feedback` class to the error element
			error.addClass( "invalid-feedback" );
		
			if ( element.prop( "type" ) === "checkbox" ) {
				error.insertAfter( element.next( "label" ) );
			} else {
				error.insertAfter( element );
			}
		},
		highlight: function ( element, errorClass, validClass ) {
			$( element ).addClass( "is-invalid" ).removeClass( "is-validzzz" );
		},
		unhighlight: function (element, errorClass, validClass) {
			$( element ).addClass( "is-validzzz" ).removeClass( "is-invalid" );
		}
	} );


	// Medicamentos
	$( "#produtos" ).validate( {
		rules: {
			nome: "required",
			fabricante: "required",
			conservacao: "required",
			p_ativo: "required"
		},
		messages: {
			nome: "",
			fabricante: "",
			conservacao: "",
			p_ativo: ""
		},
		errorElement: "em",
		errorPlacement: function ( error, element ) {
			// Add the `invalid-feedback` class to the error element
			error.addClass( "invalid-feedback" );
		
			if ( element.prop( "type" ) === "checkbox" ) {
				error.insertAfter( element.next( "label" ) );
			} else {
				error.insertAfter( element );
			}
		},
		highlight: function ( element, errorClass, validClass ) {
			$( element ).addClass( "is-invalid" ).removeClass( "is-validzzz" );
		},
		unhighlight: function (element, errorClass, validClass) {
			$( element ).addClass( "is-validzzz" ).removeClass( "is-invalid" );
		}
	} );

	// Fabricante
	$( "#fabricante" ).validate( {
		rules: {
			nome: "required",
			status: "required"
		},
		messages: {
			nome: "",
			status: ""
		},
		errorElement: "em",
		errorPlacement: function ( error, element ) {
			// Add the `invalid-feedback` class to the error element
			error.addClass( "invalid-feedback" );
		
			if ( element.prop( "type" ) === "checkbox" ) {
				error.insertAfter( element.next( "label" ) );
			} else {
				error.insertAfter( element );
			}
		},
		highlight: function ( element, errorClass, validClass ) {
			$( element ).addClass( "is-invalid" ).removeClass( "is-validzzz" );
		},
		unhighlight: function (element, errorClass, validClass) {
			$( element ).addClass( "is-validzzz" ).removeClass( "is-invalid" );
		}
	} );



	// Fornecedores
	$( "#fornecedores" ).validate( {
		rules: {
			nome: "required",
			status: "required",
			endereco: "required",
			nro: "required",
			bairro: "required",
			cidade: "required",
			uf: "required",
			origem: "required",
			tel: "required",
			email: {
				required: true,
				email: true
			}
		},
		messages: {
			nome: "",
			status: "",
			endereco: "",
			nro: "",
			bairro: "",
			cidade: "",
			uf: "",
			origem: "",
			tel: "",
			email: ""
		},
		errorElement: "em",
		errorPlacement: function ( error, element ) {
			// Add the `invalid-feedback` class to the error element
			error.addClass( "invalid-feedback" );
		
			if ( element.prop( "type" ) === "checkbox" ) {
				error.insertAfter( element.next( "label" ) );
			} else {
				error.insertAfter( element );
			}
		},
		highlight: function ( element, errorClass, validClass ) {
			$( element ).addClass( "is-invalid" ).removeClass( "is-validzzz" );
		},
		unhighlight: function (element, errorClass, validClass) {
			$( element ).addClass( "is-validzzz" ).removeClass( "is-invalid" );
		}
	} );

	// Parceiros
	$( "#parceiros" ).validate( {
		rules: {
			tipo: "required",
			nome: "required",
			status: "required",
			endereco: "required",
			nro: "required",
			bairro: "required",
			cidade: "required",
			uf: "required",
			origem: "required",
			tel: "required",
			email: {
				required: true,
				email: true
			}
		},
		messages: {
			tipo: "",
			nome: "",
			status: "",
			endereco: "",
			nro: "",
			bairro: "",
			cidade: "",
			uf: "",
			origem: "",
			tel: "",
			email: ""
		},
		errorElement: "em",
		errorPlacement: function ( error, element ) {
			// Add the `invalid-feedback` class to the error element
			error.addClass( "invalid-feedback" );
		
			if ( element.prop( "type" ) === "checkbox" ) {
				error.insertAfter( element.next( "label" ) );
			} else {
				error.insertAfter( element );
			}
		},
		highlight: function ( element, errorClass, validClass ) {
			$( element ).addClass( "is-invalid" ).removeClass( "is-validzzz" );
		},
		unhighlight: function (element, errorClass, validClass) {
			$( element ).addClass( "is-validzzz" ).removeClass( "is-invalid" );
		}
	} );

	
	//Transportadora
	$( "#transportadoras" ).validate( {
		rules: {
			nome: "required",
			status: "required",
			endereco: "required",
			nro: "required",
			bairro: "required",
			cidade: "required",
			uf: "required",
			tel: "required",
			email: {
				required: true,
				email: true
			}
		},
		messages: {
			nome: "",
			status: "",
			endereco: "",
			nro: "",
			bairro: "",
			cidade: "",
			uf: "",
			tel: "",
			email: ""
		},
		errorElement: "em",
		errorPlacement: function ( error, element ) {
			// Add the `invalid-feedback` class to the error element
			error.addClass( "invalid-feedback" );
		
			if ( element.prop( "type" ) === "checkbox" ) {
				error.insertAfter( element.next( "label" ) );
			} else {
				error.insertAfter( element );
			}
		},
		highlight: function ( element, errorClass, validClass ) {
			$( element ).addClass( "is-invalid" ).removeClass( "is-validzzz" );
		},
		unhighlight: function (element, errorClass, validClass) {
			$( element ).addClass( "is-validzzz" ).removeClass( "is-invalid" );
		}
	} );





	//usuarios
	$( "#cad_usuario" ).validate( {
		rules: {
			nome: "required",
			usual: "required",
			nivel: "required",
			cel: "required",
			login: "required",
			senha: "required",
			senha2: "required",
			cargo_pt: "required",
			cargo_ing: "required",
			email: {
				required: true,
				email: true
			}
		},
		messages: {
			nome: "",
			usual: "",
			nivel: "",
			cel: "",
			login: "",
			senha: "",
			senha2: "",
			cargo_pt: "",
			cargo_ing: "",
			email: ""
		},
		errorElement: "em",
		errorPlacement: function ( error, element ) {
			// Add the `invalid-feedback` class to the error element
			error.addClass( "invalid-feedback" );
		
			if ( element.prop( "type" ) === "checkbox" ) {
				error.insertAfter( element.next( "label" ) );
			} else {
				error.insertAfter( element );
			}
		},
		highlight: function ( element, errorClass, validClass ) {
			$( element ).addClass( "is-invalid" ).removeClass( "is-validzzz" );
		},
		unhighlight: function (element, errorClass, validClass) {
			$( element ).addClass( "is-validzzz" ).removeClass( "is-invalid" );
		}
	} );



	$( "#edit_usuario" ).validate( {
		rules: {
			nome: "required",
			usual: "required",
			nivel: "required",
			cel: "required",
			login: "required",
			cargo_pt: "required",
			cargo_ing: "required",
			email: {
				required: true,
				email: true
			}
		},
		messages: {
			nome: "",
			usual: "",
			nivel: "",
			cel: "",
			login: "",
			cargo_pt: "",
			cargo_ing: "",
			email: ""
		},
		errorElement: "em",
		errorPlacement: function ( error, element ) {
			// Add the `invalid-feedback` class to the error element
			error.addClass( "invalid-feedback" );
		
			if ( element.prop( "type" ) === "checkbox" ) {
				error.insertAfter( element.next( "label" ) );
			} else {
				error.insertAfter( element );
			}
		},
		highlight: function ( element, errorClass, validClass ) {
			$( element ).addClass( "is-invalid" ).removeClass( "is-validzzz" );
		},
		unhighlight: function (element, errorClass, validClass) {
			$( element ).addClass( "is-validzzz" ).removeClass( "is-invalid" );
		}
	} );


	//pedidos_1
	$( "#pedidos_cad" ).validate( {
		rules: {
			p_cliente: "required",
			parceiro: "required",
			fornecedor: "required",
			moeda: "required",
			transportadora: "required",
			modalidade: "required",
			incoterm: "required",
			frete_custo: "required",
			frete_venda: "required"
		},
		messages: {
			p_cliente: "",
			parceiro: "",
			fornecedor: "",
			moeda: "",
			transportadora: "",
			modalidade: "",
			incoterm: "",
			frete_custo: "",
			frete_venda: ""
		},
		errorElement: "em",
		errorPlacement: function ( error, element ) {
			// Add the `invalid-feedback` class to the error element
			error.addClass( "invalid-feedback" );
		
			if ( element.prop( "type" ) === "checkbox" ) {
				error.insertAfter( element.next( "label" ) );
			} else {
				error.insertAfter( element );
			}
		},
		highlight: function ( element, errorClass, validClass ) {
			$( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
		},
		unhighlight: function (element, errorClass, validClass) {
			$( element ).addClass( "is-validzzz" ).removeClass( "is-invalid" );
		}
	} );


/***************************************************/
} );