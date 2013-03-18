/**
* -------------------------------------------------------------------------------
* Classe ValidaForm 1.0 beta1
*	Validação de formulários via DHTML e JavaScript
* -------------------------------------------------------------------------------
* Criado em....: 01/05/2006
* Alterado em..: 15/03/2007
* -------------------------------------------------------------------------------
*/

var oValidaForm = {
	
	_version: '1.0 beta1',
	
	sAttrName: 'vf:validate',
	sErrorAttrName: 'vf:errormsg',
	
	sFormName: '',
	oForm: null,
	
	aValidate: [],
	aElements: [],
	
	//---------------------------------------------------------------------------
    
	getVersion: function(){
		return this._version;
	},
	
	addValidation: function(sName, sValidation, aArgs){
		var sValidationId = sName + ';' + sValidation;
		
		if( -1 === oUtils.inArray(sValidationId, this.aElements) ){
			this.aValidate.push({name: sName, validation: sValidation, args: aArgs});
			this.aElements.push(sValidationId);
		}
	},
	
	catalog: function(){
		this.reset();
		
		this.sFormName	= arguments[0];
		this.oForm		= document.forms[this.sFormName];
		
		var hCollection	= arguments[1];
		
		if( !this.oForm ){
			alert('O formulário \'' + this.sFormName + '\' não existe!');
			return false;
		}
		
		var aElements			= this.oForm.elements;
		var aAllowedValidators	= oUtils.keys(this.validators);
		var aAllowedTypes		= ['text', 'textarea', 'password', 'select-one', 'select-multiple'];
		
		if( false === !!hCollection || 'object' != oUtils.$type(hCollection) ){
			var sAttribute = null;
			hCollection = {};
			
			for(var i=0;i<aElements.length;i++){
				if( -1 === oUtils.inArray(aElements[i].type, aAllowedTypes) )
					continue;
				
				sAttribute = oUtils.readAttribute(aElements[i], this.sAttrName) || '';
				
				if( !oUtils.empty(sAttribute) )
					hCollection[( oUtils.readAttribute(aElements[i], 'name') || oUtils.readAttribute(aElements[i], 'id') )] = sAttribute;
			}
		}
		
		var sValidate = null;
		var aValidate = [];
		var aArgs	  = [];
		
		for(var sName in hCollection){
			sValidate = hCollection[sName];
			
			if( (!sValidate || 'string' != oUtils.$type(sValidate)) && !oUtils.empty(sValidate) )
				continue;
			
			aValidate = sValidate.split('|');
			
			for(var j=0;j<aValidate.length;j++){
				aArgs	  = aValidate[j].split(';');
				sValidate = aArgs.shift();
				
				if( -1 < oUtils.inArray(sValidate, aAllowedValidators) )
					this.addValidation(sName, sValidate, aArgs);
			}
		}
	},
	
	validate: function(sFormName){
		this.catalog(sFormName, arguments[1]);
		
		for(var i=0;i<this.aValidate.length;i++)
			this.validators[this.aValidate[i].validation](this.aValidate[i].name, this.aValidate[i].args);
		
		if(!this.error.has())
			return true;
		
		this.error.show();
		return false;
	},
	
	reset: function(){
		this.sFormName	= '';
		this.oForm		= null;
		
		this.aValidate = [];
		this.aElements = [];
		
		this.error.reset();
	}
	
};

//-------------------------------------------------------------------------------

oValidaForm.validators = {

	vazio: function(sName){
		if( oUtils.empty(oUtils.getValue(sName)) )
			oValidaForm.error.set(sName, 'vazio');
	},
	
	minimo: function(sName, iMinimo){
		if( iMinimo > oUtils.getValue(sName).length )
			oValidaForm.error.set(sName, 'minimo');
	},
	
	email: function(sName){
		if( !this.tests.email(oUtils.getValue(sName)) )
			oValidaForm.error.set(sName, 'email');
	},
	
	data: function(sName){
		if( !this.tests.data(oUtils.getValue(sName)) )
			oValidaForm.error.set(sName, 'data');
	},
	
	hora: function(sName){
		if( !this.tests.hora(oUtils.getValue(sName)) )
			oValidaForm.error.set(sName, 'hora');
	},
	
	cpf: function(sName){
		if( !this.tests.cpf(oUtils.getValue(sName)) )
			oValidaForm.error.set(sName, 'cpf');
	},
	
	cnpj: function(sName){
		if( !this.tests.cnpj(oUtils.getValue(sName)) )
			oValidaForm.error.set(sName, 'cnpj');
	},
	
	check: function(sName){
		var oElement  = this.oForm[sName];
		var iMinimo	  = arguments[1][0] || 1;
		var iMarcados = 0;
		
		if( 0 < oElement.length ){
			for(var i=0;i<oElement.length;i++)
				if(true == oElement[i].checked)
					iMarcados++;
		}
		else{
			if(true == oElement.checked)
				iMarcados++;
		}
		
		if(iMinimo > iMarcados)
			oValidaForm.error.set(sName, 'check');
	},
	
	comparar: function(sName){
		var mValorComparado = arguments[1][0] || '';
		var sOpLogico		= arguments[1][1] || 'DIFERENTE';
		
		switch(sOpLogico){
			case 'MAIOR': 		sOpLogico = '>';  break;
			case 'MAIOR_IGUAL': sOpLogico = '>='; break;
			case 'MENOR': 		sOpLogico = '<';  break;
			case 'MENOR_IGUAL': sOpLogico = '<='; break;
			case 'IGUAL': 		sOpLogico = '=='; break;
			case 'DIFERENTE': 	sOpLogico = '!='; break;
		}
		
		var mValor1, mValor2;
		
		if( 'number' == oUtils.$type(mValorComparado) && !isNaN(mValorComparado) ){
			mValor1 = parseFloat(oUtils.getValue(sName));
			mValor2 = parseFloat(mValorComparado);
		}
		else{
			mValor1 = "'" + oUtils.getValue(sName) + "'";
			mValor2 = "'" + mValorComparado + "'";
		}
		
		if( eval(mValor1 + sOpLogico + mValor2) )
			oValidaForm.error.set(sName, 'comparar');
	}
	
};

