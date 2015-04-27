<?php

namespace Hope\Http\Bag
{

    use Hope\Http\Bag;

    /**
     * Class Headers
     *
     * @package Hope\Http\Bag
     */
    class Headers extends Bag
    {

        /**
         * Set header name
         *
         * @param string $key
         * @param mixed  $value
         *
         * @return \Hope\Http\Bag
         */
        public function set($key, $value)
        {
            if (is_string($key)) {
                $key = $this->normalize($key);
            }
            return parent::set($key, $value);
        }

        /**
         * Return header value
         *
         * @param string $key
         * @param null   $default
         *
         * @return mixed|null
         */
        public function get($key, $default = null)
        {
            if (is_string($key)) {
                $key = $this->normalize($key);
            }
            return parent::get($key, $default);
        }

        /**
         * Normalize header name
         *
         * @param string $header
         *
         * @return string
         */
        public function normalize($header)
        {
            $chains = preg_split('#[_-]+#u', $header);

            $chains = array_map(function ($val) {
                return ucfirst(strtolower($val));
            }, $chains);

            return implode('-', $chains);
        }

        /**
         * Parse Accept* headers
         *
         * @param string $header - Accept header name
         *
         * @return array
         */
        public function getAccept($header)
        {
            if ($this->has($header)) {
                //
                $inc = 1;
                $part = explode(',', $this->get($header));
                $result = [];

                foreach ($part as $key => $val) {
                    $test = explode(';', $val);
                    if (isset($test[1])) {
                        $key = (float) str_replace('q=', '', $test[1]);
                    } else {
                        $key = $inc++;
                    }
                    $result[(string) $key] = $test[0];
                }

                return $result;
            }
            return [];
        }

    }

}