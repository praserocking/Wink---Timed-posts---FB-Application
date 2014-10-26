var url_1,status,userid;
var innerwinkmod = document.createElement("iframe");

function attachhandler()
{
	$('#dwara').on('click',function(){
		status=$('.innerWrap textarea').first().val();
		pfthumb=$('.profilePicThumb')[0];
		if(typeof pfthumb!=="undefined")
		{
		 userid=$('.profilePicThumb')[0].href.split(".")[6].split('&')[0];
		}
		else
		{
		 userid=$('.fbxWelcomeBoxName').data("gt")["bmid"];
		 }

		url_1=status.match(/(^|\s)((https?:\/\/)?[\w-]+(\.[\w-]+)+\.?(:\d+)?(\/\S*)?)/gi);
		
	
		console.log(url_1);
		//open the modal if no user id present in db
		$('.winkmodalhide').css({"visibility":"visible"});
		//else part
		var srcofiframe; 
		if(url_1!=null)
			{
				url_1=url_1[0];
				srcofiframe="https://localhost/Ghost_Post/timeSelect.php?status="+status+"&userid="+userid+"&posturl="+url_1;
			}
		else
		{
			srcofiframe="https://localhost/Ghost_Post/timeSelect.php?status="+status+"&userid="+userid;
		}
		console.log(srcofiframe);
		$(innerwinkmod).attr('src',srcofiframe);
		$(innerwinkmod).css({"border":"0px"});

	});


}
(function(){

	var winkmod = document.createElement("div");
	var modalclose = document.createElement("div");
	$(modalclose).addClass('modalclosee');
	$(modalclose).html("&#215");	
	$(innerwinkmod).addClass("innerwinkmod");
	$(winkmod).append(modalclose);
	$(winkmod).append(innerwinkmod);
	$(winkmod).addClass("winkmodalhide");
	$(winkmod).insertBefore("._li");
	$(modalclose).on('click',function(){
			$('.winkmodalhide').css({"visibility":"hidden"});
	});

	//$( "<p>Test</p>" ).insertBefore( "._li" );

})();
(function(){

		function check()
		{

			var b = document.getElementsByClassName("_42ft _4jy0 _11b _4jy3 _4jy1 selected _51sy")[0];
			var w = document.getElementById('dwara');
			if((b!= null) && (w ==null))
			{
					var parent = b.parentElement;
					var next = b.nextSibling;
					button = document.createElement("div");
					button.style.cssText = document.defaultView.getComputedStyle(b, "").cssText;
					var timer = document.createElement("img");
					$(timer).attr("src",chrome.extension.getURL("icons/timer.png"));

					$(timer).css({"display":"inline","max-height":"15px","vertical-align":"middle","margin-top":"-4px","margin-right":"5px"});
					button.id = "dwara";
					$(button).append(timer);
					var txt  = document.createTextNode("Wink");
					$(button).append(txt);
					

					if (next) {
						$(button).insertBefore(next);
						
						
						$('#dwara').css({"margin-left":"5px"});
					}
					else {
						
						$(parent).append(button);
						
						$('#dwara').css({"margin-left":"5px"});
					}

					attachhandler();

			}

		}

		setInterval(check,200);


})();
(function(){

	$('.winkmodalhide').css({"background-color":"white"});

})();


//var style = window.getComputedStyle(b);



