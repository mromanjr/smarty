/**
* -------------------------------------------------------------------------------
* Classe Utils 0.1
*	Funções de uso comum, principalmente nas classes 'Mascaras' e 'ValidaForm'.
*	
*	As funções, em geral, emulam aquelas que já existem no Prototype ou no
*	MooTools, contanto que um dos dois esteja presente no documento em questão.
*	Caso contrário, faz o básico.
* -------------------------------------------------------------------------------
* Criado em....: 11/09/2007
* Alterado em..: 14/09/2007
* -------------------------------------------------------------------------------
* Changelog
* 
* 12/09/2007
*	- Adição de variáveis para verificar qual é o navegador utilizado (baseado
*	  na biblioteca MooTools)
* 	- Por questões práticas, a classe 'oBrowser' será descontinuada
*
* 14/09/2007
*	- As classes 'Event Listener Function v1.4' e 'Restrict Class v1.0' foram
* 	  remanejadas para este arquivo
* -------------------------------------------------------------------------------
*/

var oUtils = {
	
	_version: '0.1',
	
	bPrototype: ('undefined' != typeof Prototype),
	bMooTools: ('undefined' != typeof MooTools),
	
	//---------------------------------------------------------------------------
    
	getVersion: function(){
		return this._version;
	},
	
	browser: {
		ie: false,
		ie6: false,
		ie7: false,
		
		webkit: false,
		webkit419: false,
		webkit420: false,
		
		gecko: false
	},
	
	keyboard: {
		BACKSPACE: 8,
		TAB:       9,
		RETURN:   13,
		ESC:      27,
		LEFT:     37,
		UP:       38,
		RIGHT:    39,
		DOWN:     40,
		DELETE:   46,
		HOME:     36,
		END:      35,
		PAGEUP:   33,
		PAGEDOWN: 34
	},
	
	//---------------------------------------------------------------------------
    
	$: function(mElement){
		if(this.bPrototype || this.bMooTools)
			return $(mElement);
		
		if('string' == typeof mElement)
			mElement = document.getElementById(mElement);
		
		return mElement;
	},
	
	$type: function(mSubject){
		if (undefined == mSubject)
			return false;
		
		if (mSubject.htmlElement)
			return 'element';
		
		var sType = typeof mSubject;
		
		if ('object' == sType && mSubject.nodeName){
			switch(mSubject.nodeType){
				case 1: return 'element';
				case 3: return (/\S/).test(mSubject.nodeValue) ? 'textnode' : 'whitespace';
			}
		}
		
		if ('object' == sType || 'function' == sType){
			switch(mSubject.constructor){
				case Array:  return 'array';
				case RegExp: return 'regexp';
			}
			
			if ('number' == typeof mSubject.length){
				if (mSubject.item)	 return 'collection';
				if (mSubject.callee) return 'arguments';
			}
		}
		
		return sType;
	},
	
	empty: function(sString){
		if(this.bPrototype)
			return sString.empty();
		
		return ('' == sString);
	},
	
	inArray: function(sNeedle, aHaystack){
		if(this.bPrototype || this.bMooTools)
			return $A(aHaystack).indexOf(sNeedle);
		
		for(var i=0;i<aHaystack.length;i++)
			if(aHaystack[i] == sNeedle)
				return i;
		
		return -1;
	},
	
	keys: function(hHash){
		if(this.bPrototype || this.bMooTools)
			return $H(hHash).keys();
		
		var aKeys = [];
		
		for(var sKey in hHash)
			aKeys.push(sKey);
		
		return aKeys;
	},
	
	//---------------------------------------------------------------------------
    
	readAttribute: function(mElement, sAttribute){
		sAttribute = sAttribute.toLowerCase();
		
		if(this.bPrototype)
			return this.$(mElement).readAttribute(sAttribute);
		
		if(this.bMooTools)
			return this.$(mElement).getProperty(sAttribute);
		
		var oElement = this.$(mElement);
		
		if( oElement.getAttribute(sAttribute) && !oUtils.empty(oElement.getAttribute(sAttribute)) )
			return oElement.getAttribute(sAttribute);
		
		if(this.browser.ie){
			if( -1 < this.inArray(sAttribute, ['accesskey', 'colspan', 'datetime', 'enctype', 'longdesc', 'maxlength', 'readonly', 'rowspan', 'style', 'tabindex', 'valign']) )
				return '';
			
			if(!oElement.attributes)
				return null;
			
			if('title' == sAttribute){
				var oNode = oElement.getAttributeNode('title');
				return oNode.specified ? oNode.nodeValue : null;
			}
			
			var oAttribute = oElement.attributes[sAttribute];
			return oAttribute ? oAttribute.nodeValue : null;
		}
		
		return oElement.getAttribute(sAttribute);
	},
	
	//---------------------------------------------------------------------------
    	
	getValue: function(sId){
		if(this.bPrototype)
			return $F(sId);
		
		if(this.bMooTools)
			return this.$(sId).getValue();
		
		return this.readAttribute(sId, 'value') || this.$(sId).value;
	},
	
	getHint: function(sId){
		return this.readAttribute(sId, 'title') || this.readAttribute(sId, 'alt');
	}
	
};

oUtils.browser.xpath = !!(document.evaluate);
	
if(window.ActiveXObject)
	oUtils.browser.ie = oUtils.browser[window.XMLHttpRequest ? 'ie7' : 'ie6'] = true;
else if(document.childNodes && !document.all && !navigator.taintEnabled)
	oUtils.browser.webkit = oUtils.browser[oUtils.browser.xpath ? 'webkit420' : 'webkit419'] = true;
else if(null != document.getBoxObjectFor)
	oUtils.browser.gecko = true;

