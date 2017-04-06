/* ESTÁGIO DE PROGRAMADOR java,javascript,php x-ON Creative
 * Whatsapp's +5598999883372, +5599988615593
*/

function selecaoXONCreative() {
	
	var perfil = ["Curticao", "Shopping", "Vida Loka", "Fazer a diferenca"];
	for (var i = 0; i < perfil.length; i++) {
		if (perfil[i] === 'Fazer a diferenca') {
			text += "Viva para " + perfil[i] +"\n";
		};
	};
	document.getElementById("myTextarea").innerHTML = text;
};

$(selecaoXONCreative);
