<?php

namespace App\Config;

use Exception;

/**
 * Class Config
 */
class Config
{
    /**
     * @param string $key
     *
     * @return mixed
     *
     * @throws Exception
     */
    public function getParameter(string $key)
    {
        if (!$key) {
            throw new Exception("Parameter '$key' is missing.");
        }

        $parameterLists = require __DIR__ . '/../../parameters.php';

        return $parameterLists[$key];
    }
}
