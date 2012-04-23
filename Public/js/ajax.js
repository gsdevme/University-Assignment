/**
 * 
 * A very simple ajax function, since the project is small theres no need to 
 * create loads of features for it
 */
(function(window,document,undefined){
	this.ajax = function(url, callback){
		// Standard Request Verus the Microsoft bullshit standard :)))) RAGE!
		var xmlHttp = new XMLHttpRequest() || new ActiveXObject('Microsoft.XMLHTTP');

		// callback for the state change, we only need to capture http 200 really
		xmlHttp.onreadystatechange = function(){
			if(xmlHttp.readyState==4 && xmlHttp.status==200){
				return callback(xmlHttp.responseText);
			}
		};

		// HTTP GET Request with async at the given URL
		xmlHttp.open('get', url, true);
		xmlHttp.send();			
	};

	window = this;
})(window,document);