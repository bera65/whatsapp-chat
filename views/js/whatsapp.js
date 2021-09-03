$(function(){

    $(".asagiSabit a").click(function(e) {
        e.preventDefault();
        window.open(this.href);
    });
	setInterval(function(){
	  $('#kutu').addClass("animated");
	}, 3000);
	setInterval(function(){
			$('#kutu').removeClass("animated");
	}, 6000);
});