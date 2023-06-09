<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<title><?php echo wp_get_document_title(); ?></title>
	<meta content="" name="description">
	<meta content="" name="keywords">
	<link href="<?php echo get_template_directory_uri();?>/assets/img/favicon.png" rel="icon">
	<link href="<?php echo get_template_directory_uri();?>/assets/img/apple-touch-icon.png" rel="apple-touch-icon">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<?php wp_head(); ?>
</head>
<body <?php body_class();?>
<section id="topbar" class=" d-flex align-items-center ">
    <div class="container-fluid d-flex justify-content-center justify-content-md-between topbar">
        <div class="contact-info d-flex align-items-center">
            <i class="bi bi-envelope d-flex align-items-center"><a href="#">lidyhiv_zosh@ukr.net</a></i>
            <i class="bi bi-phone d-flex align-items-center ms-4"><span>+380 662 766 218</span></i>
        </div>
        <div class="social-links d-none d-md-flex align-items-center">
            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="https://www.facebook.com/profile.php?id=100045865054318" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="https://www.instagram.com/_grisha.volkov_/"><i class="bi bi-instagram"></i></a>
            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
        </div>
    </div>
</section>
<header id="header" class="header d-flex align-items-center sticked-login">
	<div class="container-fluid container-xl d-flex align-items-center justify-content-between">
		<a href="<?php echo get_option('home'); ?>" class="logo d-flex align-items-center">
			<h1>Лідихівська<span>ЗОШ</span></h1>
		</a>
		<nav id="navbarn" class="navbar">
			<?php wp_nav_menu( [
				'theme_location'  => 'header_menu',
				'container'       => 'navbar',
                'container_class' => '',
				'menu_class'      => '',
				'container_id'    => 'navbar',
				'depth'           => 3,
			] ); ?>
		</nav>
		<i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
		<i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
	</div>
</header>
