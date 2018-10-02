<?php

namespace App\BrightOak;

class PostTypes
{


    /**
     * This must be called in app/setup.php or it will not run.
     */
    public static function init()
    {
        $self = new self;
        add_action('init', [$self, 'registerPostTypes']);
    }

    /**
     * This method should call a private method for each post type that is registered
     * This simply keeps the code easier to read.
     * Post types should always be singular "book" not "books"
     * The private method should be descriptive.
     * Good: registerBookPostType()
     * Bad: books()
     */
    public function registerPostTypes()
    {

    }

}