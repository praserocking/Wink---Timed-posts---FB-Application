var uid;
$(function()
{
var postMap={};
function loadTimedPost(userid)
{
    var postContainer=$('#postcontainer');
    $.post("https://localhost/Ghost_Post/timedPost.php",{'userid':userid},function(data)
    {
        if(data!="")
        {
            var x=0;
            hell=data;
            data=JSON.parse(data);
            console.log(data.length);
            hell=data;
            for(i=0;i<data.length;i++)
            {
                post=data[i];   
                var postid=post.postid.split("_")[1];
                var status=post.status;
                var postedTime=post.postedTime;
                var deleteTime=post.deleteTime;
                postMap[postid]={};
                postMap[postid]["set"]=false;
                postMap[postid]["deleteTime"]=deleteTime;
                
                postContainer.append("<div class='postscontwrapper'><div class='postscont'><div class='shortPosts' data-post-id="+post.postid+"><div class='statustext'>"+status+"</div><div class='postss' id='post"+x+"'></div></div></div></div>");
                var expiryTime=(new Date(postMap[postid]["deleteTime"])-new Date())/1000;
                console.log(new Date(postMap[postid]["deleteTime"])+" "+new Date());
                $(' #post'+x).FlipClock(expiryTime,{countdown:true,clockFace:'DailyCounter'});
                x++;

            }
            $('#postloader').css({"display":"none"});
            $('#postcontainer').css({"display":"block"});
        }
        else
        {
            // Inform him to Sign in to our app.
        }
    });
}

    
function injectTimer()
{
    $('input[name^=feedback_params]').each(function(){
        var a=JSON.parse($(this).val())["target_fbid"];
        if(typeof postMap[a]!=="undefined" && typeof postMap[a][set]=="undefined")
        {            
            var expiryTime=(new Date(postMap[postId]["deleteTime"])-new Date())/1000;
            $($(this).parents("div")[2]).append("<div id='"+post[a]+"timer' style='right:0px;float:right;top:25px;position:absolute;'></div>");
            postMap[a]["set"]=true;
            $("#"+post[a]+"timer").FlipClock(expiryTime
            ,{countdown:true,
            clockFace:'DailyCounter'});
        }
    });
}

function loadPostData(facebookPostId)
{
    // Load the data from db and convert it to suitable format for charts
}


chrome.tabs.query({active: true, currentWindow: true}, function(tabs) {
  chrome.tabs.sendMessage(tabs[0].id, {type: "userid"}, function(response) {
    console.log(response.userid);
    uid=response.userid;
    loadTimedPost(response.userid);
  });
});

setInterval(injectTimer,1000);
});