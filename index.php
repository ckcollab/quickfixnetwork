<?php
/*
TODO:
- [/] Make index.php base template
- [/] index.php base template includes other pages from GET query (?page=)
 see https://github.com/ckcollab/StuartAdvertising/blob/master/site/index.php
- [/] dynamic title
- [/] validate page GET param is in our whitelist
- [ ] deploy to heroku
- [ ] add sendgrid addon
- [ ] export the environment variables locally
- [ ] write email wrapper
 see https://github.com/ckcollab/StuartAdvertising/blob/master/site/content/contact.php
 */
$page = $_GET['page'];

$whitelist = array(
    "software_mgmt" => "Software Management",
    "about_me" => "About me",
    "packages" => "Packages",
    "home" => "Home",
    "contact" => "Contact"
);

if(isset($page)) {
    if(!array_key_exists($page, $whitelist)) {
        echo "Page not found!";
        exit(-1);
    }
} else {
    $page = "home";
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Quick Fix - Software Management</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" href="images/icon/qf.ico">

		<link rel="stylesheet" href="stylesheets/softman.css">
		<link rel="stylesheet" href="stylesheets/about_me.css">
		<link rel="stylesheet" href="stylesheets/packages.css">
		<link rel="stylesheet" href="stylesheets/index.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	</head>
<body style="background-color: #999; color: #555;">
    <div>
        <div id="header">
            <h1>Welcome to QuickFix.net!</h1>
        </div>
    </div>

    <div>
        <nav class="nav navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php"><?php echo $whitelist[$page]; ?></a>
                </div>
                <div id="navbar">
                    <ul class="nav navbar-nav">
                        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Packaged Deals<span class="caret"></span></a>
                            <ul class="dropdown-menu" id="items">
                                <li><a href="index.php?page=packages#quick">Quick Fixes</a></li>
                                <li><a href="index.php?page=packages#viruses">Viruses</a></li>
                                <li><a href="index.php?page=packages#hardware">Hardware</a></li>
                                <li><a href="index.php?page=packages#upgrades">Upgrades</a></li>
                                <li><a href="index.php?page=packages#other">Other</a></li>
                            </ul>
                        </li>
                        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Quick Fix<span class="caret"></span></a>
                            <ul class="dropdown-menu" >
                                <li><a href="index.php?page=software_mgmt">Software Management</a></li>
                                <!--<li><a href="networking.html">Networking</a></li>
                                <li><a href="windows.html">Windows Specific</a></li>
                                <li><a href="mac.html">Mac OS X Specific</a></li>
                                <li><a href="linux.html">Linux Specific</a></li>-->
                            </ul>
                        </li>
                        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Contact<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#" data-toggle="modal" data-target="#email">Email</a></li>
                                <li><a href="#" data-toggle="modal" data-target="#fbm">Facebook</a></li>
                                <li><a href="#" data-toggle="modal" data-target="#twitter" >Twitter</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="index.php?page=about_me">About Me</a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <form method="get" action="http://www.google.com/search" class="navbar-form navbar-left">
                            <div class="navbar-group">
                                <input type="text" name="q" class="form-control" placeholder="Search">
                            </div>
                        </form>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div id="breadcrumb" class="container">
        <ol class="breadcrumb">
            <li><a href="index.html">Home</a></li>
            <li><a href="qf.html">Quick Fixes</a></li>
            <li class="active">Software Management</li>
        </ol>
    </div>

    <?php
        require "pages/" . $page . ".php";
    ?>

    <div id="email" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <label>Send me an Email!</label>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="index.php?page=contact">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                            <label>Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                            <label>Message</label>
                            <textarea class="form-control" id="name" name="message" rows="6"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="fbm" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <label>Send me a Facebook Message!</label>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form role="form">
                        <div class="form-group">
                            <label>Facebook URL</label>
                            <input type="email" class="form-control" id="email" >
                            <label>Message</label>
                        </div>
                        <textarea rows="10" cols="60"></textarea>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="twitter" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <label>Send me a tweet!</label>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form role="form">
                        <div class="form-group">
                            <label>Twitter Name</label>
                            <input type="email" class="form-control" id="email" >
                            <label>Tweet</label>
                        </div>
                        <textarea rows="10" cols="60"></textarea>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
