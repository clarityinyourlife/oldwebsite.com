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
<html>
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<!-- User defined head content such as meta tags and encoding options -->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="icon" href="http://www.clarityinyourlife.com/favicon.ico" type="image/x-icon" />
		<link rel="shortcut icon" href="http://www.clarityinyourlife.com/favicon.ico" type="image/x-icon" />
		
		<title>Clarity In Your Life</title>
		<link rel="stylesheet" type="text/css" media="screen" href="../rw_common/themes/Qube/styles.css" />
		<link rel="stylesheet" type="text/css" media="print" href="../rw_common/themes/Qube/css/print.css" />
		<link rel="stylesheet" type="text/css" media="handheld" href="../rw_common/themes/Qube/css/mobile.css" />
		<link rel="stylesheet" type="text/css" media="all" href="../rw_common/themes/Qube/css/colourtag-page0.css" />
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script> <!-- Load jQuery 1.7 here, for theme options that may need it. -->
		<script charset="utf-8">RwSet = { pathto: "../rw_common/themes/Qube/javascript.js", baseurl: "http://www.clarityinyourlife.com/" };</script>
		<script type="text/javascript" src="../rw_common/themes/Qube/scripts/nimblehost.js"></script>
		<script type="text/javascript" src="../rw_common/themes/Qube/javascript.js"></script> <!-- RapidWeaver javascript functions -->
		<!-- Style variations - these are set up in the Theme.plist -->
		<link rel="stylesheet" type="text/css" media="screen" href="../rw_common/themes/Qube/css/logoTitle/bothLeft.css" />
		<link rel="stylesheet" type="text/css" media="screen" href="../rw_common/themes/Qube/css/headerImage/hide.css" />
		<link rel="stylesheet" type="text/css" media="screen" href="../rw_common/themes/Qube/css/headerImage/image20.css" />
		<link rel="stylesheet" type="text/css" media="screen" href="../rw_common/themes/Qube/css/iPad.css" />
		<link rel="stylesheet" type="text/css" media="screen" href="../rw_common/themes/Qube/css/advanced/iPhoneHideHeaderImage.css" />
		<script type="text/javascript" src="../rw_common/themes/Qube/scripts/jquery.fancyzoom.js"></script>
		<script type="text/javascript" src="../rw_common/themes/Qube/scripts/jquery.cycle.min.js"></script>
		
		<link rel="stylesheet" type="text/css" media="all" href="../rw_common/themes/Qube/css/iPhone.css" />
		<!-- User defined styles -->
		
		<!-- User defined javascript -->
		
		<!-- Third party plugin header -->
		
		<!-- User defined header -->
		
		<!--[if IE 7]>
			<link rel="stylesheet" type="text/css" media="all" href="../rw_common/themes/Qube/css/ie7.css" />
		<![endif]-->
		<!--[if IE 6]>
			<link rel="stylesheet" type="text/css" media="all" href="../rw_common/themes/Qube/css/ie6.css" />
		<![endif]-->
	</head>
	<body>
	<div id="pageTopWrapper">
		<div id="EC1Wrapper">
			<div id="extraContainer1"></div>
		</div>
		<div class="clearer"></div>
		<div id="EC1Shadow"></div>
		<div class="clearer"></div>
	</div>
	<div class="clearer"></div>
	<div id="container"><!-- Start container -->
		<div id="mainWrapper">
			<div id="topWrapper">	
				<div id="logoTitle"><!-- Start logo and title container -->
					<div id="logo">
						<a href="http://www.clarityinyourlife.com/"></a>
					</div>
					<div id="titleSlogan">
						<div id="title"><h1>Clarity In Your Life</h1></div>
						<div id="slogan"><h2>Leadership for Managers</h2></div>
					</div>
				</div><!-- End logo and title container -->
			</div>
			<div class="clearer"></div>
			<div class="headerImage upperHeader">
				<div id="extraContainer2"></div>
			</div>
			<div class="clearer"></div>
			<div id="mobileMenuTabWrapper">
				<div id="mobileMenuTab">Navigation</div>
			</div>
			<div class="clearer"></div>
			<div id="menuWrapper">
				<div id="menu"><ul><li><a href="../index.php" rel="self">Home</a></li><li><a href="../success_stories/index.html" rel="self">Success Stories</a></li><li><a href="../my_training/index.html" rel="self">My Training</a></li><li><a href="../meet_clare/index.html" rel="self">Meet Clare</a></li><li><a href="contact.php" rel="self" id="current">Contact</a></li><li><a href="../download_report/index.html" rel="self">Download Report</a></li></ul></div>
				<div class="clearer"></div>
			</div>
			<div class="clearer"></div>
			<div class="headerImage lowerHeader">
				<div id="extraContainer3"></div>
			</div>
			<div class="clearer"></div>
			<div id="topSidebarWrapper"></div><!-- Reserved space for placing sidebar above content -->
			<div class="clearer"></div>
			<div id="extraContainer4"></div>
			<div class="clearer"></div>
			<div id="contentWrapper"><!-- Start main content wrapper -->
				<div id="content"><!-- Start content -->
					
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
					<div class="clearer"></div>
				</div><!-- End content -->
				<div id="contentSidebar"></div><!-- Reserved space for placing sidebar inside main content area -->
				<div class="clearer"></div>
			</div><!-- End main content wrapper -->
			<div id="sidebarWrapper"><!-- Start Sidebar wrapper -->
				<div class="sideHeader">Connect With Us!</div><!-- Sidebar header -->
				<div class="sidebar"><!-- Start sidebar content -->
					<a href="http://www.facebook.com/pages/Clarity-in-Your-Life/184019395133103"><img src="http://www.clarityinyourlife.com/rapidweaver/resources/facebook_32.png" style="margin-right:10px;margin-left:30px;"></a><!-- sidebar content you enter in the page inspector -->
					 <!-- sidebar content such as the blog archive links -->
				</div><!-- End sidebar content -->
			</div><!-- End sidebar wrapper -->
			<div class="clearer"></div>
			<div id="extraContainer5"></div>
			<div class="clearer"></div>
			<div id="extraContainer6"></div>
			<div class="clearer"></div>
		</div>
		<div class="clearer"></div>
		<div id="breadcrumbWrapper">
			<div id="breadcrumbContainer"><!-- Start the breadcrumb wrapper -->
				
			</div><!-- End breadcrumb -->
			<div class="clearer"></div>
		</div>
		<div class="clearer"></div>
		<div id="EC7TopShadow"></div>
		<div class="clearer"></div>
		<div id="EC7Wrapper">
			<div id="extraContainer7"></div>
		</div>
		<div class="clearer"></div>
		<div id="EC7BottomShadow"></div>
		<div class="clearer"></div>
		<div id="footerSpacer"></div>
		<div class="clearer"></div>
		<div id="footerWrapper">
			<div id="footerTopShadow"></div>
			<div id="footer"><!-- Start Footer -->
				&copy; 2014 Clarity In Your Life <a href="#" id="rw_email_contact">Contact Me</a><script type="text/javascript">var _rwObsfuscatedHref0 = "mai";var _rwObsfuscatedHref1 = "lto";var _rwObsfuscatedHref2 = ":cl";var _rwObsfuscatedHref3 = "are";var _rwObsfuscatedHref4 = "@cl";var _rwObsfuscatedHref5 = "ari";var _rwObsfuscatedHref6 = "tyi";var _rwObsfuscatedHref7 = "nyo";var _rwObsfuscatedHref8 = "url";var _rwObsfuscatedHref9 = "ife";var _rwObsfuscatedHref10 = ".co";var _rwObsfuscatedHref11 = "m";var _rwObsfuscatedHref = _rwObsfuscatedHref0+_rwObsfuscatedHref1+_rwObsfuscatedHref2+_rwObsfuscatedHref3+_rwObsfuscatedHref4+_rwObsfuscatedHref5+_rwObsfuscatedHref6+_rwObsfuscatedHref7+_rwObsfuscatedHref8+_rwObsfuscatedHref9+_rwObsfuscatedHref10+_rwObsfuscatedHref11; document.getElementById('rw_email_contact').href = _rwObsfuscatedHref;</script>
			</div><!-- End Footer -->
			<div id="footerBottomShadow"></div>
		</div>
	</div><!-- End container -->
	</body>
	<script>
		$qube(function(){ $qube('#mobileMenuTab').html(mobileMenuTab); });
		if ( $qube('#mobileMenuTabWrapper').is(':visible') ) { qube.themeFunctions.mobileMenu(); qube.themeFunctions.resetMainMenuColors(); }
		qube.themeFunctions.on_resize(function(){ 
			if( $qube(window).width() < 481 && !$qube('#mobileMenuTab').hasClass('activated') ) { qube.themeFunctions.mobileMenu(); }
			qube.themeFunctions.resetMainMenuColors();
		});
	</script>
	<!--[if lte IE 8]>
	<style type="text/css"> .headerImage, #contentWrapper, #breadcrumbContainer ul, #extraContainer4, #extraContainer5, #extraContainer6, blockquote, .standout { position: relative; behavior: url(../rw_common/themes/Qube/scripts/PIE.htc); } </style>
	<![endif]-->
</html>