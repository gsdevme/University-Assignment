(function(window,document,undefined){
	var url,l;
	el=document.getElementsByClassName('grabHolidayImages');

	if(el!=undefined){
		l=el.length;

		for(i=0;i<l;++i){
			(function(img){
				url = el[img].getAttribute('title');

				foo = new ajax(url, (function(html){
					var regex=new RegExp('<img src="(.*?)" />', 'g');
					
					el[img].src = 'http://www.numyspace.co.uk/~cgel1/holidays/' + regex.exec(html)[1];
					el[img].title = el[img].alt + ' Image';
				}));				
			})(i);

		}
	}
})(window,document);