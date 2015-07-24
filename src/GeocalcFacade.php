<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 7/24/15
 * Time: 12:43 PM
 */

namespace Emcodenet\Geocalc;

use Illuminate\Support\Facades\Facade;

class GeocalcFacade extends Facade {

    /**
     * {@inheritDoc}
     */
    protected static function getFacadeAccessor()
    {
        return 'Geocalc';
    }

}