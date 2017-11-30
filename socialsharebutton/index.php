<!DOCTYPE HTML>
<html>
<head>
    <title>Create Your Own Custom Social Share Count Buttons : suckittrees.Com</title>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <meta name="MSSmartTagsPreventParsing" content="true" />
    <meta http-equiv="imagetoolbar" content="no" />            
    <link href="site.css" rel="stylesheet" type="text/css" media="all"/>
    <script src="../js/jquery-3.2.1.min.js"></script>
</head>
<body >
    <div align="center">
        <div class="main">
            <div align="left">
                <h1>Get Social Counts Example</h1>
                <p>If you're tired of using the built-in styles of Facebook, Twitter, Google+, and StumbleUpon's like and share buttons, you're not alone. Here's how we implemented them here on suckittrees.com using PHP and jQuery. You may want to be familiar with HTML, CSS, and javascript to complete this tutorial. <a href="http://suckittrees.com/blog/create-your-own-custom-social-share-count-buttons/">Read the full tutorial here&hellip;</a></p>
                <p>
                    <a class="post-share facebook" href="http://www.facebook.com/plugins/like.php?href=http://suckittrees.com/blog/&width&layout=standard&action=like&show_faces=true&share=true&height=80&appId=#################" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=100,width=200');return false;">Facebook<span></span></a>
                    <a class="post-share twitter" href="https://twitter.com/share?url=http://suckittrees.com/blog/&text=Text for Twitter Here&via=suckittrees" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">Twitter<span></span></a>
                    <a class="post-share gplus" href="https://plus.google.com/share?url=http://suckittrees.com/blog/" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">Google Plus<span></span></a>
                    <a class="post-share stumble" href="http://www.stumbleupon.com/submit?url=http://suckittrees.com/blog/" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=800');return false;">Stumbleupon<span></span></a>
                </p>
                <div style="clear:both;"></div>
            </div>
        </div>
    </div>
<script type="text/javascript" src="site.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    get_social_counts();
    //maybe_some_other_functions_too();
});
    
function get_social_counts() {
    var thisUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
    $.ajax({
        type: "GET",
        url: 'http://suckittrees.com/images/get_social_counts.php?thisurl='+thisUrl,
        dataType: "json",
        success: function (data){
            $('a.post-share.twitter span').html(data.twitter);
            $('a.post-share.facebook span').html(data.facebook);
            $('a.post-share.gplus span').html(data.gplus);
            $('a.post-share.stumble span').html(data.stumble);
        }
    });
}    
</script>
</body>
</html>
<script>

</script>