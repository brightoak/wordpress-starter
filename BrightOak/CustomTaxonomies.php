<?php

namespace App\BrightOak;

class CustomTaxonomies {
    /**
    * Static function that registers the class. Should be called in app/setup.php
    */
    public static function init()
    {
        $self = new self;
        add_action('init', array($self, 'registerCustomTaxonomies'));
    }

    /**
     * This method should call private methods for each custom taxonomy. 
     * That method should have an array of labels, supports, and args and then the register_taxonomy call
     * The supports array is an array of all post types that this taxonomy supports
     */
    public function registerCustomTaxonomies()
    {
        $this->registerExampleTypes();
    }

    private function registerExampleTypes()
    {
          $labels = array(
              'name'                       => _x( 'Example Types', 'Taxonomy General Name', 'text_domain' ),
              'singular_name'              => _x( 'Example Type', 'Taxonomy Singular Name', 'text_domain' ),
              'menu_name'                  => __( 'Example Types', 'text_domain' ),
              'all_items'                  => __( 'All Example Type', 'text_domain' ),
              'parent_item'                => __( 'Parent Example Type', 'text_domain' ),
              'parent_item_colon'          => __( 'Parent Example Type:', 'text_domain' ),
              'new_item_name'              => __( 'New Example Type Name', 'text_domain' ),
              'add_new_item'               => __( 'Add New Example Type', 'text_domain' ),
              'edit_item'                  => __( 'Edit Example Type', 'text_domain' ),
              'update_item'                => __( 'Update Example Type', 'text_domain' ),
              'view_item'                  => __( 'View Example Type', 'text_domain' ),
              'separate_items_with_commas' => __( 'Separate Example Types with commas', 'text_domain' ),
              'add_or_remove_items'        => __( 'Add or remove Example Types', 'text_domain' ),
              'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
              'popular_items'              => __( 'Popular Example Types', 'text_domain' ),
              'search_items'               => __( 'Search Example Types', 'text_domain' ),
              'not_found'                  => __( 'Not Found', 'text_domain' ),
              'no_terms'                   => __( 'No Example Types', 'text_domain' ),
              'items_list'                 => __( 'Example Types list', 'text_domain' ),
              'items_list_navigation'      => __( 'Example Types list navigation', 'text_domain' ),
          );

          $args = array(
              'labels'                     => $labels,
              'hierarchical'               => false,
              'public'                     => true,
              'show_ui'                    => true,
              'show_admin_column'          => true,
              'show_in_nav_menus'          => true,
              'show_tagcloud'              => false,
          );

          $supports = ['example'];

          // Commented out to prevent accidental inclusion
       //   register_taxonomy( 'example_type', $supports, $args );
    }


}