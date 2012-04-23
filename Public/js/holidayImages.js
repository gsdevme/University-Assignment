/**
 * 
 * This is a self invoking function which is needed as at runtime the image URL
 * for the holidays isn't known, the only method is to hit the HTML link then extract it... :(
 */
(function(window,document,undefined){
	var url,l;

	// Gets of the img tags
	el=document.getElementsByTagName('img');

	// Double check we have some
	if(el!=undefined){
		// assign L as the length
		l=el.length;

		// Iterate through them
		for(i=0;i<l;++i){
			// Encapsulate a function within
			(function(img){
				// Lets check it has a data- attr
				if(el[img].hasAttribute('data-holidays-image')){
					// Lets grab the image URL from the data- attr
					url = el[img].getAttribute('data-holidays-image');

					// Fire up a Ajax call it load the HTML page
					new ajax(url, (function(html){
						// Extract the image URL from the HTML page
						var regex=new RegExp('<img src="(.*?)" />', 'g');
						
						// Assign the src to our image
						el[img].src = 'http://www.numyspace.co.uk/~cgel1/holidays/' + regex.exec(html)[1];
					}));				
				}			
			})(i);

		}
	}
})(window,document);