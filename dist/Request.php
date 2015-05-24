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
         * Requested url
         *
         * @var \Hope\Http\Url
         */
        protected $_url;

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
         * Uploaded files
         *
         * @var \Hope\Http\Bag\Files
         */
        protected $_files;

        /**
         * HTTP Request method
         *
         * @var string
         */
        protected $_method;

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
        public function getPost($key = null, $default = null)
        {
            return $this->_post->get($key, $default);
        }

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
        public function getQuery($key = null, $default = null)
        {
            return $this->_get->get($key, $default);
        }

        /**
         * Check if given method(s) is valid for this request
         *
         * @param string ...$method Methods for check
         *
         * @return bool
         */
        public function isMethod(...$method)
        {
            return in_array($this->_method, $method);
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

        /**
         * Add headers for request
         *
         * @param \Hope\Http\Bag\Headers|array $data
         *
         * @return \Hope\Http\Request
         */
        public function withHeaders($data)
        {
            $this->_headers = $data instanceof Bag\Headers
                ? $data
                : new Bag\Headers($data);

            return $this;
        }

        /**
         * Add cookies for request
         *
         * @param \Hope\Http\Bag\Cookies|array $data
         *
         * @return \Hope\Http\Request
         */
        public function withCookies($data)
        {
            $this->_cookies = $data instanceof Bag\Cookies
                ? $data
                : new Bag\Cookies($data);

            return $this;
        }

        /**
         * Add files for request
         *
         * @param \Hope\Http\Bag\Files|array $data
         *
         * @return \Hope\Http\Request
         */
        public function withFiles($data)
        {
            if ($data instanceof Bag\Files) {
                $this->_files = $data;
            } else {
                $this->_files = new Bag\Files($data);
            }
            return $this;
        }

        public function withMethod($name)
        {
            $this->_method = $name;
            return $this;
        }

        /**
         * Add Post values for request
         *
         * @param \Hope\Http\Bag|array $data
         *
         * @return \Hope\Http\Request
         */
        public function withPost($data)
        {
            if ($data instanceof Bag) {
                $this->_post = $data;
            } else {
                $this->_post = new Bag($data);
            }
            return $this;
        }

        /**
         * Set url to this request
         *
         * @param \Hope\Http\Url|string $url
         *
         * @return \Hope\Http\Request
         */
        public function withUrl($url)
        {
            if ($url instanceof Url) {
                $this->_url = $url;
            } else {
                $this->_url = new Url($url);
            }
            return $this;
        }

    }

}