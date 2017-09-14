<?php
namespace MetroPublisher\Api\Models;

use MetroPublisher\Api\AbstractResourceModel;

/**
 * Class TagCategory
 * @package MetroPublisher\Api\Models
 *
 * @property string $title
 */
class TagCategory extends AbstractResourceModel
{
    /**
     * @inheritdoc
     */
    public function save()
    {
        return parent::doSave("/tags/categories/{$this->uuid}");
    }

    /**
     * @inheritdoc
     */
    public function delete()
    {
        return parent::delete("/tags/categories/{$this->uuid}");
    }

    /**
     * @inheritdoc
     */
    public static function getDefaultFields()
    {
        return array_merge(['title'], parent::getDefaultFields());
    }

    /**
     * @inheritdoc
     */
    protected function loadMetaData()
    {
        return $this->client->get(
            sprintf('%s/tags/categories/%s', $this->getBaseUri(), $this->uuid)
        );
    }
}