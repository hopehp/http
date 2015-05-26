<?php

namespace Hope\Http
{
    use Hope\Http\Router\Path;

    /**
     * Class Router
     *
     * @package Hope\Http
     */
    class Router
    {

        /**
         * Routes
         *
         * @var array
         */
        protected $_routes;

        /**
         * Router param configs
         *
         * @var array
         */
        protected $_params = [];

        /**
         * Register route for method
         *
         * @param string $method
         * @param string $pattern
         *
         * @return \Hope\Http\Router
         */
        public function route($method = '*', $pattern)
        {
            return $this->_routes[] = new Path($method, $pattern, $this);
        }

        /**
         * Register param
         *
         * @param string   $name    Param name
         * @param string   $pattern Regular expression pattern for param
         * @param callable $handler [optional]  Param handler function
         *
         * @return \Hope\Http\Router
         */
        public function param($name, $pattern, callable $handler = null)
        {
            if (false === is_string($name)) {
                throw new \InvalidArgumentException('Param name must be a string');
            }
            if (isset($this->_params[$name])) {
                throw new \InvalidArgumentException("Duplication of '$name' param");
            }

            $this->_params[$name] = [$pattern, $handler];

            return $this;
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