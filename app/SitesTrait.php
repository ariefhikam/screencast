<?php 

namespace App;

trait sitesTrait {


	public function permalink($title)
    {
        $result = strtolower($title);
        // strip all non word chars
        $result = preg_replace('/\W/', ' ', $result);
        // replace all white space sections with a dash
        $result = preg_replace('/\ +/', '-', $result);
        // trim dashes
        $result = preg_replace('/\-$/', '', $result);
        $result = preg_replace('/^\-/', '', $result);

        return $result;
    }

    
}

