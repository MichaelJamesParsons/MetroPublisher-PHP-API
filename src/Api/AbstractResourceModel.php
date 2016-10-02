<?php
namespace MetroPublisher\Api;

use MetroPublisher\MetroPublisher;

/**
 * Class AbstractResourceModel
 * @package MetroPublisher\Api\Models
 *
 * @property string $uuid
 * @method string getUuid()
 */
class AbstractResourceModel extends AbstractApiResource
{
    /** @var  boolean */
    protected $isSaved;

    /** @var  boolean */
    protected $isMetaDataLoaded;

    /**
     * Lists all of the fields that are allowed to be
     * sent to the API. Fields that are brought back
     * from a findBy() search should be defined in
     * the getFieldNames() method.
     *
     * @var array
     */
    protected static $allowedProperties = [];

    /** @var  array */
    protected $properties;

    public function __construct(MetroPublisher $metroPublisher, array $properties = [])
    {
        parent::__construct($metroPublisher);
        $this->properties = [];
        $this->isSaved = false;
        $this->isMetaDataLoaded = true;
    }

    public function __isset($property)
    {
        return (isset($this->properties, $property));
    }

    public function __unset($property)
    {
        unset($this->properties[$property]);
    }

    public function __get($property)
    {
        if($this->__isset($property)) {
            return $this->properties[$property];
        }

        return null;
    }

    public function __set($property, $value)
    {
        if(!in_array($property, static::$allowedProperties)) {
            throw new \Exception(sprintf("%s has no property %s.", get_class($this), $value));
        }

        if(is_null($value)) {
            $this->__unset($property);
        } else {
            $this->properties[$property] = $value;
        }
    }

    protected function save($endpoint) {
        if($this->isSaved) {
            return $this->client->put($this->getBaseUri() . $endpoint, $this->toJson());
        }

        return $this->client->post($this->getBaseUri() . $endpoint, $this->toJson());
    }

    protected function delete($endpoint) {
        return $this->client->delete($this->getBaseUri() . $endpoint, $this->toJson());
    }

    public function toJson() {
        return json_encode($this->properties);
    }

    public static function getFieldNames() {
        return self::$allowedProperties;
    }
}