<?php
	// Start session.
	session_start();
	
	// Set a key, checked in mailer, prevents against spammers trying to hijack the mailer.
	$security_token = $_SESSION['security_token'] = uniqid(rand());
	
	if ( ! isset($_SESSION['formMessage'])) {
		$_SESSION['formMessage'] = '<span style="font:26px Arial, Verdana, Helvetica, sans-serif; font-weight:bold; font-weight:bold; "><br /></span><span style="font:12px Arial, Verdana, Helvetica, sans-serif; color:#404040;"><br /></span><span style="font:20px Arial, Verdana, Helvetica, sans-serif; font-weight:bold; font-weight:bold; ">We would love to hear from you!<br /><br /></span><span style="font:12px Arial, Verdana, Helvetica, sans-serif; color:#404040;">Please submit your message in the form below and&nbsp;I will be back in touch with you as soon as possible.<br /></span>';	
	}
	
	if ( ! isset($_SESSION['formFooter'])) {
		$_SESSION['formFooter'] = '';
	}
	
	if ( ! isset($_SESSION['form'])) {
		$_SESSION['form'] = array();
	}
	
	function check($field, $type = '', $value = '') {
		$string = "";
		if (isset($_SESSION['form'][$field])) {
			switch($type) {
				case 'checkbox':
					$string = 'checked="checked"';
					break;
				case 'radio':
					if($_SESSION['form'][$field] === $value) {
						$string = 'checked="checked"';
					}
					break;
				case 'select':
					if($_SESSION['form'][$field] === $value) {
						$string = 'selected="selected"';
					}
					break;
				default:
					$string = $_SESSION['form'][$field];
			}
		}
		return $string;
	}
?><!DOCTYPE html>
<html lang="en">
  <head>
  
  <!-- BootSnap Theme v 1.0.6 | Yabdab Inc. | http://yabdab.com/bootsnap/ -->
  
  	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="icon" href="http://www.clarityinyourlife.com/favicon.ico" type="image/x-icon" />
		<link rel="shortcut icon" href="http://www.clarityinyourlife.com/favicon.ico" type="image/x-icon" />
		<!-- User defined head content such as meta tags and encoding options -->
    <meta charset="utf-8">
    <title>Contact</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- base styles -->
 
	<!-- User defined styles -->
	<link rel="stylesheet" type="text/css" media="screen" href="../rw_common/themes/BootSnap/css/fixed_navbar.css" />
		<link rel="stylesheet" type="text/css" media="screen" href="../rw_common/themes/BootSnap/css/navbar_40.css" />
		<link rel="stylesheet" type="text/css" media="screen" href="../rw_common/themes/BootSnap/css/theme_none.css" />
		<link rel="stylesheet" type="text/css" media="screen" href="../rw_common/themes/BootSnap/css/responsive.css" />
		
	<link rel="stylesheet" type="text/css" media="screen" title="colourtags" href="../rw_common/themes/BootSnap/colourtag-theme-default.css" />
	
	<!-- make responsive -->
	<link href="../rw_common/themes/BootSnap/styles.css" rel="stylesheet" />
	<!-- load jQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="https://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    
    
  </head>

  <body>
  
	  <!-- Navbar
	    ================================================== -->
	    <div id="main-nav" class="navbar navbar-fixed-top">
	      <div class="navbar-inner" style="display:none;">
	        <div class="container">
	          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </a>
	          <a href="http://www.clarityinyourlife.com/" class="brand"><span id="site-logo"></span><span id="site-title">Clarity In Your Life</span></a>
	          <div class="nav-collapse collapse">
	            <ul><li><a href="../index.php" rel="self">Clarity In Your Life</a></li><li><a href="../styled-2/index.html" rel="self">Success Stories</a></li><li><a href="../styled-3/index.html" rel="self">My Training</a></li><li><a href="../styled-4/index.html" rel="self">Meet Clare</a></li><li class="active"><a href="page0.php" rel="self" id="current">Contact</a></li><li><a href="../code/index.html" rel="self">Download Report</a></li></ul>
	          </div>
	        </div>
	      </div>
	    </div>
	  <div class="container content">
	  
	  
  
  	  
<div class="message-text"><?php echo $_SESSION['formMessage']; unset($_SESSION['formMessage']); ?></div><br />

<form action="./files/mailer.php" method="post" enctype="multipart/form-data">
	 <div>
		<label>Your Name:</label> *<br />
		<input class="form-input-field" type="text" value="<?php echo check('element0'); ?>" name="form[element0]" size="40"/><br /><br />

		<label>Your Email:</label> *<br />
		<input class="form-input-field" type="text" value="<?php echo check('element1'); ?>" name="form[element1]" size="40"/><br /><br />

		<label>Subject:</label> *<br />
		<input class="form-input-field" type="text" value="<?php echo check('element2'); ?>" name="form[element2]" size="40"/><br /><br />

		<label>Message:</label> *<br />
		<textarea class="form-input-field" name="form[element3]" rows="8" cols="38"><?php echo check('element3'); ?></textarea><br /><br />

		<div style="display: none;">
			<label>Spam Protection: Please don't fill this in:</label>
			<textarea name="comment" rows="1" cols="1"></textarea>
		</div>
		<input type="hidden" name="form_token" value="<?php echo $security_token; ?>" />
		<input class="form-input-button" type="reset" name="resetButton" value="Reset" />
		<input class="form-input-button" type="submit" name="submitButton" value="Submit" />
	</div>
</form>

<br />
<div class="form-footer"><?php echo $_SESSION['formFooter']; unset($_SESSION['formFooter']); ?></div><br />

<?php unset($_SESSION['form']); ?>
  
  	<div id="colour-trigger"></div>
  	</div><!--.container-->
  	
      <!-- javascript
      ================================================== -->
      <!-- Placed at the end of the document so the pages load faster -->
      <script src="../rw_common/themes/BootSnap/bootstrap.min.js"></script>
      <script src="../rw_common/themes/BootSnap/prettify.js"></script>
      <!-- User defined javascript -->
  
  		
    </body>
  </html>