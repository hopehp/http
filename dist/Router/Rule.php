<?php

namespace Hope\Http\Router
{

    use Hope\Http\Router;
    use Hope\Http\Request;

    /**
     * Class Rule
     *
     * @package Hope\Http\Router
     */
    abstract class Rule
    {

        /**
         * Rule name
         *
         * @var string
         */
        protected $_name;

        /**
         * Rule params
         *
         * @var array
         */
        protected $_params;

        /**
         * Router
         *
         * @var \Hope\Http\Router
         */
        protected $_router;

        /**
         * Equals `true` if route has no params
         *
         * @var bool
         */
        protected $_static = false;

        /**
         * Rule http methods
         *
         * @var string[]
         */
        protected $_methods;

        /**
         * Rule pattern
         *
         * @var string
         */
        protected $_pattern;

        /**
         * Rule compiled pattern
         *
         * @var string
         */
        protected $_template;

        /**
         * Instantiate route
         *
         * @param string|string[]   $method
         * @param string            $pattern
         * @param \Hope\Http\Router $router
         */
        public function __construct($method, $pattern, Router $router)
        {
            $this->setRouter($router);
            $this->setMethod(...(array) $method);
            $this->setPattern($pattern);
        }

        /**
         * Set route pattern
         *
         * @param string $pattern
         *
         * @return \Hope\Http\Router\Rule
         */
        public function setPattern($pattern)
        {
            if (false === is_string($pattern)) {
                throw new \InvalidArgumentException('Pattern must be a string');
            }
            $this->_pattern = trim($pattern, '/');

            return $this;
        }

        /**
         * Set allowed http methods
         *
         * @param string ...$method
         *
         * @return \Hope\Http\Router\Rule
         */
        public function setMethod(...$method)
        {
            $this->_methods = $method;

            return $this;
        }

        /**
         * Add allowed methods to rule
         *
         * @param string ...$method
         *
         * @return \Hope\Http\Router\Rule
         */
        public function addMethod(...$method)
        {
            $this->_methods = array_merge($this->_methods, $method);

            return $this;
        }

        /**
         * Checks if given method support this rule
         *
         * @param string $method
         *
         * @return bool
         */
        public function hasMethod($method)
        {
            return in_array($method, $this->_methods);
        }

        /**
         * Set router for rule
         *
         * @param \Hope\Http\Router $router
         *
         * @return \Hope\Http\Router\Rule
         */
        public function setRouter(Router $router)
        {
            $this->_router = $router;

            return $this;
        }

        /**
         * Set rule name
         *
         * @param string $name
         *
         * @throws \InvalidArgumentException
         *
         * @return \Hope\Http\Router\Rule
         */
        public function setName($name)
        {
            if (false === is_string($name)) {
                throw new \InvalidArgumentException('Rule name must be a string');
            }
            $this->_name = $name;

            return $this;
        }

        /**
         * Returns rule name
         *
         * @return string
         */
        public function getName()
        {
            return $this->_name;
        }

        /**
         * Check if route matches for string
         *
         * @param \Hope\Http\Request $request
         *
         * @return \Hope\Http\Router\Rule|bool
         */
        abstract public function match(Request $request);

    }

}