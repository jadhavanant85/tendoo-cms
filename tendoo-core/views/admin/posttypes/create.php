<?php
// var_dump( get_core_vars( 'posttypes' ) );

$this->gui->cols_width( 1 , 3 );

$this->gui->cols_width( 2 , 1 );

$this->gui->config( 'before_cols' , '<form method="post">' );
$this->gui->config( 'after_cols' , '</form>' );

$this->gui->set_meta( array(
	'type'		=>		'unwrapped',
	'namespace'	=>		$post_namespace . '-create-new'
) )->push_to( 1 );

$this->gui->set_meta( array(
	'type'		=>		'panel',
	'title'		=>		__( 'Details' ),
	'namespace'	=>		$post_namespace . '-create-new-sidebar'
) )->push_to( 2 );

$this->gui->set_item( array(
	'type'			=>		'text',
	'name'			=>		'post_title',
	'placeholder'	=>		__( 'Enter a title' )
) )->push_to( $post_namespace . '-create-new' );

$this->gui->set_item( array(
	'type'			=>		'visual_editor',
	'name'			=>		'post_content'
) )->push_to( $post_namespace . '-create-new' );

if( $defined_taxonomies	=	$current_posttype->query->get_defined_taxonomies() )
{
	foreach( force_array( $defined_taxonomies ) as $tax_namespace	=> $_taxonomy )
	{
		//current_posttype
		$taxonomy_text		=	$taxonomy_value	=	array();
		$taxonomies_list	=	$current_posttype->query->get_taxonomies( $tax_namespace );
		
		foreach( force_array( $taxonomies_list ) as $_taxonomy )
		{
			$taxonomy_text[]	=	riake( 'TITLE' , $_taxonomy );
			$taxonomy_value[]	=	riake( 'ID' , $_taxonomy );
		}
		
		$this->gui->set_item( array( 
			'type'			=>		'multiple',
			'name'			=>		'post_taxonomy',
			'text'			=>		$taxonomy_text,
			'value'			=>		$taxonomy_value,
			'label'			=>		__( 'Select a taxonomy' )
		) )->push_to( $post_namespace . '-create-new-sidebar' );
	}
	
	
	
}

$this->gui->set_item( array(
	'type'			=>		'buttons',
	'name'			=>		array( 'submit_content' ),
	'value'			=>		array( __( 'Submit'  ) ),
	'buttons_types'	=>		array( 'submit' )
) )->push_to( $post_namespace . '-create-new-sidebar' );




$this->gui->get();