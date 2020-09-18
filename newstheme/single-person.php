<?php
/**
 * The Template for displaying all single posts
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context         = Timber::context();
$timber_post     = Timber::query_post();
$context['post'] = $timber_post;

$context['user'] = new Timber\User();

$query = array(
  'post_type' => 'person',
  'orderby' => 'rand',
  'posts_per_page' => '5'
);
$context['people'] = new Timber\Postquery($query);

if ( post_password_required( $timber_post->ID ) ) {
	Timber::render( 'single-password.twig', $context );
} else {
	Timber::render( array(
    'posts/' . $timber_post->ID . '.twig',
    'posts/' . $timber_post->post_type . '.twig',
    'posts/' . $timber_post->slug . '.twig',
    'single.twig' ),
    $context );
}
