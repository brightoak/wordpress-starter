<?php

namespace App\BrightOak;

class ThemeOptions
{
    /**
     * Update this per project
     * @var string
     */
    public $clientName = 'Bright Oak';

    /**
     * This must be included in app/setup.php
     */
	public static function init()
	{
		$self = new self;
		add_action('init', [$self, 'registerOptionsPage']);
	}

	public function registerOptionsPage()
	{
		if (function_exists('acf_add_options_page')) {

			acf_add_options_page(array(
				'page_title' => $this->clientName . ' Options',
				'menu_title' => $this->clientName . ' Options',
				'menu_slug' => str_slug($this->clientName) . '-options',
				'capability' => 'edit_posts',
				'redirect' => false
			));

            /**
             * Sample for creating a sub-page
             */
//			acf_add_options_sub_page(array(
//				'page_title' => 'Contact Information',
//				'menu_title' => 'Contact Information',
//				'parent_slug' => str_slug($this->clientName) . '-options',
//			));

			/**
             * Use the ACF Menu to create the field groups. Then use the Tools to export the PHP code.
             * Each Field group should be exported separately, so it can be put in its own private
             * method and then called here. One private method per field group
             */
			$this->exampleFields();

		}
	}

	private function exampleFields()
    {
        // code exported from ACF menu
    }



}