<?php

namespace WPVNTeam\WPMetaBox\Options;

use WPVNTeam\WPMetaBox\Options\OptionAbstract;

class Select extends OptionAbstract
{
    public $view = 'select';

    public function get_options()
    {
        return $this->get_arg('options', []);
    }
}
