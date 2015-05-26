<?php

namespace Hope\Http
{

    /**
     * Class Server
     *
     * @package Hope\Http
     */
    class Server extends Bag
    {

        /**
         * @var \Hope\Http\Bag\Headers
         */
        protected $_headers;

        /**
         * @var \Hope\Http\Request
         */
        protected $_request;

        /**
         * @var \Hope\Http\Response
         */
        protected $_response;

        /**
         * Instantiate server instance
         *
         * ```php
         * $server = new Server($_SERVER);
         * $request = $server->getRequest();
         * $response = $server->getResponse();
         * ```
         *
         * @param array $values
         */
        public function __construct(array $values)
        {
            parent::__construct($values, false);
        }

        /**
         * Returns request
         *
         * @param array $post
         * @param array $files
         * @param array $cookies
         *
         * @return \Hope\Http\Request
         */
        public function getRequest(array $post = null, array $files = null, array $cookies = null)
        {
            if ($this->_request === null) {
                $this->_request = Request::make()
                    ->withHeaders($this->getHeaders())
                    ->withCookies($cookies ? : $_COOKIE)
                    ->withMethod($this->get('REQUEST_METHOD', 'GET'))
                    ->withFiles($files ? : $_FILES)
                    ->withPost($post ? : $_POST)
                    ->withUrl($this->get('HTTP_HOST') . $this->get('REQUEST_URI', '/'))
                ;
            }
            return $this->_request;
        }

        /**
         * Returns response
         *
         * @return \Hope\Http\Response
         */
        public function getResponse()
        {
            if ($this->_response === null) {
                $this->_response = new Response();
            }

            return $this->_response;
        }


        /**
         * Returns headers
         *
         * @return \Hope\Http\Bag\Headers
         */
        public function getHeaders()
        {
            if ($this->_headers === null) {
                $this->_headers = new Bag\Headers();
                foreach ($this->_values as $key => $value) {
                    if (0 === strpos($key, 'HTTP_')) {
                        $this->_headers->set(substr($key, 5), $value);
                    } elseif (in_array($key, ['CONTENT_LENGTH', 'CONTENT_MD5', 'CONTENT_TYPE'])) {
                        $this->_headers->set($key, $value);
                    }
                }
            }
            return $this->_headers;
        }

        /**
         * Returns client ip address
         *
         * @param bool $trustProxy
         *
         * @return mixed
         */
        public function getClientIp($trustProxy = false)
        {
            if ($trustProxy) {
                if ($this->get('HTTP_CLIENT_IP') != null) {
                    return $this->get('HTTP_CLIENT_IP');
                } else if ($this->get('HTTP_X_FORWARDED_FOR') != null) {
                    return $this->get('HTTP_X_FORWARDED_FOR');
                }
            }

            return $this->get('REMOTE_ADDR');
        }
    }

}