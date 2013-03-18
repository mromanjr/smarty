/**
* -------------------------------------------------------------------------------
* Classe Mascaras 1.0
*	Funções gerais para mascarar campos de formulário
* -------------------------------------------------------------------------------
* Criado em....: 16/03/2007
* Alterado em..: 14/09/2007
* -------------------------------------------------------------------------------
* Changelog
* 
* 19/06/2007
*	- Adicionado o parâmetro 'sAttrName'
*	- Alterada a classe 'Restrict Class v1.0'. Agora ele captura os objetos
*	  pelo id
*
* 31/08/2007
*	- Alterado o nome das funções da classe 'Event Listener'. Foi adicionado um
*	  '_' em todas as funções para evitar que conflitem com as que fazem parte
*	  da biblioteca 'MooTools'
*
* 10/09/2007
*	- Algumas funções que eram compartilhadas com a classe 'ValidaForm' foram
*	  separadas e incluídas na classe 'Utils'
*	- A classe agora é um objeto já declarado (não precisa ser inicializado)
*	- O método 'start' agora permite que os campos sejam mascarados sem que o
*	  o código (X)HTML seja invalidado. São duas opções:
*		- Tradicional
*		  Informe o nome do formulário como primeiro argumento. O formulário será
*		  rastreado e os atributos {sAttrName} serão catalogados.
*		- (X)HTML válido
*		  Informe o nome do formulário como primeiro argumento e um hash como
*		  segundo parâmetro. O hash deve ser da seguinte forma:
*		  -- ID_DO_CAMPO: 'MASCARA' --
*		  O valor para ser inserido em 'MASCARA' continua inalterado.
* 
* 14/09/2007
*	- As classes 'Event Listener Function v1.4' e 'Restrict Class v1.0' foram
* 	  remanejadas para o arquivo 'utils.js'
*	- Está mais fácil de identificar se um objeto foi mascarado incorretamente,
*	  pois uma vez que isto aconteça, o campo fica desabilitado e exibe uma
*	  mensagem de erro
*	- Alguns elementos foram melhor segmentados, facilitando a inclusão de novas
*	  máscaras (principalmente em tempo real)
*	- Agora é possível criar novas máscaras em tempo real, graças ao método
* 	  'custom'. Ex: oMascaras.custom('data_mysql', '\\d', '####-##-##');
* -------------------------------------------------------------------------------
*/

var oMascaras = {
	
	_version: '1.0',
	
	sAttrName: 'msk:pattern',
	
	//---------------------------------------------------------------------------
    
	getVersion: function(){
		return this._version;
	},
	
	catalog: function(){
		this.reset();
		
		var sFormName	= arguments[0];
		var hCollection = arguments[1];
		
		if( oUtils.empty(sFormName) || !document.forms[sFormName]){
			alert('O formulário \'' + sFormName + '\' não existe!');
			return false;
		}
		
		var aElements		 = document.forms[sFormName].elements;
		var aAllowedTypes	 = ['text', 'textarea'];
		var aAllowedPatterns = oUtils.keys(this.patterns);
		
		if( false === !!hCollection || 'object' != oUtils.$type(hCollection) ){
			var sAttribute = null;
			hCollection = {};
			
			for(var i=0;i<aElements.length;i++){
				if( -1 === oUtils.inArray(aElements[i].type, aAllowedTypes) )
					continue;
				
				sAttribute = oUtils.readAttribute(aElements[i], this.sAttrName) || '';
				
				if( !oUtils.empty(sAttribute) )
					hCollection[( oUtils.readAttribute(aElements[i], 'id') || oUtils.readAttribute(aElements[i], 'name') )] = sAttribute;
			}
		}
		
		var sPattern = '';
		var aArgs	 = [];
				
		for(var sId in hCollection){
			sPattern = hCollection[sId];
			aArgs	 = [];
			
			if( (!sPattern || 'string' != oUtils.$type(sPattern)) && !oUtils.empty(sPattern) )
				continue;
			
			aArgs	 = sPattern.split(';');
			sPattern = aArgs.shift();
			
			if( -1 < oUtils.inArray(sPattern, aAllowedPatterns) ){
				oMascaras.patterns[sPattern](sId, aArgs);
			}
			else{
				oUtils.$(sId).value = '[Mascaras.Error] ' + sPattern;
				oUtils.$(sId).disabled = true;
			}
		}
	},
	
	start: function(sFormName){
		this.catalog(sFormName, arguments[1]);
		
		var oField	  = null;
		var oRestrict = new Restrict(sFormName);
		
		for(var i=0;i<this.patterns.aMascaras.length;i++){
			hField = this.patterns.aMascaras[i];
			
			oRestrict.field[hField.name] = hField.filter;
			oRestrict.mask[hField.name]	 = hField.format;
		}
		
		oRestrict.start();
	},
	
	reset: function(){
		this.patterns.aMascaras = [];
	}
	
};

