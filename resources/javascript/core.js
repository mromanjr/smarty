/**
* -------------------------------------------------------------------------------
* @class Core
* 	Classe principal do site. Contém a maior parte dos utilitários.
* -------------------------------------------------------------------------------
*/

var  sXUrl = document.location.href;
sXUrl = document.location.href.split("#");
sXUrl = sXUrl[0];
sXUrl = sXUrl.split("?");
sXUrl = sXUrl[0];


var oCore = {
	
	
	
	/**
	* Inicializa os recursos comuns do site
	*/
	init: function(){
		/**
		* Informação de login
		*/
		this.setLoginBox();
		
		/**
		* Itens do menu superior
		*/
       if($('lnk-top-carrinho') != null){
            $('lnk-top-carrinho').observe('click', function(oEvent){
                oEvent.stop();
                oCarrinhoCompras.openDialog();
            });
        }
		
		/**
		* Comportamento da pesquisa
		*/
        if($('q') != null){
            $('q').observe('focus', function(){
                if($('q').value == 'Digite sua pesquisa aqui'){
                    $('q').value='';
                }
            });

            
            $('q').observe('blur', function(){
                if($('q').value == ''){
                    $('q').value='Digite sua pesquisa aqui';
                }
            });
		}
        if($('bt-pesquisa') != null){
            $('bt-pesquisa').observe('click', function(oEvent){
                oEvent.stop();

                if($F('q').empty()){
                    alert('Por favor, seja mais específico em sua pesquisa!\nPara tanto, sua pesquisa deve conter no mínimo 3 (três) letras.');
                    return false;
                }
                location.href = _globalEnderecoNormal + 'produtos/pesquisa.php?_q=' + escape($F('q'));
                return false;
            });
        }
        if($('pesquisa') != null){
            $('pesquisa').observe('submit', function(oEvent){
                oEvent.stop();

                if($F('q').empty()){
                    alert('Por favor, seja mais específico em sua pesquisa!\nPara tanto, sua pesquisa deve conter no mínimo 3 (três) letras.');
                    return false;
                }
                location.href = _globalEnderecoNormal + 'produtos/pesquisa.php?_q=' + escape($F('q'));
            });
        }
		
		/**
		* Lista de marcas
		
		$('lnk-lista-marcas').observe('click', (function(oEvent){
			oEvent.stop();
			this.Marcas.show();
		}).bind(this));
		*/
		/**
		* Sombra da caixa de departamentos
		*/
		this.setSombraDepartamentos();
	},

    showZoom : function(){
        var sUrl = $('foto-principal').childElements().grep(new Selector("img"))[0].src;
        xajax_showFotoOriginal(sUrl);
    },
	
	abrir : function(){
		window.open("https://www.zelao.com.br/empresa/certificado.php", "cs", "scrollbars=yes, height=450, width=500");
	},

    hideZoom: function(){
        $('overlay').setStyle('display:none;');
        $('photo').setStyle('display:none;');
    },

    showBtZoom : function(){
        $('btzoom').setStyle('display:block');
    },

    hideBtZoom : function(){
        $('btzoom').setStyle('display:none');
    },
	
	//Função para bt-restrito
	
	btRestrito: function(){
        if ($('clientes').getStyle('height') == "20px"){
            $('clientes').setStyle('height: 0px');
            $('bt-restrito').removeClassName('restrito2');
        }else{
            $('clientes').setStyle('height: 20px');
            $('bt-restrito').addClassName('restrito2');
        }
	},

	//---------------------------------------------------------------------------
    
	/**
	* Ajusta o quadro de login 
	*/
	setLoginBox: function(){
		if(!$('user-login') || !$('user-login-sombra'))
			return;
		
		$('user-login-sombra')
			.setStyle('width:' + ($('user-login').getWidth()+6).toString() + 'px;')
			.setOpacity(0.5);
	},
	
	/**
	* Ajusta a sombra do menu
	*/
	setSombraDepartamentos: function(){
		if(!$('sombra-departamentos'))
			return;
		
		$('sombra-departamentos')
			.clonePosition('departamentos', {setTop: false, setLeft: false})
			.setOpacity(0.3);
	},
	
	//---------------------------------------------------------------------------
    
	/**
	* Gerencia o comportamento da pesquisa
	*/
	pesquisa: function(){
		var bReset	 = false;
		var oElement = $('q');
		
		if($F(oElement).empty())
			bReset = true;
		
		if(!bReset){
			if(_globalTextoPadraoPesquisa == $F(oElement))
				oElement.value = '';
			
			oElement.addClassName('ativo');
		}
		else{
			oElement.removeClassName('ativo').value = _globalTextoPadraoPesquisa;
		}
	},
	
	/**
	* Função para inserção dinâmica de dados em combo boxes
	*/
	selectFieldData: function(mElement, bClear, hOptions){
		hOptions = $H(hOptions);
		
		if( 0 < hOptions.get('collection').size() ){
			var oElement = $(mElement);
			var oTemplateLabel = new Template(hOptions.get('template'));
			var oTemplateValue = new Template(hOptions.get('value'));
			
			if(bClear)
				oElement.options.length = 0;
			
			hOptions.get('collection').each(function(hItem){
				hItem = hItem.toObject();
				oElement.options[oElement.options.length] = new Option(unescape(oTemplateLabel.evaluate(hItem)), unescape(oTemplateValue.evaluate(hItem)));
			});
		}
	},
	
	/**
	* Gera a caixa de texto dummy
	*/
	createDummy: function(){
		if( 'undefined' == typeof oUtils || !oUtils.browser.ie6 )
			return;
		
		var oParent = $(arguments[0] || document.body);
		var oDummy  = new Element('input', {type: 'text', name: 'dummy', id: 'dummy'}).setStyle('border-style:none; width:1px; height:1px;');
		
		oParent.insert(oDummy);
	},
	
	/**
	* Tira o foco do objeto e passa para o objeto dummy
	*/
	blur: function(){
		if( 'undefined' == typeof oUtils || !oUtils.browser.ie6 )
			return;
		
		if(!$('dummy')){
			this.createDummy();
        }
		
		$('dummy').focus();
	},
	
	/**
	* Soma todos os elementos númericos de um array
	*/
	arraySum: function(aArray){
		var iSum = 0;
		aArray = $A(aArray);
		
		if(aArray.size() <= 0)
			return 0;
		
		aArray.each(function(mValue){
			if('number' == typeof mValue)
				iSum += mValue;
		});
		
		return iSum;
	},
	
	/**
	* Alternativa para a função nativa 'push', retornando o array ao invés do 
	* tamanho dele
	*/
	arrayPush: function(aArray, mItem){
		aArray.push(mItem);
		return aArray;
	},
	
	/**
	* Janela com o boleto para impressão.
	*/
	abrirBoleto: function(sUrl){
		window.open(unescape(sUrl), 'Janela_Boleto', 'width=720, height=520, menubar=yes, resizable=yes, scrollbars=yes, status=yes');
	},
    
	/**
	* Abre o mapa do Google Maps.
	*/
	abrirMapaLocalizacao: function(){
		window.open(_globalEnderecoNormal + 'empresa/mapa.php', 'Janela_MapaLocalizacao', 'width=680, height=540');
	},
    
    showFamilia: function(j){
        if($('depart['+j+']').hasClassName('hide')){
            $('depart['+j+']').removeClassName('hide');
            $('depart['+j+']').addClassName('show');
        }else{
            $('depart['+j+']').removeClassName('show');
            $('depart['+j+']').addClassName('hide');
        }
    }
};

