<?php

namespace api\modules\v1\models\definitions;

/**
 * @SWG\Definition(required={"title", "body", "category_id"})
 *
 * @SWG\Property(property="id", type="integer")
 * @SWG\Property(property="slug", type="string")
 * @SWG\Property(property="title", type="string")
 * @SWG\Property(property="body", type="string")
 * @SWG\Property(property="view", type="string")
 * @SWG\Property(property="thumbnail_base_url", type="string")
 * @SWG\Property(property="thumbnail_path", type="string")
 * @SWG\Property(property="status", type="integer")
 * @SWG\Property(property="published_at", type="integer")
 * @SWG\Property(property="created_at", type="integer")
 * @SWG\Property(property="updated_at", type="integer")
 * @SWG\Property(property="created_by", type="integer")
 * @SWG\Property(property="updated_by", type="integer")
 * @SWG\Property(property="category", type="object")
 * @SWG\Property(property="articleAttachments", type="object")
 */
class Article
{
    // dummy class for Swagger definitions
}
