<?php

namespace App\BrightOak;


class CustomFields
{

    /**
     * This must be included in app/setup.php
     */
	public static function init()
	{
		$self = new self;
		add_action('acf/init', [$self, 'registerCustomFields']);
	}

    /**
     * This is the callback that actually registers the custom field
     * A private method should be created and called for each field group
     */
	public function registerCustomFields()
	{
		$this->registerTemplateFields();
	}

	private function registerTemplateFields()
    {
        // Exported code from ACF goes here. Export one field group at a time.
    }

}