/**
* -------------------------------------------------------------------------------
* @class Marcas
* @extends Core
* 	Gerencia a lista de marcas, por meio do array '_globalMarcas'
* -------------------------------------------------------------------------------
*/
oCore.Marcas = {
	
	hElements: $H({
		parent: 'container',
		element: 'lista-marcas',
		elementShadow: 'sombra-lista-marcas'
	}),
	
	bCreated: false,
	bVisible: false,
	
	create: function(){
		var sHtml = '';
		
		var sParent			= this.hElements.get('parent');
		var sElement		= this.hElements.get('element');
		var sElementShadow	= this.hElements.get('elementShadow');
		
		if(!$(sElement)){
			$(sParent)
				.insert({ bottom: new Element('div', {id: sElement}) })
				.insert({ bottom: new Element('div', {id: sElementShadow}) });
		}
		
		$(sElement).addClassName('dropdown');
		$(sElementShadow).addClassName('dropdown-shadow').setOpacity(0.3);
		
		for(var i=0;i<_globalMarcas.length;i++)
			sHtml += '<li><a href="#" onclick="location.href=\'' + _globalEnderecoNormal + 'produtos/marcas/index.php?_m=' + _globalMarcas[i].codmarca + '\'; return false;">' + unescape(_globalMarcas[i].marca) + '</a></li>';
		
		$(sElement)
			.update('<ul>' + sHtml + '</ul>');
		
		this.bCreated = true;
		return $(sElement);
	},
	
	show: function(){
		if(!this.bCreated)
			this.create();
		
		if(this.bVisible){
			this.hide();
			return;
		}
		
		$(this.hElements.get('element')).show();
		$(this.hElements.get('elementShadow')).show();
		
		document.observe('click', (function(oEvent){
			oEvent.stop();
			
			if(this.bVisible)
				this.hide();
		}).bind(this));
		
		this.bVisible = true;
	},
	
	hide: function(){
		$(this.hElements.get('element')).hide();
		$(this.hElements.get('elementShadow')).hide();
		
		document.stopObserving('click');
		this.bVisible = false;
	}
	
};

