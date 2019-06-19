
//阻止pc端浏览器缩放js代码
//由于浏览器菜单栏属于系统软件权限，没发控制，我们着手解决ctrl/cammond + +/- 或 Windows下ctrl + 滚轮 缩放页面的情况，只能通过js来控制了
$(document).ready(function () {
	// chrome 浏览器直接加上下面这个样式就行了，但是ff不识别
	$('body').css('zoom', 'reset');
	$(document).keydown(function (event) {
	  	//event.metaKey mac的command键
	  	if ((event.ctrlKey === true || event.metaKey === true)&& (event.which === 61 || event.which === 107 || event.which === 173 || event.which === 109 || event.which === 187  || event.which === 189)){
	    	event.preventDefault();
	  	}
	});
	$(window).bind('mousewheel DOMMouseScroll', function (event) {
	  	if (event.ctrlKey === true || event.metaKey) {
	    	event.preventDefault();
	  	}
	});
});
