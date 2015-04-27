<?php

namespace Hope\Http\Bag
{

    use Hope\Http\Bag;

    /**
     * Class Server
     *
     * @package Hope\Http\Bag
     */
    class Server extends Bag
    {

        /**
         * Returns server headers
         *
         * @return array
         */
        public function getHeaders()
        {
            $headers = [];
            foreach ($this->_values as $key => $value) {
                if (0 === strpos($key, 'HTTP_')) {
                    $headers[substr($key, 5)] = $value;
                } elseif (in_array($key, ['CONTENT_LENGTH', 'CONTENT_MD5', 'CONTENT_TYPE'])) {
                    $headers[$key] = $value;
                }
            }
            return $headers;
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