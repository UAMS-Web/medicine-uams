<?php
/**
* Add an automatic default custom taxonomy for calendar.
* If no event (taxonomy) is set, the event will be sorted as “draft” and won’t return an offset error.
*
*/

// Fix ACF Support
add_filter('_includes/acf-pro/settings/show_admin', '__return_true');

add_action('acf/input/admin_head', 'my_acf_admin_head');

function my_acf_admin_head() {

    ?>
    <script type="text/javascript">
    (function($) {

        $(document).ready(function(){

            $('.acf-field-573f70ac9357c .acf-input').append( $('#postdivrich') );

        });

    })(jQuery);
    </script>
    <style type="text/css">
        .acf-field #wp-content-editor-tools {
            background: transparent;
            padding-top: 0;
        }
    </style>
    <?php

}

function add_news_field_groups() {
    acf_add_local_field_group(array (
        'id' => 'acf_newsroom-features',
        'title' => 'Newsroom Features',
        'fields' => array (
            array (
                'key' => 'field_55d64cde65fd2',
                'label' => 'Custom Class',
                'name' => 'custom_class',
                'type' => 'select',
                'instructions' => 'Custom Color for Featured Posts in News Slider',
                'choices' => array (
                    'news_red' => 'Red',
                    'news_blue' => 'Blue',
                    'news_green' => 'Green',
                    'news_gold' => 'Gold',
                    'news_uamsred' => 'UAMS Red',
                    'news_custom1' => 'Custom 1',
                    'news_custom2' => 'Custom 2',
                ),
                'default_value' => '',
                'allow_null' => 1,
                'multiple' => 0,
            ),
            array (
                'key' => 'field_55d64d7965fd3',
                'label' => 'Include Boilerplate',
                'name' => 'include_boilerplate',
                'type' => 'true_false',
                'message' => '',
                'default_value' => 0,
            ),
            array (
                'key' => 'field_55d64dcf65fd4',
                'label' => 'News Release PDF',
                'name' => 'news_release_pdf',
                'type' => 'file',
                'instructions' => 'Please upload PDF version of the Official News Release',
                'save_format' => 'url',
                'library' => 'uploadedTo',
            ),
            array (
                'key' => 'field_55d64e1d65fd5',
                'label' => 'Media Contact',
                'name' => 'media_contact',
                'type' => 'select',
                'choices' => array (
                    'Media Taylor-Peel' => 'Taylor-Peel',
                    'Media Peel-Dupins' => 'Peel-Dupins',
                    'Media Taylor-Dupins' => 'Taylor-Dupins',
                    'Media Taylor-Caldwell' => 'Taylor-Caldwell',
                ),
                'default_value' => '',
                'allow_null' => 1,
                'multiple' => 0,
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'post',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'default',
            'hide_on_screen' => array (
            ),
        ),
        'menu_order' => 0,
    ));
}
add_action('acf/init', 'add_news_field_groups');

add_action( 'widgets_init', 'news_contact_sidebar' );
function news_contact_sidebar() {

  $my_sidebars = array(
    array(
      'name'          => 'Media Taylor-Caldwell',
      'id'            => 'media-taylor-caldwell',
      'description'   => 'Media contact information for Taylor & Caldwell',
    ),
    array(
      'name'          => 'Media Taylor-Dupins',
      'id'            => 'media-taylor-dupins',
      'description'   => 'Media contact information for Taylor & Dupins',
    ),
    array(
      'name'          => 'Media Peel-Dupins',
      'id'            => 'media-peel-dupins',
      'description'   => 'Media contact information for Peel & Dupins',
    ),
    array(
      'name'          => 'Media Taylor-Peel',
      'id'            => 'media-taylor-peel',
      'description'   => 'Media contact information for Taylor & Peel',
    ),   
  );

  $defaults = array(
    'name'          => 'Media Contacts',
    'id'            => 'media-contacts',
    'description'   => 'Media contact information',
    'class'         => '',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h2 class="widgettitle">',
    'after_title'   => '</h2>' 
  );

  foreach( $my_sidebars as $sidebar ) {
    $args = wp_parse_args( $sidebar, $defaults );
    register_sidebar( $args );
  }

}