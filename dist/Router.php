<?php

namespace Hope\Http
{

    /**
     * Class Router
     *
     * @package Hope\Http
     */
    class Router
    {

        /**
         * @var array
         */
        protected $_routes;

        /**
         * Register route for method
         *
         * @param string $method
         * @param string $pattern
         *
         * @return \Hope\Http\Router
         */
        public function route($method, $pattern)
        {

        }

        /**
         * Register routes for resource
         *
         * @param string $pattern
         *
         * @return \Hope\Http\Router
         */
        public function resource($pattern)
        {

        }
        
        /**
         * Resolve route for given request
         *
         * @param \Hope\Http\Request $request
         *
         * @return bool
         */
        public function resolve(Request $request)
        {
            
        }

    }

}