/**
* -------------------------------------------------------------------------------
* @class Dialog
* @extends Core
* 	Utilitário para criação das janelas de diálogo personalizadas do site
* -------------------------------------------------------------------------------
*/
oCore.Dialog = {
	
	aConfig: $H({
		prefixDialog: 'dialog-',
		sufixShadow: '-shadow',
		
		dialogs: $A([]),
		visible: $A([]),
		
		scrollToTypes: $A(['top', 'dialog']),
		
		shadowColor: '#A9BBBF'
	}),
	
	getConfig: function(sKey){
		return this.aConfig.get(sKey);
	},
	
	setConfig: function(sKey, sValue){
		if( -1 < this.aConfig.keys().indexOf(sKey) )
			this.aConfig.set(sKey, sValue);
	},
	
	getId: function(sOriginalId, sType){
		var sNewId = '';
		
		switch(sType){
			case 'dialog':
                sNewId = this.getConfig('prefixDialog') + sOriginalId;
            break;
			
			case 'shadow':
                sNewId = this.getId(sOriginalId, 'dialog') + this.getConfig('sufixShadow');
            break;
			
			case 'title':
			case 'close':
			case 'content':
			case 'buttons':
                sNewId = this.getId(sOriginalId, 'dialog') + '-' + sType;
            break;
		}
		
		return sNewId;
	},
	
	getDialogs: function(){
		return this.getConfig('dialogs');
	},
	
	getVisible: function(){
		return this.getConfig('visible');
	},
	
	getCmp: function(sId, sCmp){
		return $(this.getComponents(sId).get(sCmp));
	},
	
	getComponents: function(sId){
		return $H({
			dialog: this.getId(sId, 'dialog'),
			shadow: this.getId(sId, 'shadow'),
			title: this.getId(sId, 'title'),
			content: this.getId(sId, 'content'),
			buttons: this.getId(sId, 'buttons')
		});
	},
	
	isRendered: function(sOriginalId){
		return !!(-1 < this.getDialogs().indexOf(sOriginalId) && $(this.getComponents(sOriginalId).get('dialog')));
	},
	
	isVisible: function(sOriginalId){
		return !!(-1 < this.getVisible().indexOf(sOriginalId));
	},
	
	//---------------------------------------------------------------------------
    
	create: function(){
		var sOriginalId	= arguments[0];
		
		var sId			= this.getId(sOriginalId, 'dialog');
		var sIdShadow	= this.getId(sOriginalId, 'shadow');
		
		var hSettings = $H( Object.extend({
			title: 'Janela Sem Título',
			content: '<div style="color:#999; text-align:center;">Não há conteúdo para ser exibido nesta janela</div>',
			width: 450,
			position: ['center', 'center'],
			buttons: {},
			statusBar: '',
			scrollTo: 'dialog',
			
			showContentShadow: true,
			hideContentShadow: true,
			
			onRender: function(){},
			onOpen: function(){},
			onClose: function(){},
			onUpdate: function(){}
		}, arguments[1] || {}) );
		
		if( this.isRendered(sOriginalId) ){
			this.open(sOriginalId, hSettings.get('showContentShadow'));
			return;
		}
		
		/**
		* Função padrão para fechar a janela
		*/
		var fnClose = (function(){
			arguments[0].stop(); oCore.Dialog.close(arguments[1], arguments[2]);
		}).bindAsEventListener({}, sOriginalId, hSettings.get('hideContentShadow'));
		
		/**
		* Criação dos objetos
		*/
		$(document.body)
			.insert( new Element('div', {id: sId}) )
			.insert( new Element('div', {id: sIdShadow}) );
		
		var oDialog = $(sId);
		var oShadow = $(sIdShadow);
		
		/**
		* Cria os eventos da janela.
		* Os eventos 'dialog:rendered' e 'dialog:updated' sempre terá alguma
		* funcionalidades padrão (além das programadas pelo usuário).
		*/
		oDialog
			.observe('dialog:rendered', hSettings.get('onRender'))
			.observe('dialog:opened', hSettings.get('onOpen'))
			.observe('dialog:closed', hSettings.get('onClose'))
			.observe('dialog:updated', hSettings.get('onUpdate'));
		
		/**
		* Funções que devem ser executadas nos eventos para garantir o bom
		* funcionamento.
		*/
		oDialog.observe('dialog:rendered', (function(){
			this.makeShadow(sOriginalId);
		}).bind(this));
		
		oDialog.observe('dialog:opened', (function(){
			this.scrollTo(hSettings.get('scrollTo'), sOriginalId);
		}).bind(this));
		
		oDialog.observe('dialog:updated', (function(){
			this.makeShadow(sOriginalId);
		}).bind(this));
		
		/**
		* Cria os elementos que irão compor a janela
		*/
		var oTitle	 = new Element('h1', {id: this.getId(sOriginalId, 'title')}).update(hSettings.get('title'));
		var oClose	 = new Element('a', {id: this.getId(sOriginalId, 'close'), href: '#'}).addClassName('close').observe('click', fnClose);
		var oContent = new Element('div', {id: this.getId(sOriginalId, 'content')}).addClassName('content').update(hSettings.get('content'));
		
		oDialog.insert(oTitle).insert(oContent);
		oTitle.insert(oClose);
		
		if( 0 < $H(hSettings.get('buttons')).keys().size() ){
			var oNewButton, fnCommand;
			var oButton = new Element('div', {id: this.getId(sOriginalId, 'buttons')}).addClassName('buttons');
			oDialog.insert(oButton);
			
			$H(hSettings.get('buttons')).each((function(hButton){
				switch(hButton.value.command){
					case 'fnClose':
						fnCommand = fnClose;
						break;
					
					default:
						fnCommand = hButton.value.command;
						break;
				}
				
				oNewButton = new Element('button', {id: this.getId(sOriginalId, 'buttons') + '-' + hButton.key}).update(hButton.value.label).observe('click', fnCommand);
				oButton.insert(oNewButton);
			}).bind(this));
		}
		else if(!hSettings.get('statusBar').empty()){
			var oButton = new Element('div', {id: this.getId(sOriginalId, 'buttons')}).addClassName('buttons').update(hSettings.get('statusBar'));
			oDialog.insert(oButton);
		}
		
		//-----------------------------------------------------------------------
        
		var iTop  = hSettings.get('position')[0];
		var iLeft = hSettings.get('position')[1];
		
		if('center' == iTop)
			iTop = (document.viewport.getHeight()/2) - (oDialog.getHeight()/2);
		
		if('center' == iLeft)
			iLeft = (document.viewport.getWidth()/2) - (hSettings.get('width')/2);
		
		oDialog
			.addClassName('dialog')
			.setStyle('width:' + hSettings.get('width').toString() + 'px; top:200px; left:' + iLeft.toString() + 'px;');
		
		/**
		* Esconde a janela e dispara o evento 'dialog:rendered'
		*/
		oDialog.hide();
		oDialog.fire('dialog:rendered');
		
		//-----------------------------------------------------------------------
        
		delete sId;
		delete sIdShadow;
		
		delete hSettings; 
		delete fnClose;
		delete oDialog;
		delete oTitle;
		delete oClose;
		delete oContent;
		
		delete oNewButton;
		delete fnCommand;
		delete oButton;
		
		delete iTop;
		delete iLeft;
		
		//-----------------------------------------------------------------------
		
		this.setConfig('dialogs', oCore.arrayPush(this.getConfig('dialogs'), sOriginalId));
		return this.getComponents(sOriginalId);
	},
	
	makeShadow: function(sOriginalId){
    /*
     *Problemas de Posicionamento de Shadow de Fundo com a função clonePosition;
     *
        var hComponents = this.getComponents(sOriginalId);
		var sId			= hComponents.get('dialog');
		var sIdShadow	= hComponents.get('shadow');
		var oShadow		= $(sIdShadow);

		var sOriginalDisplay = $(sId).getStyle('display');
		$(sId).show();

		hPosition = $H( Object.extend($(sId).positionedOffset(), arguments[1] || {}) );
        if(sId == 'dialog-avisar-disponibilidade'){
            return false;
        }
		oShadow
			.clonePosition(sId, {offsetTop: -2, offsetLeft: -2})
			.addClassName('dialog-shadow')
			.setStyle('background-color: ' + this.getConfig('shadowColor') + ';')
			.setOpacity(0.6);

		var hDimensions = oShadow.getDimensions();
		oShadow.setStyle('width:' + (hDimensions.width+4).toString() + 'px; height:' + (hDimensions.height+4).toString() + 'px;');

		$(sId).setStyle('display:' + sOriginalDisplay + ';');
		return oShadow;*/
        return
	},
	
	destroy: function(sOriginalId){
		var hComponents = this.getComponents(sOriginalId);
		var sId			= hComponents.get('dialog');
		var sIdShadow	= hComponents.get('shadow');
		
		$(sId).remove();
		$(sIdShadow).remove();
		
		var aDialogs = this.getConfig('dialogs');
		var aVisible = this.getConfig('visible');
		
		if( -1 < aDialogs.indexOf(sOriginalId) ){
			aDialogs.splice(aDialogs.indexOf(sOriginalId), 1);
			this.setConfig('dialogs', aDialogs);
		}
		
		if( -1 < aVisible.indexOf(sOriginalId) ){
			aVisible.splice(aVisible.indexOf(sOriginalId), 1);
			this.setConfig('dialogs', aVisible);
		}
	},
	
	open: function(sOriginalId){
		var hComponents = this.getComponents(sOriginalId);
		var sId			= hComponents.get('dialog');
		var sIdShadow	= hComponents.get('shadow');
		
		var bShowContentShadow = ('undefined' != typeof arguments[1]) ? arguments[1] : true;
		
		if( !this.isVisible(sOriginalId) && $(sId) ){
			$(sId).show();
			$(sIdShadow).show();
			this.setConfig('visible', oCore.arrayPush(this.getConfig('visible'), sOriginalId));
			
			if(bShowContentShadow)
				oCore.Sombra.show();
			else
				oCore.SelectField.hide();
			
			this.showInnerSelectFields(sOriginalId);
			$(sId).fire('dialog:opened');
		}
	},
	
	close: function(sOriginalId){
		var hComponents = this.getComponents(sOriginalId);
		var sId			= hComponents.get('dialog');
		var sIdShadow	= hComponents.get('shadow');
		
		var bHideContentShadow = ('undefined' != typeof arguments[1]) ? arguments[1] : true;
		
		if( this.isVisible(sOriginalId) && $(sId) ){
			var aVisible = this.getConfig('visible');
			aVisible.splice(aVisible.indexOf(sOriginalId), 1);
			
			$(sId).hide();
			$(sIdShadow).hide();
			this.setConfig('visible', aVisible);
			
			if(bHideContentShadow)
				oCore.Sombra.hide();
			else
				oCore.SelectField.show();
			
			$(sId).fire('dialog:closed');
            if($('banner')){
                if($('banner').hasClassName('hide')){
                    $('banner').removeClassName('hide');
                }
            }
		}
	},
	
	scrollTo: function(mType){
		if( -1 == this.aConfig.get('scrollToTypes').indexOf(mType) && 'number' != typeof mType )
			return;
			
		if('number' == typeof mType){
			window.scrollTo(0, mType);
		}
		else{
			switch(mType){
				case 'top':
					window.scrollTo(0, 0);
					break;
				
				case 'dialog':
					this.getCmp(arguments[1], 'title').scrollTo();
					break;
			}
		}
	},
	
	updateContent: function(sOriginalId, sNewContent){
		var hComponents = this.getComponents(sOriginalId);
		
		$(hComponents.get('content')).innerHTML = sNewContent;
		$(hComponents.get('dialog')).fire('dialog:updated');
	},
	
	showInnerSelectFields: function(sOriginalId){
		var aInnerSelects = this.getCmp(sOriginalId, 'content').select('select');
		
		if(0 == aInnerSelects.size())
			return;
		
		aInnerSelects.invoke('setStyle', 'visibility:visible;');
	}
	
};

