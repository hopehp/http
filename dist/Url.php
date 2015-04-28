<?php

namespace Hope\Http
{

    use Hope\Core\Error;
    use Hope\Core\Object;

    /**
     * Class Url
     *
     * @package Hope\Http
     */
    class Url extends Object
    {

        /**
         * Source/result url string
         *
         * @var string
         */
        protected $_url;

        /**
         * Url hostname
         *
         * @var string
         */
        protected $_host;

        /**
         * Url port
         *
         * @var int
         */
        protected $_port;

        /**
         * Url user name
         *
         * @var string
         */
        protected $_user;

        /**
         * Url user password
         *
         * @var string
         */
        protected $_pass;

        /**
         * Url path
         *
         * @var string
         */
        protected $_path;

        /**
         * Url query params
         *
         * @var array
         */
        protected $_query = [];

        /**
         * Url scheme
         *
         * @var string
         */
        protected $_scheme;

        /**
         * Possible schemes list
         *
         * @var array
         */
        protected $_schemeList = [
            'http',
            'https'
        ];

        /**
         * Default url scheme
         *
         * @var string
         */
        protected $_schemeDefault = 'http';

        /**
         * Url html fragment
         *
         * @var string
         */
        protected $_fragment;

        /**
         * Create new Url instance
         *
         * @param string $url [optional]
         * @param array  $query [optional]
         */
        public function __construct($url = null, array $query = [])
        {
            if (is_string($url)) {
                $this->parse($url);
            }
            if ($query) {
                $this->setQuery($query);
            }
        }

        /**
         * Set url path
         *
         * @param string $path
         *
         * @return \Hope\Http\Url
         */
        public function setPath($path)
        {
            $this->_path = trim($path, '/');
            return $this;
        }

        /**
         * Returns url path
         *
         * @return string
         */
        public function getPath()
        {
            return $this->_path;
        }

        /**
         * Returns relative path
         *
         * @param string $path Path from
         *
         * @return string
         */
        public function getRelativePath($path = null)
        {
            return $this->format([
                'path' => $this->getPath(),
                'query' => $this->getQuery(),
                'fragment' => $this->getFragment(),
            ]);
        }

        public function getAbsolutePath($path = null)
        {
            return $this->format([
                'scheme' => $this->getScheme(),
                'user' => $this->_user,
                'pass' => $this->_pass,
                'host' => $this->_host,
                'port' => $this->_port,
            ]) . $this->getRelativePath();
        }

        /**
         * Set url host
         *
         * @param \Hope\Http\Host|string $host
         *
         * @return \Hope\Http\Url
         */
        public function setHost($host)
        {
            if ($host instanceof Host && $host->isValid()) {
                $this->_host = $host->getHost();

                if ($port = $host->getPort()) {
                    $this->setPort($port);
                }
                if ($scheme = $host->getScheme()) {
                    $this->setScheme($scheme);
                }
            } else {
                $this->_host = $host;
            }
            return $this;
        }

        /**
         * Returns url host
         *
         * @return string
         */
        public function getHost()
        {
            return $this->_host;
        }

        /**
         * Set url port
         *
         * @param int $port
         *
         * @return \Hope\Http\Url
         */
        public function setPort($port)
        {
            $this->_port = (int) $port;
            return $this;
        }

        /**
         * Returns host port
         *
         * @return int
         */
        public function getPort()
        {
            return $this->_port;
        }

        /**
         * Set url auth credentials
         *
         * @param string $user
         * @param string $pass
         *
         * @return \Hope\Http\Url
         */
        public function setAuth($user, $pass)
        {
            $this->setUser($user);
            $this->setPass($pass);

            return $this;
        }

        /**
         * Set url user name
         *
         * @param string $user
         *
         * @return \Hope\Http\Url
         */
        public function setUser($user)
        {
            $this->_user = $user;
            return $this;
        }

        /**
         * Set url user password
         *
         * @param string $pass
         *
         * @return \Hope\Http\Url
         */
        public function setPass($pass)
        {
            $this->_pass = $pass;
            return $this;
        }

