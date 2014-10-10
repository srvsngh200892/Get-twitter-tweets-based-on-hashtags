<?php include "library/twitteroauth.php";
?>
<?php
$consumer="copy yoy key";
$consumersecret="copy yoy key";
$accesstoken="copy yoy key";
$accesstokensecret="copy yoy key";
$twitter=new TwitterOAuth($consumer,$consumersecret,$accesstoken,$accesstokensecret);
?>

<html>
<head>
<meta charset="UTF-8"/>
<title>Unique Tweets</title>
<style>


body
{
background-image:url('image5.jpg');

}
</style>
</head>
<body >
	<img src="tweet.png"/>
	<h2 style="margin-left:36%;font-color:blue;">ENTER #HASHTAG</h2>
	
<form action="" method="post">
<lable style="margin-left:30%;"><b>Search unique tweets</b>:<input type="text" name="keyword" /></lable>
<button type="button" action="">Press Enter!</button>
</form>
<?php

$con = mysql_connect('localhost', 'root', '');
 
	if (!$con){
		die('Could not connect: ' . mysql_error());
      

	}

 $con1 = mysql_select_db('twitter');
if (!$con){
		die('Could not connect to database: ' . mysql_error());
      

	}



if(isset($_POST['keyword']))
{
	$pk=0;
	$tweets= $twitter->get('https://api.twitter.com/1.1/search/tweets.json?q=%23'.$_POST['keyword'].'&src=hash&result_type=recent&count=100');
	foreach($tweets as $tweet)
	{
	   foreach($tweet as $t)
	   {
          $pk++;
          echo $t->user->name.'<br>';
	     echo'<img src="'.$t->user->profile_image_url.'" />'."\t\t\t"."<b>$t->text</b>".'<br><br>.';	
	     echo '<b>Retweet Count</b>'.$t->retweet_count; 
	     echo'<hr>';
	      
	      $a0=(string)$t->user->name;
	      $a1=(string)$t->user->profile_image_url;
	      $a2=(string)$t->text;
	      $a4=(string)$t->retweet_count;
   
	           $result = mysql_query("SELECT image FROM bookmyshow");
	           if(!$result)
	           {

while($row = mysqli_fetch_array($result))
  {
  if( $row['image']==$a1)
  {

   mysql_query("UPDATE bookmyshow SET retweet_count=$a4
WHERE image=$a1");
  }
  
  }}

  
  else	      {	
	 
	$sql="INSERT INTO bookmyshow (id,username, image,tweets,retweet_count)
VALUES('$pk','$a0','$a1','$a2','$a4')";
  
     
   mysql_query($sql);
         	}
         }
	       break;
	}

}

?>
</body>
<html>