(function(window,document,undefined){
	this.ajax = function(url, callback){
		var xmlHttp = new XMLHttpRequest() || new ActiveXObject('Microsoft.XMLHTTP');
		xmlHttp.onreadystatechange = function(){
			if(xmlHttp.readyState==4 && xmlHttp.status==200){
				return callback(xmlHttp.responseText);
			}
		};

		xmlHttp.open('get', url, true);
		xmlHttp.send();			
	};

	window = this;
})(window,document);