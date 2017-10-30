<?php

/*
 * This file is part of the christianascone\OrientDB package.
 *
 * (c) Alessandro Nadalin <alessandro.nadalin@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Adapter for the standard HTTP client that comes with the library.
 *
 * @package    christianascone\OrientDB
 * @subpackage Binding
 * @author     Daniele Alessandri <suppakilla@gmail.com>
 */

namespace christianascone\OrientDB\Binding\Adapter;

use christianascone\OrientDB\Binding\Client\Http\CurlClient;

class CurlClientAdapter implements HttpClientAdapterInterface
{
    protected $client;
    protected $retry; // Count of retry

    /**
     * CurlClientAdapter constructor.
     * @param CurlClient|null $client
     * @param null $retry
     */
    public function __construct(CurlClient $client = null, $retry = null)
    {
        $this->client = $client ?: new CurlClient();
        if(is_null($retry))
            $retry = 3;
        $this->retry = $retry;
    }

    /**
     * {@inheritdoc}
     */
    public function request($method, $location, array $headers = null, $body = null, $retry = null)
    {
        if(is_null($retry)) {
            $retry = $this->retry;
        }
        if ($headers) {
            foreach ($headers as $k => $v) {
                $this->client->setHeader($k, $v);
            }
        }

        try {
            switch (strtoupper($method)) {
                case 'POST':
                case 'PUT':
                case 'PATCH':
                    $response = $this->client->$method($location, $body);
                    break;
                default:
                    $response = $this->client->$method($location);
                    break;
            }
        }catch(\Exception $e) {
            // Check Retry
            if(!is_null($retry) && $retry > 0) {
                return $this->request($method, $location, $headers, $body, $retry - 1);
            }else{
                throw $e;
            }
        }

        return new CurlClientAdapterResult($response);
    }

    /**
     * {@inheritdoc}
     */
    public function setAuthentication($username, $password)
    {
        $credential = !isset($username, $password) ? null : "$username:$password";
        $this->client->setAuthentication($credential);
    }

    /**
     * {@inheritdoc}
     */
    public function getClient()
    {
        return $this->client;
    }
}
