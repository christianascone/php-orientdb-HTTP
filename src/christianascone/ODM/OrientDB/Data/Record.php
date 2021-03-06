<?php

/**
 * Wrapper class for a generic OrientDB Record.
 * Inspired by Record class of PhpOrient (https://github.com/Ostico/PhpOrient)
 *
 * @package    christianascone\OrientDB
 * @subpackage
 * @author     Christian Ascone <ascone.christian@gmail.com>
 */

namespace christianascone\ODM\OrientDB\Data;


class Record {

    /**
     * @var ID The record id.
     */
    protected $rid;

    /**
     * @var string The class this record belongs to.
     */
    protected $oClass;

    /**
     * @var int The record version.
     */
    protected $version = 0;

    /**
     * @var array The raw bytes that make up the record.
     */
    protected $oData = [];

    /**
     * Record constructor.
     * @param \stdClass $params
     */
    public function __construct(\stdClass $params = null) {
        if (empty($params))
            return;
        $properties = get_object_vars($params);
        // Add every property (not starting with @ character)
        // in oData array
        foreach ($properties as $key => $property){
            if(is_string( $key ) && $key[ 0 ] !== '@') {
                $property_to_store = $property;
                // If $property is an object, convert it to an associative array
                // https://stackoverflow.com/a/18576902/5746936
                if (is_object($property_to_store)){
                    $property_to_store = json_decode(json_encode($property), true);
                }
                // If $property is a Rid string (for example #1:25), parse it in a ID object
                if (is_string($property_to_store) && !empty($property_to_store) && $property_to_store[ 0 ] === '#' && strpos($property_to_store, ':') !== false){
                    $property_to_store = new ID($property_to_store);
                }
                $this->oData[$key] = $property_to_store;
            }
        }
        // Set other info
        $this->version = $params->{'@version'};
        if(property_exists($params,'@class'))
            $this->oClass = $params->{'@class'};
        if(property_exists($params, '@rid'))
            $this->rid = new ID($params->{'@rid'});
    }


    /**
     * Gets the Record ID
     * @return ID
     */
    public function getRid() {
        if( !$this->rid instanceof ID ) $this->rid = new ID();
        return $this->rid;
    }

    /**
     * Sets the Record Id
     *
     * @param ID $rid
     *
     * @return $this the current object
     */
    public function setRid( ID $rid ) {
        $this->rid = $rid;

        return $this;
    }


    /**
     * Sets the Orient Class
     *
     * @param string $oClass
     *
     * @return $this the current object
     */
    public function setOClass( $oClass ) {
        $this->oClass = $oClass;

        return $this;
    }

    /**
     * Gets the Orient Class
     * @return string|null
     */
    public function getOClass() {
        return $this->oClass;
    }

    /**
     * Sets the Version
     *
     * @param int $version
     *
     * @return $this the current object
     */
    public function setVersion( $version ) {
        $this->version = $version;

        return $this;
    }

    /**
     * Gets the Version
     * @return int
     */
    public function getVersion() {
        return $this->version;
    }

    /**
     * Sets the Orient Record Content
     *
     * @param array|null $oData
     *
     * @return $this the current object
     */
    public function setOData( Array $oData = null ) {
        if( $oData === null ) $oData = [];
        $this->oData = $oData;
        return $this;
    }

    /**
     * Gets the Orient Record Content
     * @return array
     */
    public function getOData() {
        return $this->oData;
    }

    /**
     * Return a representation of the class that can be serialized as an
     * PhpOrient record.
     *
     * @return mixed
     */
    public function recordSerialize() {
        return $this->jsonSerialize();
    }

    /**
     * (PHP 5 &gt;= 5.4.0)<br/>
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     */
    public function jsonSerialize() {
        $meta = [
            'rid'     => $this->getRid(),
            'version' => $this->getVersion(),
            'oClass'  => $this->getOClass(),
            'oData'   => $this->getOData()
        ];

        return $meta;
    }

    /**
     * To String ( as alias of json_encode )
     *
     * @return string
     */
    public function __toString(){
        return json_encode( $this );
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Whether a offset exists
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     *
     * @param mixed $offset <p>
     *                      An offset to check for.
     *                      </p>
     *
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     */
    public function offsetExists( $offset ) {
        return array_key_exists( $offset, $this->oData );
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to retrieve
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     *
     * @param mixed $offset <p>
     *                      The offset to retrieve.
     *                      </p>
     *
     * @return mixed Can return all value types.
     */
    public function offsetGet( $offset ) {
        if( @array_key_exists( $offset, $this->oData ) ){
            return $this->oData[ $offset ];
        } else {
            return null;
        }
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to set
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     *
     * @param mixed $offset <p>
     *                      The offset to assign the value to.
     *                      </p>
     * @param mixed $value  <p>
     *                      The value to set.
     *                      </p>
     *
     * @return void
     */
    public function offsetSet( $offset, $value ) {
        if( !array_key_exists( $offset, $this->oData ) ){
            trigger_error( 'Offset ' . $offset . ' does not exists in oData structure. Added as a new key.', E_USER_NOTICE );
        }
        $this->oData[ $offset ] = $value;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to unset
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     *
     * @param mixed $offset <p>
     *                      The offset to unset.
     *                      </p>
     *
     * @return void
     */
    public function offsetUnset( $offset ) {
        if( !array_key_exists( $offset, $this->oData ) ){
            trigger_error( 'Offset ' . $offset . ' does not exists in oData structure.', E_USER_NOTICE );
            return;
        }
        unset( $this->oData[ $offset ] );
    }

    /**
     * Magic Method, access directly to the Orient Record
     * content as property
     *
     * @param $name
     *
     * @return mixed
     */
    public function __get( $name ) {
        return $this->offsetGet( $name );
    }

    /**
     * Magic Method, set directly to the Orient Record
     * content as property
     *
     * @param $name
     * @param $value
     */
    public function __set( $name, $value ) {
        $this->offsetSet( $name, $value );
    }

    /**
     * Get a string representation of oData Array
     *
     * @return string
     */
    public function getoDataString(){
        return json_encode($this->getoDataForPost());
    }

    /**
     * Get an associative array of Record data
     * parsing empty EMBEDDABLE fields (namely array parameters)
     * in null values
     *
     * @return array
     */
    public function getoDataForPost() {
        // If oData is empty, returns oData
        if(empty($this->oData))
            return $this->getOData();
        $oDataForPost = [];
        foreach ($this->oData as $key => $val){
            // If field is an array (EMEDDABLE) and it is
            // empty, set it as null
            if(is_array($val) && empty($val)){
                $oDataForPost[$key] = null;
            }else{
                $oDataForPost[$key] = $val;
            }
            // In case of ID object, parse it and set it
            // in string format (for example '#1:25')
            if($val instanceof ID){
                $oDataForPost[$key] = $val->jsonSerialize();
            }
        }

        return $oDataForPost;
    }

    /**
     * Get a string representation of Record which can be used for
     * document save/update.
     * It includes Record rid.
     *
     * @return string
     */
    public function getRecordToPost(){
        return json_encode($this->getoDataForPost() + array('@rid'=>$this->getRid()->jsonSerialize()));
    }

}