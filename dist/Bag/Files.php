<?php

namespace Hope\Http\Bag
{

    use Hope\Http\Bag;
    use Hope\Util\File;

    /**
     * Class Files
     *
     * @package Hope\Http\Bag
     */
    class Files extends Bag
    {

        /**
         * Returns
         *
         * @param null $key
         * @param null $default
         *
         * @return \Hope\Util\File|null
         */
        public function get($key = null, $default = null)
        {
            if (is_string($key) && $this->has($key)) {
                if (isset($this->_values[$key]['tmp_name'])) {
                    $file = new File($this->_values[$key]['tmp_name']);
                    $file->setName($file['name']);

                    return $file;
                }
            }
            return parent::get($key, $default);
        }

    }

}