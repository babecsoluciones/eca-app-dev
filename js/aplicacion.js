function validarUsuario()
{
	var passwdOperaciones = document.getElementById('tPasswordOperaciones'),
		passwdVerificador = document.getElementById('tPasswordVerificador'),
		btnGuardar = document.getElementById('btnGuardar'),
		btnValidar = document.getElementById('btnValidar');
	
	if(passwdOperaciones.value == passwdVerificador.value)
		{
			btnGuardar.disabled = false;
            passwdOperaciones.style.display = 'none';
            btnValidar.style.display = 'none';
		}
}

function fnRedireccionar(seccion)
{
	window.location = seccion;
}

function cerrarSesion()
{
	if(confirm("Realmente deseas salir?"))
		{
			window.location="/logout/";
		}
}

function activarValidacion()
{
    document.getElementById('tPasswordOperaciones').style.display = 'inline';
    
    document.getElementById('tPasswordOperaciones').focus();
}

function consultarFecha()
{
	var formulario = document.getElementById('datos');
    
			formulario.submit();
	
}