/*
* *******************************************************************************
* Event Listener Function v1.4
* Autor.: Carlos R. L. Rodrigues
* Site..: http://www.jsfromhell.com/geral/event-listener
* *******************************************************************************
*/

_addEvent = function(o, e, f, s){
    var r = o[r = "_" + (e = "on" + e)] = o[r] || (o[e] ? [[o[e], o]] : []), a, c, d;
    r[r.length] = [f, s || o], o[e] = function(e){
        try{
            (e = e || event).preventDefault || (e.preventDefault = function(){e.returnValue = false;});
            e.stopPropagation || (e.stopPropagation = function(){e.cancelBubble = true;});
            e.target || (e.target = e.srcElement || null);
            e.key = (e.which + 1 || e.keyCode + 1) - 1 || 0;
        }catch(f){}
        for(d = 1, f = r.length; f; r[--f] && (a = r[f][0], o = r[f][1], a.call ? c = a.call(o, e) : (o._ = a, c = o._(e), o._ = null), d &= c !== false));
        return e = null, !!d;
    }
};

_removeEvent = function(o, e, f, s){
    for(var i = (e = o["_on" + e] || []).length; i;)
        if(e[--i] && e[i][0] == f && (s || o) == e[i][1])
            return delete e[i];
    return false;
};

/*
* *******************************************************************************
* Restrict Class v1.0
* Autor.: Carlos R. L. Rodrigues
* Site..: http://jsfromhell.com/forms/restrict
* *******************************************************************************
*/

Restrict = function(form){
    this.form = form, this.field = {}, this.mask = {};
}
Restrict.field = Restrict.inst = Restrict.c = null;
Restrict.prototype.start = function(){
    var $, __ = document.forms[this.form], s, x, j, c, sp, o = this, l;
    var p = {".":/./, w:/\w/, W:/\W/, d:/\d/, D:/\D/, s:/\s/, a:/[\xc0-\xff]/, A:/[^\xc0-\xff]/};
    for(var _ in $ = this.field)
        if(/text|textarea|password/i.test(__[_].type)){
            x = $[_].split(""), c = j = 0, sp, s = [[],[]];
            for(var i = 0, l = x.length; i < l; i++)
                if(x[i] == "\\" || sp){
                    if(sp = !sp) continue;
                    s[j][c++] = p[x[i]] || x[i];
                }
                else if(x[i] == "^") c = (j = 1) - 1;
                else s[j][c++] = x[i];
            o.mask[__[_].name] && (__[_].maxLength = o.mask[__[_].name].length);
            __[_].pt = s, _addEvent(__[_], "keydown", function(e){
                var r = Restrict.field = e.target;
				/**
				* if(!o.mask[r.name]) return;
				*/
				if(!o.mask[(r.id || r.name)]) return;
                r.l = r.value.length, Restrict.inst = o; Restrict.c = e.key;
                setTimeout(o.onchanged, r.e = 1);
            });
            _addEvent(__[_], "keyup", function(e){
                (Restrict.field = e.target).e = 0;
            });
            _addEvent(__[_], "keypress", function(e){
                o.restrict(e) || e.preventDefault();
                var r = Restrict.field = e.target;
                if(!o.mask[r.name]) return;
                if(!r.e){
                    r.l = r.value.length, Restrict.inst = o, Restrict.c = e.key || 0;
                    setTimeout(o.onchanged, 1);
                }
            });
        }
};
Restrict.prototype.restrict = function(e){
    var o, c = e.key, n = (o = e.target).name, r;
    var has = function(c, r){
        for(var i = r.length; i--;)
            if((r[i] instanceof RegExp && r[i].test(c)) || r[i] == c) return true;
        return false;
    }
    var inRange = function(c){
        return has(c, o.pt[0]) && !has(c, o.pt[1]);
    }
    return (c < 30 || inRange(String.fromCharCode(c))) ?
        (this.onKeyAccept && this.onKeyAccept(o, c), !0) :
        (this.onKeyRefuse && this.onKeyRefuse(o, c),  !1);
};
Restrict.prototype.onchanged = function(){
	/**
    * var ob = Restrict, si, moz = false, o = ob.field, t, lt = (t = o.value).length, m = ob.inst.mask[(o.id || o.name)];
	*/
	var ob = Restrict, si, moz = false, o = ob.field, t, lt = (t = o.value).length, m = ob.inst.mask[(o.id || o.name)];
    if(o.l == o.value.length) return;
    if(si = o.selectionStart) moz = true;
    else if(o.createTextRange){
        var obj = document.selection.createRange(), r = o.createTextRange();
        if(!r.setEndPoint) return false;
        
        r.setEndPoint("EndToStart", obj);
        si = r.text.length;
    }
    else return false;
	for(var i in m = m.split(""))
        if(m[i] != "#")
            t = t.replace(m[i] == "\\" ? m[++i] : m[i], "");
    var j = 0, h = "", l = m.length, ini = si == 1, t = t.split("");
    for(i = 0; i < l; i++)
        if(m[i] != "#"){
            if(m[i] == "\\" && (h += m[++i])) continue;
            h += m[i], i + 1 == l && (t[j - 1] += h, h = "");
        }
        else{
            if(!t[j] && !(h = "")) break;
            (t[j] = h + t[j++]) && (h = "");
        }
    o.value = o.maxLength > -1 && o.maxLength < (t = t.join("")).length ? t.slice(0, o.maxLength) : t;
    if(ob.c && ob.c != 46 && ob.c != 8){
        if(si != lt){
            while(m[si] != "#" && m[si]) si++;
            ini && m[0] != "#" && si++;
        }
        else si = o.value.length;
    }
    !moz ? (obj.move("character", si), obj.select()) : o.setSelectionRange(si, si);
};