/**
* -------------------------------------------------------------------------------
* @class Sombra
* @extends Core
* 	Gerencia os campos select (workaround IE6)
* -------------------------------------------------------------------------------
*/
oCore.Sombra = {
	
	hElements: $H({
		reference: 'container',
		element: 'sombra'
	}),
	
	bVisible: false,
	
	show: function(){
		if(this.bVisible)
			this.hide();
		
		var sReference	= this.hElements.get('reference');
		var sElement	= this.hElements.get('element');
		
		if( !$(sElement) )
			$(document.body).insert( new Element('div', {id: sElement}) );
		
		
			$(sElement).clonePosition(sReference);
			$(sElement).setOpacity(0.15);
			$(sElement).show();
		
		oCore.SelectField.hide();
		this.bVisible = true;
	},
	
	hide: function(){
		if(!this.bVisible)
			return;
	
		$(this.hElements.get('element')).hide();
		oCore.SelectField.show();
		
		this.bVisible = false;
	}
	
};

/**
* -------------------------------------------------------------------------------
* @class SelectField
* @extends Core
* 	Gerencia os campos select (workaround IE6)
* -------------------------------------------------------------------------------
*/
oCore.SelectField = {
	
	bVisible: true,
	
	show: function(){
		if(this.bVisible)
			return;
		
		$$('select').each(function(oElement){
			oElement.setStyle('visibility:visible;');
		});
		
		this.bVisible = true;
	},
	
	hide: function(){
		if(!this.bVisible)
			return;
		
		$$('select').each(function(oElement){
			oElement.setStyle('visibility:hidden;');
		});
		
		this.bVisible = false;
	}
	
}

//-------------------------------------------------------------------------------

document.observe('dom:loaded', function(){
	oCore.init();
    
});

//-------------------------------------------------------------------------------