/**
* -------------------------------------------------------------------------------
* Classe DataHora 0.1
*	Funções gerais para manipulação de data e hora
* -------------------------------------------------------------------------------
* Criado em....: 16/03/2007
* Alterado em..: 23/08/2007
* -------------------------------------------------------------------------------
* Changelog
* 
* 23/08/2007
*	- oDataHora foi transformado em hash (logo, um objeto já declarado)
* -------------------------------------------------------------------------------
*/

var oDataHora = {
	
	_version: '0.1',
	
	//---------------------------------------------------------------------------
    
	getVersion: function(){
		return this._version;
	},
	
	setData: function(sData){
		var aNovadata = new Array();
		var sRetorno  = new String();
		var sTipo	  = (arguments[1]) ? arguments[1] : 'mysql';
		
		switch(sTipo){
			case 'mysql':
				aNovadata = sData.split('/');
				sRetorno  = aNovadata[2] + '-' + aNovadata[1] + '-' + aNovadata[0];
				break;
			
			case 'data':
				aNovadata = sData.split('-');
				sRetorno  = aNovadata[2] + '/' + aNovadata[1] + '/' + aNovadata[0];
				break;
			
			case 'datahora':
				aNovadata = sData.split(' ');
				
				var sHora = aNovadata[1];
				var sQuebra = (arguments[2]) ? arguments[2] : ' ';
				
				aNovadata = aNovadata[0].split('-');
				sHora = sHora.substring(0, 5);
				
				sRetorno = aNovadata[2] + '/' + aNovadata[1] + '/' + aNovadata[0] + sQuebra + sHora;
				break;
			
			case 'timestamp':
				if( -1 < sData.indexOf('/') ){
					aNovadata = sData.split('/');
					sRetorno  = new Date( aNovadata[1] + '/' + aNovadata[0] + '/' + aNovadata[2] );
				}
				
				if( -1 < sData.indexOf('-') ){
					aNovadata = sData.split('-');
					sRetorno  = new Date( aNovadata[1] + '/' + aNovadata[2] + '/' + aNovadata[0] );
				}
				
				sRetorno = sRetorno.getTime();
				break;
		}
		
		return sRetorno;
	},
	
	comparaData: function(sData1, sData2){
		var sComparacao = (arguments[2] && arguments[2]!='') ? arguments[2] : '>';
		
		if( eval("this.setData(sData1, 'timestamp') " + sComparacao + " this.setData(sData2, 'timestamp')") )
			return false;
		
		return true;
	},
	
	comparaHora: function(sHora1, sHora2){
		var sComparacao = (arguments[2] && arguments[2]!='') ? arguments[2] : '>';
		var sData	    = '01/01/1970';
		var aNovaHora1  = sHora1.split(':');
		var aNovaHora2  = sHora2.split(':');
		
		aNovaHora1[2] = (aNovaHora1[2]==undefined) ? '00' : aNovaHora1[2];
		aNovaHora2[2] = (aNovaHora2[2]==undefined) ? '00' : aNovaHora2[2];
		
		sHora1 = new Date( sData + ' ' + aNovaHora1[0] + ':' + aNovaHora1[1] + ':' + aNovaHora1[2] );
		sHora2 = new Date( sData + ' ' + aNovaHora2[0] + ':' + aNovaHora2[1] + ':' + aNovaHora2[2] );
		
		if( eval("sHora1.getTime() " + sComparacao + " sHora2.getTime()") )
			return false;
		
		return true;
	},
	
	diffData: function(sData1, sData2){
		var sTipo = (arguments[2]) ? arguments[2] : 'dias';
		var iBase = new Number();
		
		switch(sTipo){
			case 'segundos': iBase = 1; 		   break;
			case 'minutos':  iBase = 60; 		   break;
			case 'horas':	 iBase = 60 * 60; 	   break;
			case 'dias': 	 iBase = 60 * 60 * 24; break;
		}
		
		var iDiff = ( (this.setData(sData2, 'timestamp') - this.setData(sData1, 'timestamp')) / (iBase*1000) );
		return Math.floor(iDiff);
	}
	
};