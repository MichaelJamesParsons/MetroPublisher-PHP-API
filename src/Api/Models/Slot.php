<?php
namespace MetroPublisher\Api\Models;

use MetroPublisher\Api\AbstractResourceModel;
use MetroPublisher\Api\Models\Exception\ModelValidationException;
use MetroPublisher\Api\Models\Resolvers\SlotMediaResolver;
use MetroPublisher\Common\Serializers\ModelDeserializer;

/**
 * Class Slot
 * @package MetroPublisher\Api\Models
 *
 * @property string $content_uuid
 * @property string $relevance
 * @property string $display
 * @property string $url
 * @property string $content_url
 */
class Slot extends AbstractResourceModel
{
    /**
     * Relevance of the slot, i.e. how prominently it should be displayed within the content.
     *
     * @link https://api.metropublisher.com/resources/content.html#resource-put-content-slot-put-parameters
     */
    const RELEVANCE_INLINE = 'inline';

    /**
     * Relevance of the slot, i.e. how prominently it should be displayed within the content.
     *
     * @link https://api.metropublisher.com/resources/content.html#resource-put-content-slot-put-parameters
     */
    const RELEVANCE_ASIDE = 'aside';

    /**
     * Display the slot as a gallery.
     *
     * @link https://api.metropublisher.com/resources/content.html#resource-put-content-slot-put-parameters
     */
    const DISPLAY_GALLERY = 'gallery';

    /**
     * Display the gallery as a carousel.
     *
     * @link https://api.metropublisher.com/resources/content.html#resource-put-content-slot-put-parameters
     */
    const DISPLAY_CAROUSEL = 'carousel';

    /**
     * @inheritdoc
     */
    public function save($endpoint)
    {
        if(empty($this->content_uuid)) {
            throw new ModelValidationException("Cannot save slot with no content UUID set.");
        }

        return parent::doSave("/content/{$this->content_uuid}/slots/{$this->uuid}");
    }

    /**
     * @inheritdoc
     */
    public function delete($endpoint)
    {
        if(empty($this->content_uuid)) {
            throw new ModelValidationException("Cannot save slot with no content UUID set.");
        }

        return parent::delete("/content/{$this->content_uuid}/slots/{$this->uuid}");
    }

    /**
     * Fetch the the slot's media objects.
     *
     * @link https://api.metropublisher.com/resources/content.html#content_slot_media_get
     *
     * @return SlotMedia[]
     */
    public function getMedia() {
        $response = $this->client->get("/content/{$this->content_uuid}/slots/{$this->uuid}/media");

        /** @var SlotMedia[] $media */
        $media = ModelDeserializer::convertCollection(new SlotMediaResolver(), $response);
        return $media;
    }

    /**
     * @inheritdoc
     */
    public static function getFieldNames()
    {
        return array_merge([
            'url',
            'content_uuid',
            'relevance',
            'display',
            'content_url'
        ], parent::getFieldNames());
    }

    /**
     * @inheritdoc
     */
    protected function loadMetaData()
    {
        if(empty($this->content_uuid)) {
            throw new ModelValidationException("Cannot load slot meta fields with no content UUID set.");
        }

        return $this->client->get("/content/{$this->content_uuid}/slots/{$this->uuid}");
    }
}