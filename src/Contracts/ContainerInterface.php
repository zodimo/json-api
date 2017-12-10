<?php
/**
 * Copyright 2017 Cloud Creativity Limited
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace CloudCreativity\JsonApi\Contracts;

use CloudCreativity\JsonApi\Contracts\Adapter\ResourceAdapterInterface;
use Neomerx\JsonApi\Contracts\Schema\ContainerInterface as BaseContainerInterface;

/**
 * Interface ContainerInterface
 *
 * @package CloudCreativity\JsonApi
 */
interface ContainerInterface extends BaseContainerInterface
{

    /**
     * Get a resource adapter for a domain record.
     *
     * @param $record
     * @return ResourceAdapterInterface
     */
    public function getAdapter($record);

    /**
     * Get a resource adapter by domain record type.
     *
     * @param string $type
     * @return ResourceAdapterInterface
     */
    public function getAdapterByType($type);

    /**
     * Get a resource adapter by JSON API type.
     *
     * @param string $resourceType
     * @return ResourceAdapterInterface|null
     *      the resource type's adapter, or null if no adapter exists.
     */
    public function getAdapterByResourceType($resourceType);

}
