<?php
	$_email =  "lkwg82@mail.berlios.de";

	if ( isset($_POST['text'])){
		$_meta_redirect = "<meta http-equiv=\"refresh\" content=\"5; URL=/\">";
	}
	print"

	<!-- <! DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\"
        \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\" //-->
	<html> <!-- xmlns=\"http://www.w3.org/1999/xhtml\" lang=\"en\" xml:lang=\"en\" //-->
	 <head>
		".$_meta_redirect."
		<meta http-equiv=\"content-type\" content=\"text/html; charset=UTF-8\" />
		<title>htdoogle - google with htdig</title>
		<link rel=\"stylesheet\" type=\"text/css\" href=\"format.css\" />
	 </head>
	 <body scroll=auto>
	  <!-- container //-->
	  <table class=\"container\">
	   <tr><td class=\"container\" align=center>
	<img src=\"htdoogle_90.jpg\" width=\"425\" height=\"120\" border=\"0\" alt=\"HT://doogle - logo\" />
	<p/>";
	#mail("lkwg82@mail.berlios.net", "htdoogle", "test");
	print "
	<table width=400 border=0 cellspacing=0 cellpadding=0>
		  <tr><td align=center>";

		if( isset($_POST['text']) ){
			$_subject = "htdoogle - ".$_POST['topic'];
			$_text = $_POST['text'];
			mail($_email,$_subject, $_text);
			print "<b>your message was successfully send </b><br>";
			print "<font size=-1>( your are automatically redirected back to front page in 5 seconds)<br/>";
			print "<a href=\"/\">if automatic redirect fails, click here</font></a>";
		}
		else{
		print mail_form();
		}

	print "</td>
		  </tr></table>";
	print "	</td>
   </tr>
  </table>
 </body>
</html>";

function mail_form(){
	return "<h3>mail form</h3>
			<form method=post>
			<table border=0>
			 <tr>
			  <td align=center>
				subject &nbsp;&nbsp;<input type=\"text\" name=subject class=\"style\">
			  </td>
			</tr>
			<tr>
			  <td align=right colspan=2>
				<textarea scroll=auto name=\"text\" cols=50 rows=20 class=\"style\" ></textarea>
			  </td>
			 </tr>
			 <tr>
			  <td align=center>
			   topic &nbsp;
			   <input type=\"radio\" name=\"topic\"value=\"bug\"> bug </input>
			   <input type=\"radio\" name=\"topic\" checked value=\"bug\"> other </input>
			   <p/>
			   <input type=\"submit\" value=\"  send  \" class=\"style\">
			  </td>
			 </tr>
			</table>

			</form>";
}
?>