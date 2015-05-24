<?php

namespace Hope\Http
{

    /**
     * Class Message
     *
     * @package Hope\Http
     *
     * @property \Hope\Http\Bag\Headers $headers
     * @property \Hope\Http\Bag\Headers $cookies
     */
    abstract class Message
    {

        /**
         * HTTP Headers
         *
         * @var \Hope\Http\Bag\Headers
         */
        protected $_headers;

        /**
         * HTTP Cookies
         *
         * @var \Hope\Http\Bag\Cookies
         */
        protected $_cookies;

        /**
         * HTTP content
         *
         * @var string
         */
        protected $_content;

        /**
         * Returns message content
         *
         * @return string
         */
        public function getContent()
        {
            return $this->_content;
        }

        /**
         * Set message content
         *
         * @param mixed $data
         *
         * @return \Hope\Http\Message
         */
        public function setContent($data)
        {
            $this->_content = $data;

            return $this;
        }

        /**
         * Set message content
         *
         * @param mixed $data
         *
         * @return \Hope\Http\Message
         */
        public function withContent($data)
        {
            return $this->setContent($data);
        }

        /**
         * Set content type
         *
         * @param string $type
         *
         * @return \Hope\Http\Message
         */
        public function setContentType($type)
        {
            $this->_headers->set('Content-Type', $type);

            return $this;
        }

        /**
         * Returns  content type
         *
         * @return mixed
         */
        public function getContentType()
        {
            return $this->_headers->get('Content-Type');
        }

        /**
         * Create instance of message
         *
         * @param ...$args
         *
         * @return static
         */
        public static function make(...$args)
        {
            return new static(...$args);
        }
    }

}