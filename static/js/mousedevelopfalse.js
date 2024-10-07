$('body').on('click',()=>{
		$('.viewertop').attr('style','')
		$('.viewerbot').attr('style','')
		
	})

	$(window).on('contextmenu',()=>{return false;}).on('selectstart',()=>{return false;}).on('dragstart',()=>{return false;})

    function checkDevToolsOpen() {
	  if (window.outerWidth - window.innerWidth > 100 || window.outerHeight - window.innerHeight > 100) {
	    location.href = '../../../other/wrongapproach/1';
	  }
	}

// 주기적으로 개발자 도구가 열렸는지 체크
	setInterval(checkDevToolsOpen, 1000);