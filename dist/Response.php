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
         * HTTP Response status
         *
         * @var int
         */
        protected $_status;

        /**
         * Set HTTP status
         *
         * @param int $status
         *
         * @return \Hope\Http\Response
         */
        public function setStatus($status)
        {
            $this->_status = $status;

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

    }

}