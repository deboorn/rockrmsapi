<?php namespace RockRMS;


class Promise
{
    /**
     * @var \GuzzleHttp\Psr7\Response
     */
    public $response;

    /**
     * @return \GuzzleHttp\Psr7\Response
     */
    public function response()
    {
        return $this->response;
    }

    /**
     * @param \GuzzleHttp\Psr7\Response $response
     */
    public function __construct(\GuzzleHttp\Psr7\Response $response)
    {
        $this->response = $response;
    }

    /**
     * @param bool|false $asArray
     * @return mixed
     */
    public function json($asArray = false)
    {
        return json_decode($this->response()->getBody(), $asArray);
    }

}
