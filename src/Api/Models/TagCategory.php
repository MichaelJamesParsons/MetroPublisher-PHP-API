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
        return $this->doSave("/tags/categories/{$this->uuid}");
    }

    /**
     * @inheritdoc
     */
    public function delete()
    {
        return $this->doDelete("/tags/categories/{$this->uuid}");
    }

    /**
     * @inheritdoc
     */
    public static function getDefaultFields()
    {
        return array_merge(['title', 'urlname'], parent::getDefaultFields());
    }

    /**
     * @inheritdoc
     */
    protected function loadMetaData()
    {
        return $this->context->get("/tags/categories/{$this->uuid}");
    }
}