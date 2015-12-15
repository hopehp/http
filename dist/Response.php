<?php

namespace Hope\Http
{

    /**
     * Class Response
     *
     * @package Hope\Http
     */
    class Response extends Message
    {

        /**
         * Response codes
         *
         * @var array
         */
        public static $codes = [
            // Informational block
            100 => 'Continue',
            101 => 'Switching Protocols',
            102 => 'Processing',

            // Success block
            200 => 'OK',
            201 => 'Created',
            202 => 'Accepted',
            203 => 'Non-Authoritative Information',
            204 => 'No Content',
            205 => 'Reset Content',
            206 => 'Partial Content',
            207 => 'Multi-Status',
            208 => 'Already Reported',
            226 => 'IM Used',

            // Redirect block
            300 => 'Multiple Choices',
            301 => 'Moved Permanently',
            302 => 'Found',
            303 => 'See Other',
            304 => 'Not Modified',
            305 => 'Use Proxy',
            306 => 'Reserved',
            307 => 'Temporary Redirect',
            308 => 'Permanent Redirect',

            // Client error block
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            406 => 'Not Acceptable',
            407 => 'Proxy Authentication Required',
            408 => 'Request Timeout',
            409 => 'Conflict',
            410 => 'Gone',
            411 => 'Length Required',
            412 => 'Precondition Failed',
            413 => 'Request Entity Too Large',
            414 => 'Request-URI Too Long',
            415 => 'Unsupported Media Type',
            416 => 'Requested Range Not Satisfiable',
            417 => 'Expectation Failed',
            418 => 'I\'m a teapot',
            422 => 'Unprocessable Entity',
            423 => 'Locked',
            424 => 'Failed Dependency',
            425 => 'Reserved for WebDAV advanced collections expired proposal',
            426 => 'Upgrade Required',
            428 => 'Precondition Required',
            429 => 'Too Many Requests',
            431 => 'Request Header Fields Too Large',

            // Server error block
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
            502 => 'Bad Gateway',
            503 => 'Service Unavailable',
            504 => 'Gateway Timeout',
            505 => 'HTTP Version Not Supported',
            506 => 'Variant Also Negotiates (Experimental)',
            507 => 'Insufficient Bag',
            508 => 'Loop Detected',
            510 => 'Not Extended',
            511 => 'Network Authentication Required'
        ];

        /**
         * HTTP Response status
         *
         * @var int
         */
        protected $_status;

        /**
         * HTTP Response reason
         *
         * @var string
         */
        protected $_reason;

        /**
         * Set HTTP status
         *
         * @param int $status
         *
         * @return \Hope\Http\Response
         */
        public function setStatus($status, $reason = null)
        {
            $this->_status = $status;
            $this->_reason = $reason;

            return $this;
        }

        /**
         * Returns HTTP status
         *
         * @return int
         */
        public function getStatus()
        {
            return $this->_status;
        }

        /**
         * Returns HTTP reason
         *
         * @return string|null
         */
        public function getReason()
        {
            if ($this->_reason == null && $this->_status && isset(static::$codes[$this->_status])) {
                $this->_reason = static::$codes[$this->_status];
            }

            return $this->_reason;
        }

    }

}