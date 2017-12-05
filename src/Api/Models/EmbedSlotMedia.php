<?php

namespace MetroPublisher\Api\Models;

use MetroPublisher\MetroPublisher;

/**
 * Class EmbedSlotMedia
 * @package MetroPublisher\Api\Models
 *
 * @property string $embed_code
 */
class EmbedSlotMedia extends SlotMedia
{
    /**
     * Embed code obtained from a third party service.
     *
     * @var string
     */
    protected $embed_code;

    /**
     * EmbedSlotMedia constructor.
     *
     * @param MetroPublisher $metroPublisher
     * @param Slot           $slot
     * @param string         $uuid
     */
    public function __construct(MetroPublisher $metroPublisher, Slot $slot, $uuid)
    {
        parent::__construct($metroPublisher, $slot, $uuid);
        $this->type = SlotMedia::TYPE_EMBED_CODE;
    }

    /**
     * @inheritdoc
     */
    public static function getMetaFields()
    {
        return array_merge(['embed_code'], parent::getMetaFields());
    }
}