        /**
         * Set query attribute value
         *
         * @param string $key
         * @param mixed $value
         *
         * @return \Hope\Http\Url
         */
        public function setQuery($key, $value = null)
        {
            if (is_array($key)) {
                $this->_query = array_merge($this->_query, $key);
            } else if (is_string($key)) {
                if (is_null($value)) {
                    // Parse query string
                    if (mb_parse_str($key, $value)) {
                        $this->setQuery($value);
                    }
                } else {
                    $this->_query[$key] = $value;
                }
            }
            return $this;
        }

        /**
         * Returns url query dict
         *
         * @return array
         */
        public function getQuery()
        {
            return $this->_query;
        }

        /**
         * Set url scheme
         *
         * @param string $scheme
         *
         * @return \Hope\Http\Url
         */
        public function setScheme($scheme)
        {
            $this->_scheme = $scheme;
            return $this;
        }

        /**
         * Returns url scheme
         *
         * @return string
         */
        public function getScheme()
        {
            if ($this->_scheme == null) {
                $this->_scheme = $this->_schemeDefault;
            }
            return $this->_scheme;
        }

        /**
         * Set url fragment
         *
         * @param string $fragment
         *
         * @return \Hope\Http\Url
         */
        public function setFragment($fragment)
        {
            $this->_fragment = $fragment;
            return $this;
        }

        /**
         * Returns url fragment
         *
         * @return string
         */
        public function getFragment()
        {
            return $this->_fragment;
        }

        /**
         * Generate url string
         *
         * @return string
         */
        public function toString()
        {
            $scheme  = $this->getScheme();
            $hostname = $this->getHost();

            return "$scheme://$hostname";
        }

        /**
         * Parse given url
         *
         * @param string $url
         *
         * @throws \Hope\Core\Error
         *
         * @return \Hope\Http\Url
         */
        protected function parse($url)
        {
            $parts = @parse_url($url);

            if ($parts === false) {
                throw new Error('Can\'t parse invalid url');
            }
            $parts = $parts + [
                'host' => null,
                'port' => null,
                'user' => null,
                'pass' => null,
                'path' => null,
                'query' => null,
                'scheme' => null,
                'fragment' => null,
            ];

            $this->setHost($parts['host']);
            $this->setPort($parts['port']);
            $this->setPath($parts['path']);
            $this->setUser($parts['user']);
            $this->setPass($parts['pass']);
            $this->setQuery($parts['query']);
            $this->setScheme($parts['scheme']);
            $this->setFragment($parts['fragment']);

            return $this;
        }

        /**
         * Format url
         *
         * @param array $parts
         *
         * @return string
         */
        protected function format(array $parts)
        {
            $url = [];

            if (isset($parts['scheme'])) {
                $url[] = $parts['scheme'];
            }
            if (isset($parts['user'])) {
                $url[] = $parts['user'];
                if (isset($parts['pass'])) {
                    $url[] = ':';
                    $url[] = $parts['pass'];
                }
                $url[] = '@';
            }
            if (isset($parts['host'])) {
                $url[] = $parts['host'];
            }
            if (isset($parts['port'])) {
                $url[] = ':';
                $url[] = $parts['port'];
            }
            if (isset($parts['path'])) {
                $url[] = $parts['path'];
            }
            if (isset($parts['query'])) {
                $url[] = '?';
                $url[] = http_build_query($parts['query']);
            }
            if (isset($parts['fragment'])) {
                $url[] = '#';
                $url[] = $parts['fragment'];
            }

            return join('', $url);
        }


        /**
         * Clone this url
         *
         * @return \Hope\Http\Url
         */
        public function copy()
        {
            return clone $this;
        }

        /**
         * Create new Url instance
         *
         * @param string $url [optional]
         * @param array  $query [optional]
         *
         * @return \Hope\Http\Url
         */
        public static function make($url = null, array $query = [])
        {
            return new static($url, $query);
        }
    }

}