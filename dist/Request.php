<?php

namespace Hope\Http
{

    /**
     * Class Request
     *
     * @package Hope\Http
     *
     * @property \Hope\Http\Bag $get
     * @property \Hope\Http\Bag $post
     */
    class Request extends Message
    {

        /**
         * HTTP GET params
         *
         * @var \Hope\Http\Bag
         */
        protected $_get;

        /**
         * HTTP POST params
         *
         * @var \Hope\Http\Bag
         */
        protected $_post;

        /**
         * HTTP Request method
         *
         * @var string
         */
        protected $_method;

        /**
         * Returns GET values
         *
         * @see \Hope\Http\Bag::get
         *
         * @param string $key [optional]
         * @param mixed  $default [optional]
         *
         * @return mixed|null
         */
        public function get($key = null, $default = null)
        {
            return $this->_get->get($key, $default);
        }

        /**
         * Returns POST values
         *
         * @see \Hope\Http\Bag::get
         *
         * @param string $key [optional]
         * @param mixed  $default [optional]
         *
         * @return mixed|null
         */
        public function post($key = null, $default = null)
        {
            return $this->_post->get($key, $default);
        }

        /**
         * Returns request method
         *
         * @return string
         */
        public function getMethod()
        {
            return $this->_method;
        }

    }

}