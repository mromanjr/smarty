/**
* -------------------------------------------------------------------------------
* Classe OnKeyRequestBuffer 1.0
*	Utilitário para pesquisas tipo 'suggest', onde o usuário digita algumas
*	letras e o sistema sugere palavras semelhantes ao texto
* -------------------------------------------------------------------------------
* Criado em....: -
* Alterado em..: 12/09/2007
* Obs..........: Esta função é uma solução disponibilizada pelo Wiki da biblioteca Xajax
* -------------------------------------------------------------------------------
* Changelog
* 
* 12/09/2007
*	- A classe agora utiliza algumas funções da classe 'Utils'
* -------------------------------------------------------------------------------
*/

function OnKeyRequestBuffer(sObjectName, sXajaxFunction){
	this.sObjectName	= sObjectName;
	this.sXajaxFunction = sXajaxFunction;
	this.mBufferText	= false;
	this.iBufferTime	= 500;
	
	this.modified = function(sId){
		setTimeout(this.sObjectName + ".compareBuffer('" + sId + "', '" + oUtils.$Value(sId) + "');", this.iBufferTime);
	};
	
	this.compareBuffer = function(sId, sText){
		if( oUtils.$Value(sId) == sText && this.mBufferText != sText ){
			this.mBufferText = sText;
			eval(this.sObjectName + ".makeRequest('" + sId + "');");
		}
	};
	
	this.makeRequest = function(sId){
		eval(this.sXajaxFunction + "('" + oUtils.$Value(sId) + "');");
	};
	
	this.clearBuffer = function(){
		this.mBufferText = '';
	};
}