oValidaForm.validators.tests = {
    
	domain: function(sDomain){
		return /^[a-z0-9][a-z0-9\-]+(\.?[a-z0-9\-]+){0,2}\.[a-z]{2,3}$/.test(sDomain);
	},
	
	email: function(sEmail){
		if( oUtils.empty(sEmail) )
			return true;
		
		var aDados = sEmail.split('@');
		
		if(this.domain(aDados[1]))
			return /^[0-9a-z][0-9a-z\-\.\_]+$/.test(aDados[0]);
		
		return false;
	},
	
	//---------------------------------------------------------------------------
    
    data: function(sData){
		if( !oUtils.empty(sData) ){
			var iErro = 0;
			var aData = new Array();
			
			if( (10 > sData.length) || ('/' != sData.charAt(2) || '/' != sData.charAt(5)) ) iErro++;
			
			aData = sData.split('/');
			var iDia = aData[0], iMes = aData[1], iAno = aData[2];
			
			if( (1 > iMes || 12 < iMes) || (1000 > iAno) ) iErro++;
			
			switch(iMes){
				case '02':
					if(1 > iDia || 29 < iDia) iErro++;
					break;
				
				case '04':
				case '06':
				case '09':
				case '11':
					if(1 > iDia || 30 < iDia) iErro++;
					break;
				
				default:
					if(1 > iDia || 31 < iDia) iErro++;
					break;
			}
			
			if(0 < iErro)
				return false;
		}
		
		return true;
	},
	
	hora: function(sHora){
		if( !oUtils.empty(sHora) ){
			var iErro = 0;
			var aHora = [];
			var iIndiceHora = (arguments[1] && !oUtils.empty(arguments[1])) ? arguments[1] : 23;
			
			if(':' != sHora.charAt(2))
				iErro++;
			
			aHora = sHora.split(":");
			var iHora = aHora[0], iMinuto = aHora[1];
			
			if(23 < iHora) iErro++;
			if(59 < iMinuto) iErro++;
			
			if(0 < iErro)
				return false;
		}
		
		return true;
	},
	
	//---------------------------------------------------------------------------
	
	cpf: function(sCPF){
		if( !oUtils.empty(sCPF) ){
			var iErro	   = 0;
			var aInvalidos = ['00000000000', '11111111111', '22222222222', '33333333333', '44444444444', '55555555555', '66666666666', '77777777777', '88888888888', '99999999999'];
			var x		   = '';
			
			sCPF = sCPF.replace(/\./g, '');
			sCPF = sCPF.replace(/\-/, '');
			
			if (11 > sCPF.length || -1 < oUtils.inArray(sCPF, aInvalidos))
				iErro++;
			
			var a = [];
			var b = 0;
			var c = 11;
			
			for(var i=0;i<11;i++){
				a[i] = sCPF.charAt(i);
				if (i < 9) b += (a[i] * --c);
			}
			
			if ((x = b % 11) < 2) { a[9] = 0 } else { a[9] = 11-x }
			b = 0;
			c = 11;
			
			for(var y=0; y<10; y++) b += (a[y] * c--);
			if((x = b % 11) < 2) { a[10] = 0; } else { a[10] = 11-x; }
			if((sCPF.charAt(9) != a[9]) || (sCPF.charAt(10) != a[10]))	iErro++;
			
			if(0 < iErro)
				return false;
		}
		
		return true;
	},
	
	cnpj: function(sCNPJ){
		if( !oUtils.empty(sCNPJ) ){
			var iErro = 0;
			var x	  = '';
			
			sCNPJ = sCNPJ.replace(/\./g, '');
			sCNPJ = sCNPJ.replace(/\//, '');
			sCNPJ = sCNPJ.replace(/\-/, '');
			
			var a = [];
			var b = 0;
			var c = [6,5,4,3,2,9,8,7,6,5,4,3,2];
			
			for(var i=0;i<12;i++){
				a[i] = sCNPJ.charAt(i);
				b += a[i] * c[i+1];
			}
			
			if ((x = b % 11) < 2) { a[12] = 0 } else { a[12] = 11-x }
			b = 0;
			
			for(var y=0; y<13; y++) b += (a[y] * c[y]);
			if((x = b % 11) < 2) { a[13] = 0; } else { a[13] = 11-x; }
			if((sCNPJ.charAt(12) != a[12]) || (sCNPJ.charAt(13) != a[13])) iErro++;
			
			if(0 < iErro)
				return false;
		}
		
		return true;
	}
	
};

oValidaForm.error = {
	
	aElements: [],
	aList: [],
	
	getElements: function(){
		var aElements = [];
		
		for(var i=0;i<this.aElements.length;i++)
			aElements.push(oValidaForm.oForm[this.aElements[i].name]);
		
		return aElements;
	},
	
	getList: function(){
		return this.aList;
	},
	
	getAlertResources: function(){
		return {
			msg: oValidaForm.messages.aviso,
			list: this.getList(),
			replace: '--ERROR_LIST--'
		};
	},
	
	set: function(sName, sValidatorName){
		this.aElements.push({name: sName, validator: sValidatorName});
	},
	
	has: function(){
		return (0 < this.aElements.length);
	},
	
	alert: function(){
		var hAlert = this.getAlertResources();
		alert(oValidaForm.messages.evaluate(hAlert.msg, hAlert.replace, hAlert.list.toString().replace(/,/g, '\n')));
	},
	
	show: function(){
		var sMsg   = '';
		var aAlert = [];
		
		if( this.has() ){
			for(var i=0;i<this.aElements.length;i++){
				sMsg = this.getMsg(this.aElements[i].name, this.aElements[i].validator);
				
				if( -1 === oUtils.inArray(sMsg, aAlert) )
					this.aList.push(sMsg);
			}
			
			if(0 < this.aList.length)
				this.alert();
		}
	},
	
	getMsg: function(sName, sValidatorName){
		var sMsg = oUtils.readAttribute(sName, oValidaForm.sErrorAttrName);
		
		if( (!sMsg || oUtils.empty(sMsg)) && !oUtils.empty(sValidatorName) )
			sMsg = oValidaForm.messages.evaluate(oValidaForm.messages[sValidatorName], '--FIELD_LABEL--', (oUtils.getHint(sName) || ('[' + oUtils.readAttribute(sName, 'name') + ']')));
		
		return sMsg;
	},
	
	reset: function(){
		this.aElements = [];
		this.aList	   = [];
	}
	
};

oValidaForm.messages = {
	
	aviso: 'Os seguinte erros ocorreram:\n\n--ERROR_LIST--',
	
	vazio:		'O campo "--FIELD_LABEL--" deve ser preenchido.',
	check:		'O campo "--FIELD_LABEL--" não possui o mínimo exigido de opções selecionadas.',
	minimo:		'O campo "--FIELD_LABEL--" não possui o mínimo exigido de caracteres.',
	email:		'O campo "--FIELD_LABEL--" possui um e-mail inválido.',
	comparar:	'O campo "--FIELD_LABEL--" possui um valor incompatível.',
	data:		'O campo "--FIELD_LABEL--" possui uma data inválida.',
	hora:		'O campo "--FIELD_LABEL--" possui uma hora inválida.',
	cpf:		'O campo "--FIELD_LABEL--" possui um CPF inválido.',
	cnpj:		'O campo "--FIELD_LABEL--" possui um CNPJ inválido.',
	
	evaluate: function(sString, aMatches, aReplaces){
		if('string' == oUtils.$type(aMatches))
			aMatches = [aMatches];
		
		if('string' == oUtils.$type(aReplaces))
			aReplaces = [aReplaces];
		
		for(var i=0;i<aMatches.length;i++)
			sString = sString.replace(aMatches[i], aReplaces[i]);
		
		return sString;
	}
	
};

oValidaForm.utils = {
	
	criaComparacao: function(oElement, mValorComparado, sOpLogico){
		var aAllowedTypes = new Array('MAIOR', 'MAIOR_IGUAL', 'MENOR', 'MENOR_IGUAL', 'IGUAL', 'DIFERENTE');
		
		if( oUtils.inArray(sOpLogico, aAllowedTypes) ){
			var sValidate = '|' + oUtils.getAttribute(oValidaForm.sAttrName) || '';
			
			oElement.setAttribute(oValidaForm.sAttrName, 'comparar;' + mValorComparado + ';\'' + sOpLogico + '\'' + sValidate);
			return true;
		}
		else{
			alert('O tipo solicitado não é permitido!');
			return false;
		}
	}
	
};