/**
* SubClasse patterns
*/
oMascaras.patterns = {
	
	aMascaras: [],
	
	register: function(sName, sFilter, sFormat){
		this.aMascaras.push({name: sName, filter: sFilter, format: sFormat});
	},
	
	custom: function(sPattern, sFilter, sFormat){
		oMascaras.patterns[sPattern] = function(){
			oMascaras.patterns.register(arguments[0], sFilter, sFormat);
		};
	},
	
	//---------------------------------------------------------------------------
    
	cep: function(){
		this.register(arguments[0], '\\d', '#####-###');
	},
	
	cpf: function(){
		this.register(arguments[0], '\\d', '###.###.###-##');
	},
	
	cnpj: function(){
		this.register(arguments[0], '\\d', '##.###.###/####-##');
	},
	
	data: function(){
		this.register(arguments[0], '\\d', '##/##/####');
	},
	
	hora: function(){
		this.register(arguments[0], '\\d', '##:##');
	},
	
	telefone: function(){
		this.register(arguments[0], '\\d', '(##) ####-####');
	},
	
	telefoneInternacional: function(){
		this.register(arguments[0], '\\d', '+## ## ####-####');
	},
	
	numeros: function(){
		var iMaximo	 = arguments[1][0] || 4;
		var bDecimal = arguments[1][1] || false;
		var sFormat = '';
		
		for(var i=0;i<iMaximo;i++)
			sFormat += '#';
		
		this.register(arguments[0], ((!bDecimal) ? '\\d' : '.\\d'), sFormat);
	},
	
	moeda: function(){
		var oElement = oUtils.$(arguments[0]);
		var oEvent	 = arguments[1];
		var iMaximo	 = (arguments[2] && arguments[2] > 0) ? arguments[2] : 8;
		
		var iTecla	  = oEvent.which || oEvent.keyCode;
		var sChrTecla = String.fromCharCode(iTecla).toUpperCase();
		
		var iAjusteDecimal = ('keyup' == oEvent.type) ? 2 : 1;
		
		var sValue = oUtils.getValue(oElement);
		
		switch(sChrTecla){
			case '.':
				return false;
				 
			case '-':
				if(iMaximo > sValue.length)
					return true;
		}
		
		switch(iTecla){
			case oUtils.keyboard.BACKSPACE:
			case oUtils.keyboard.TAB:
			case oUtils.keyboard.ESC:
			case oUtils.keyboard.LEFT:
			case oUtils.keyboard.UP:
			case oUtils.keyboard.RIGHT:
			case oUtils.keyboard.DOWN:
			case oUtils.keyboard.DELETE:
			case oUtils.keyboard.HOME:
			case oUtils.keyboard.END:
			case oUtils.keyboard.PAGEUP:
			case oUtils.keyboard.PAGEDOWN:
				return true;
			
			case oUtils.keyboard.KEY_RETURN:
				return false;
				
			default:
				if(48 > iTecla || 57 < iTecla){
					if(oEvent.preventDefault){
						oEvent.preventDefault();
						oEvent.stopPropagation();
					}
					else{
						oEvent.returnValue = false;
						oEvent.cancelBubble = true;
					}
					
					oElement.value = oUtils.readAttribute(oElement, 'buffervalue') || '';
					return false;
				}
				
				if( oUtils.readAttribute(oElement, 'buffervalue') && iMaximo <= oUtils.readAttribute(oElement, 'buffervalue').length ){
					if(iMaximo < sValue.length)
						oElement.value = (oUtils.readAttribute(oElement, 'buffervalue')) ? oUtils.readAttribute(oElement, 'buffervalue') : '';
					
					oElement.setAttribute('buffervalue', oUtils.getValue(oElement));
					return false;
				}
				
				var sConteudo	= sValue.replace('.', '');
				oElement.value	= sConteudo.substring(0, sConteudo.length-iAjusteDecimal) + '.' + sConteudo.substring(sConteudo.length-iAjusteDecimal, sConteudo.length);
				
				oElement.setAttribute('buffervalue', oUtils.getValue(oElement));
				break;
		}
		
		return false;
	}

};

/**
* Atalho para oMascaras.patterns.custom
*/
oMascaras.custom = oMascaras.patterns.custom;

/**
* Atalho para oMascaras.patterns.moeda
*/
oMascaras.moeda = oMascaras.patterns.moeda;

/**
* SubClasse misc
*/
oMascaras.misc = {
	
	textareaLimit: function(oElement, iMaximo){
		var sName	  = oUtils.readAttribute(oElement, 'name');
		var iTamanho  = oUtils.getValue(oElement).length; 
		var iDigitado = 0;
		
		iDigitado = iDigitado + iTamanho;
		
		oUtils.$(sName + '_digitado').innerHTML = iDigitado + ' digitados ';
		oUtils.$(sName + '_restante').innerHTML = (iMaximo - iDigitado) + ' restantes ';
	
		if(iMaximo < iTamanho){ 
			var sAux = oUtils.getValue(oElement);
			oElement.value = sAux.substring(0, iMaximo); 
			
			oUtils.$(sName + '_digitado').innerHTML = iMaximo + ' digitados ';
			oUtils.$(sName + '_restante').innerHTML = ' 0 restantes ';
		}
	},
	
	gotoNext: function(sIdOrigem, sIdDestino, iTamanho){
		if(iTamanho == oUtils.getValue(sIdOrigem).length)
			oUtils.$(sIdDestino).focus();
	}
	
};