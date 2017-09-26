<?php

/*
 * This file is part of the Doctrine\OrientDB package.
 *
 * (c) Alessandro Nadalin <alessandro.nadalin@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Binding result class that wraps a response from the Curl HTTP client.
 *
 * @package    Doctrine\OrientDB
 * @subpackage Binding
 * @author     Daniele Alessandri <suppakilla@gmail.com>
 * @author     Christian Ascone   <ascone.christian@gmail.com>
 */

namespace Doctrine\OrientDB\Binding\Adapter;

use Doctrine\ODM\OrientDB\Data\Record;
use Doctrine\OrientDB\Binding\HttpBindingResultInterface;
use Doctrine\OrientDB\Binding\InvalidQueryException;
use Doctrine\OrientDB\Binding\Client\Http\CurlClientResponse;

class CurlClientAdapterResult implements HttpBindingResultInterface
{
    protected $response;

    /**
     * @param mixed $response Response object.
     */
    public function __construct(CurlClientResponse $response)
    {
        $this->response = $response;
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        if (!$this->isValid() && !$this->isPartiallyValid() && !$this->isNotFound()) {
            throw new InvalidQueryException($this->response->getBody(), $this);
        }

        // If response is NOT FOUND, returns null
        if ($this->isNotFound()) {
            return null;
        }
        $body = $this->response->getBody();

        // If response is partially valid, the body must be splitted in order to get
        // the right json
        if ($this->isPartiallyValid()) {
            $exploded = explode("\r\n\r\n", $body, 2);
            if (count($exploded) > 0)
                $body = $exploded[count($exploded) - 1];
        }

        if (null === $json = json_decode($body)) {
            if ($this->isValidRid($body)) {
                return $body;
            } elseif ($body === "") {
                return true;
            }
            throw new \RuntimeException("Invalid JSON payload");
        }

        return $json;
    }

    /**
     * {@inheritdoc}
     */
    public function getResult()
    {
        $json = $this->getData();
        $result = isset($json->result) ? $json->result : (isset($json) ? $json : null);
        return $result;
    }

    /**
     * Extract the ResultSet as Object parsed
     * from received JSON and convert every item into
     * a Record
     * @return array List of received Record
     */
    public function getResultAsRecord()
    {
        $json = $this->getData();

        $result = isset($json->result) ? $json->result : (isset($json) ? [$json] : null);

        $result_record = [];

        if($result){
            foreach ($result as $item) {
                $result_record[] = new Record($item);
            }
        }

        return $result_record;
    }

    /**
     * Extract every item from received Record
     * and convert into JSON string
     * @return string
     */

    public function getRecordAsString($record = null){
        return  (string)\GuzzleHttp\json_encode($record ?: $this->getData());

    }

    /**
     * {@inheritdoc}
     */
    public function isValid()
    {
        return in_array($this->response->getStatusCode(), $this->response->getValidStatusCodes());
    }

    /**
     * Returns if the response from the server is partially valid (it requires an additional parsing)
     *
     * @return boolean
     */
    public function isPartiallyValid()
    {
        return in_array($this->response->getStatusCode(), $this->response->getPartiallyValidStatusCodes());
    }

    /**
     * Returns if the item in request is not found
     *
     * @return bool
     */
    public function isNotFound()
    {
        return in_array($this->response->getStatusCode(), $this->response->getNotFoundCodes());
    }

    /**
     * {@inheritdoc}
     */
    public function getInnerResponse()
    {
        return $this->response;
    }

    /**
     * {@inheritdoc}
     */
    protected function isValidRid($body)
    {
        return preg_match('/#\d+:\d+/', $body);
    }
}
