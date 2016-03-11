<?php namespace RockRMS;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;

class Exception extends \Exception
{
    //
}

/**
 * @method Promise get($uri, array $options = [])
 * @method Promise head($uri, array $options = [])
 * @method Promise put($uri, array $options = [])
 * @method Promise post($uri, array $options = [])
 * @method Promise patch($uri, array $options = [])
 * @method Promise delete($uri, array $options = [])
 * @method Promise getAsync($uri, array $options = [])
 * @method Promise headAsync($uri, array $options = [])
 * @method Promise putAsync($uri, array $options = [])
 * @method Promise postAsync($uri, array $options = [])
 * @method Promise patchAsync($uri, array $options = [])
 * @method Promise deleteAsync($uri, array $options = [])
 */
class Api
{
    protected $username;
    protected $password;
    protected $apiUrl;
    protected $jar;

    /**
     * @var Client
     */
    public static $client;

    /**
     * @param $username
     * @param $password
     * @param $apiUrl
     */
    public function __construct($username, $password, $apiUrl)
    {
        $this->username = $username;
        $this->password = $password;
        $this->apiUrl = $apiUrl;
        $this->jar = new CookieJar(true);
    }

    /**
     * @param $name
     * @param $args
     * @return Promise
     */
    public function __call($name, $args)
    {
        $promise = call_user_func_array(array($this->client(), $name), $args);
        return new Promise($promise);
    }

    /**
     * Get api client for consuming api
     *
     * @return Client
     * @throws Exception
     */
    public function client()
    {
        if (!static::$client) {

            static::$client = new Client(array(
                'base_uri' => $this->apiUrl,
                'cookies'  => $this->jar,
            ));
        }


        return static::$client;
    }

    /**
     * Authenticate against API with persisted username/password
     *
     * @return $this
     * @throws Exception
     */
    public function auth()
    {
        $response = $this->client()->post('Auth/Login', array('json' => array(
            'Username'  => $this->username,
            'Password'  => $this->password,
            'Persisted' => true,
        )));
        $cookie = current($response->getHeader('Set-Cookie'));

        if (strpos($cookie, '.ROCK') === false) {
            throw new Exception('Invalid authentication cookie returned.');
        }

        return $this;

    }

}
