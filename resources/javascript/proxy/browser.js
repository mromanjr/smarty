/**
* -------------------------------------------------------------------------------
* Classe Browser 0.1
* 	Detecta o navegador que o usuário utiliza
* -------------------------------------------------------------------------------
* Criado em....: 15/03/2007
* Alterado em..: 23/08/2007
* -------------------------------------------------------------------------------
* Changelog
* 
* 23/08/2007
*	- oBrowser foi transformado em hash (logo, um objeto já declarado)
* -------------------------------------------------------------------------------
*/

var oBrowser = {
	
	_version: '0.1',
	
	//---------------------------------------------------------------------------
    
	getVersion: function(){
		return this._version;
	},
	
	ie:			(('undefined' != oUtils.$type(window.ActiveXObject) && null != window.ActiveXObject) && (-1 != navigator.appVersion.indexOf('MSIE'))),
	opera:		(-1 != navigator.userAgent.toLowerCase().indexOf('opera')),
	konquerer:	('KDE' == navigator.vendor),
	gecko:		(('Gecko' == navigator.product)&&(-1 != navigator.appVersion.indexOf('KHTML'))),
	webkit:		(/WebKit/i.test(navigator.userAgent.toLowerCase())?true:false),
	safari:		(/WebKit/i.test(navigator.userAgent.toLowerCase())&&/Safari/i.test(navigator.userAgent.toLowerCase())),
	firefox:	(-1 != navigator.userAgent.toLowerCase().indexOf('firefox')),
	
	win:		(-1 != navigator.appVersion.indexOf('Windows')),
	mac:		(-1 != navigator.appVersion.indexOf('Macintosh')),
	
	getVersion: function(){
		var av = navigator.appVersion;
		var ua = navigator.userAgent.toLowerCase();
		
		if(this.ie)
			return parseFloat(av.substring(av.indexOf('MSIE')+4));
		else if(this.firefox)
			return parseFloat(ua.substring(ua.indexOf('firefox')+8));
		else if(this.opera)
			return parseFloat(ua.substring(ua.indexOf('opera')+6));
		else if(this.safari)
			return parseFloat(ua.substring(ua.indexOf('safari')+7));
		
		return 0;
	}
	
};