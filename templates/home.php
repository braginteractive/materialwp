<?php
/**
 * Template Name: Home
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package materialwp
 */

get_header(); ?>

<div class="home-hero">
	<div class="container">
		<h1>MaterialWP</h1>
		<p class="lead">Material Design WordPress Theme</p>
		<p><a href="https://github.com/braginteractive/materialwp/archive/materialwp.zip" class="btn btn-primary btn-success btn-raised btn-lg"> Download MaterialWP</a> </p>
		<p>View other <a class="mdt" href="http://materialdesignthemes.com" target="_blank">Material Design Themes</a> </p>
	</div>
</div>

<div class="columns">
<div class="container">
	<h2>Inspired by Material Design and powered by Bootstrap. </h2>

	<div class="row">
		<div class="col-md-4 col-lg-4">
			
			<i class="material-icons">done_all</i>
			<h3>Coolness </h3>
			<p>MaterialWP uses the <a href="https://github.com/FezVrasta/bootstrap-material-design" target="_blank"> Material Design Bootstrap theme</a> by Federico Zivolo to get all the cool features combined with the Bootstrap framework.</p>
		</div>

		<div class="col-md-4 col-lg-4">
			<i class="material-icons">favorite_border</i>
			
			<h3>Underscores.me </h3>
			<p>The base of MaterialWP is the popular <a href="http://underscores.me/" target="_blank">Underscores.me</a> WordPress starter theme. Feel free to make any changes and hack away on it.  </p>
		</div>

		<div class="col-md-4 col-lg-4">
			
			<i class="material-icons">thumb_up</i>
			<h3>Features</h3>
			<p>You can use all the Bootstrap features and components throughout MaterialWP. Don't forget about all 740 original Material Design icons!</p>
		</div>
	</div>

	<p class="lead">MaterialWP is free! Download it on GitHub.</p>
	<p><a href="https://github.com/braginteractive/materialwp" target="_blank" class="btn btn-default btn-raised btn-lg"> View on GitHub</a> </p>

	</div>
</div>
<?php get_footer(); ?>
