$("*").load(function() {
	var dHeight = $(document).height();
	var result = 59 + 62 + 46 + 8;
	$("#sidebar").height(dHeight - result);
});