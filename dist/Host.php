<?php

namespace Hope\Http
{

    class Host
    {

        /**
         * @var string
         */
        protected $_host;

        /**
         * @var int
         */
        protected $_port;

        /**
         * @var string
         */
        protected $_scheme;

        /**
         * @param string $host
         *
         * @return \Hope\Http\Host
         */
        public function setHost($host)
        {
            $this->_host = $host;
            return $this;
        }

        /**
         * Returns host
         *
         * @return string
         */
        public function getHost()
        {
            return $this->_host;
        }

        /**
         * Set port number
         *
         * @param int $port
         *
         * @return \Hope\Http\Host
         */
        public function setPort($port)
        {
            $this->_port = $port;
            return $this;
        }

        /**
         * Returns host port
         *
         * @return string
         */
        public function getPort()
        {
            return $this->_port;
        }


        /**
         * Set default host scheme
         *
         * @param string $scheme
         *
         * @return \Hope\Http\Host
         */
        public function setScheme($scheme)
        {
            $this->_scheme = $scheme;
            return $this;
        }

        /**
         * Returns host port
         *
         * @return string
         */
        public function getScheme()
        {
            return $this->_scheme;
        }

        /**
         * Validate host
         *
         * @return bool
         */
        public function isValid()
        {
            return true; // TODO : Create host validator
        }

        /**
         * Create absolute url from this host
         *
         * @param string $path [optional]
         * @param array  $query [optional]
         *
         * @return \Hope\Http\Url
         */
        public function getUrl($path = null, array $query = [])
        {
            return Url::make($path, $query)
                ->setHost($this->_host)
                ->setPort($this->_port)
                ->setScheme($this->_scheme)
                ;
        }

    }

}