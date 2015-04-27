<?php

namespace Hope\Http
{

    use ArrayAccess;
    use Hope\Core\Error;

    /**
     * Class Bag
     *
     * @package Hope\Http
     */
    class Bag implements ArrayAccess
    {

        /**
         * Bag values
         *
         * @var array
         */
        protected $_values = [];

        /**
         * Bag frozen state
         *
         * @var bool
         */
        protected $_frozen = false;

        /**
         * Create Bag
         *
         * @param array $value
         */
        public function __construct(array $value = [])
        {
            $this->_values = $value;
        }

        /**
         * Returns all values
         *
         * @return array
         */
        public function all()
        {
            return $this->_values;
        }

        /**
         * @param string $key
         * @param mixed  $value
         *
         * @throws \Hope\Core\Error
         *
         * @return \Hope\Http\Bag
         */
        public function set($key, $value)
        {
            if ($this->_frozen) {
                throw new Error(['Can\'t set value to frozen Bag']);
            }

            if (is_string($key)) {
                $this->_values[$key] = $value;
            }
            return $this;
        }

        /**
         * Returns value or default
         *
         * @param string $key
         * @param mixed  $default
         *
         * @return mixed|null
         */
        public function get($key, $default = null)
        {
            if (false == isset($this->_values[$key])) {
                return $default;
            }
            return $this->_values[$key];
        }

        /**
         * @param string $key
         *
         * @return bool
         */
        public function has($key)
        {
            return isset($this->_values[$key]);
        }

        /**
         * Freeze bag
         *
         * @return \Hope\Http\Bag
         */
        public function freeze()
        {
            $this->_frozen = true;

            return $this;
        }

        /**
         * @param string $key
         *
         * @throws \Hope\Core\Error
         *
         * @return \Hope\Http\Bag
         */
        public function remove($key)
        {
            if ($this->_frozen) {
                throw new Error(['Can\'t remove value from frozen Bag']);
            }

            if (isset($this->_values[$key])) {
                unset($this->_values[$key]);
            }
            return $this;
        }

        /**
         * Returns bag frozen state
         *
         * @return bool
         */
        public function isFrozen()
        {
            return (bool) $this->_frozen;
        }

        /**
         * {@inheritdoc}
         */
        public function offsetExists($offset)
        {
            return $this->has($offset);
        }

        /**
         * {@inheritdoc}
         */
        public function offsetGet($offset)
        {
            return $this->get($offset);
        }

        /**
         * {@inheritdoc}
         */
        public function offsetSet($offset, $value)
        {
            $this->set($offset, $value);
        }

        /**
         * {@inheritdoc}
         */
        public function offsetUnset($offset)
        {
            $this->remove($offset);
        }

    }

}