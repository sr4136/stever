<?php

function makeItTweet($tweet){
	$tweet = preg_replace("/((http)+(s)?:\/\/[^<>\s]+)/i", "<a href=\"\\0\" target=\"_blank\">\\0</a>" , $tweet );
	$tweet = preg_replace("/[@]+([A-Za-z0-9-_]+)/", "<a href=\"http://twitter.com/\\1\" target=\"_blank\">\\0</a> ", $tweet );
	$tweet = preg_replace("/[#]+([A-Za-z0-9-_]+)/", "<a href=\"http://twitter.com/search?q=%23\\1\" target=\"_blank\">\\0</a> ", $tweet );		$tweet = preg_replace("/http:\/\/…/", "", $tweet);
	echo($tweet);
}

get_template_part( 'template-parts/db', 'tweets' );
global $tw_hostname;
global $tw_username;
global $tw_password;
global $tw_dbname;

$link = new mysqli( $tw_hostname, $tw_username, $tw_password, $tw_dbname 	);
mysqli_error( $link ); 
 
$query = 'SELECT time, text, extra FROM tn_tweets ORDER BY time DESC LIMIT 3' or die( 'Database Error' . mysqli_error( $link ) ); 
$result = $link->query( $query ); 

$i=1;
$first = "first";
$last = "last";
$addClass = "";

if($result) {
	while( $row = mysqli_fetch_array( $result ) ) { 		
		if ($i == 1){
			$addClass = $first;
		}else if ($i == 3) {
			$addClass = $last;
		}else {
			$addClass = "";
		}
		$i++;
        $tweet = $row['text'];
		$extra = unserialize($row['extra']);
		if($extra['rt']){
			$tweet = "RT @" . $extra['rt']['screenname'] . " ";
			$tweet .= $extra['rt']['text'];
		}
		if (substr($tweet, 0, 2) === 'RT'){
			$tweet = "<span class='rt'>RT</span> " . substr($tweet, 2);
		}
        echo("<div class='fourcol tweet " . $addClass . "'><div class='tweet-title'>Tweet</div>");
			echo (makeItTweet($tweet) . "<br />");
        echo("</div>");
    }
}

?>