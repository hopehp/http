<?php

namespace Hope\Http\Router
{

    use Hope\Http\Router;

    /**
     * Class Route
     *
     * @package Hope\Http\Router
     */
    class Route
    {

        protected $_name;

        protected $_params;

        protected $_methods;

        protected $_pattern;

        /**
         * Instantiate route
         *
         * @param string            $pattern
         * @param \Hope\Http\Router $router
         */
        public function __construct($pattern, Router $router)
        {

        }

        /**
         * Check if route matches for string
         *
         * @param string $path
         */
        public function match($path)
        {

        }

    }

}