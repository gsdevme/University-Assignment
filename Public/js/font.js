(function(window,document,undefined){
	this.increase = function(){
		var els = document.getElementsByTagName('body')[0].getElementsByTagName('p'), l;

		if(els !== undefined){
			l = els.length;

			for(var i=0;i<l;++i){
				if(els[i].style.fontSize !== undefined){
					els[i].style.fontSize = "large";
				}
				
			}
		}
	};

	window.font = this;
})(window,document);