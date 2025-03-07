<?php

use Illuminate\Container\Container;

if (!function_exists('app')) {
    /**
     * Mengakses atau menginisialisasi Container Laravel.
     *
     * @param  string|null  $abstract
     * @param  array  $parameters
     * @return mixed|Container
     */
    function app($abstract = null, array $parameters = [])
    {
        static $container;

        if (!$container) {
            $container = new Container();
        }

        if (is_null($abstract)) {
            return $container;
        }

        return $container->make($abstract, $parameters);
    }
}
