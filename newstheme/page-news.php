<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * To generate specific templates for your pages you can use:
 * /mytheme/templates/page-mypage.twig
 * (which will still route through this PHP file)
 * OR
 * /mytheme/page-mypage.php
 * (in which case you'll want to duplicate this file and save to the above path)
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::context();

global $paged;
if (!isset($paged) || !$paged){
    $paged = 1;
}

$query = array(
  'post_type' => 'post',
  'orderby' => 'ID',
  'order' => 'DESC',
  'posts_per_page' => '12',
  'paged' => $paged
);
$context['posts'] = new Timber\Postquery($query);

$context['categories']  = get_terms(array('taxonomy' => 'category'));
$context['tags']        = get_terms(array('taxonomy' => 'post_tag'));

$timber_post     = new Timber\Post();
$context['post'] = $timber_post;
Timber::render( array( 'pages/' . $timber_post->post_name . '.twig', 'page.twig' ), $context );
