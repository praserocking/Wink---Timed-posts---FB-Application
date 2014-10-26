chrome.runtime.onMessage.addListener(
  function(request, sender, sendResponse) {
    if (request.type == "userid")
    {
		pfthumb=$('.profilePicThumb')[0];
		if(typeof pfthumb!=="undefined")
		{
		 userid=$('.profilePicThumb')[0].href.split(".")[6].split('&')[0];
		}
		else
		{
		 userid=$('.fbxWelcomeBoxName').data("gt")["bmid"];
		}
      	sendResponse({"userid": userid});
    }
  });