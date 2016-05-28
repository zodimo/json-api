<?php

/**
 * Copyright 2016 Cloud Creativity Limited
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

namespace CloudCreativity\JsonApi\Validators;

use CloudCreativity\JsonApi\Contracts\Validators\ValidationMessageFactoryInterface;
use CloudCreativity\JsonApi\Document\Error;
use CloudCreativity\JsonApi\Exceptions\RepositoryException;
use Neomerx\JsonApi\Contracts\Document\ErrorInterface;

class ValidationMessageFactory implements ValidationMessageFactoryInterface
{

    /**
     * @var array
     */
    private $errors;

    /**
     * ValidationMessageRepository constructor.
     * @param array $errors
     */
    public function __construct(array $errors)
    {
        $this->errors = $errors;
    }

    /**
     * @param string $key
     * @param array $values
     * @return ErrorInterface
     */
    public function error($key, array $values = [])
    {
        if (!$this->has($key)) {
            throw new RepositoryException("Did not recognise error key: $key");
        }

        $arr = $this->get($key);

        return Error::create($this->replacer($arr, $values));
    }

    /**
     * @param $key
     * @return bool
     */
    protected function has($key)
    {
        return isset($this->errors[$key]);
    }

    /**
     * @param $key
     * @return array
     */
    protected function get($key)
    {
        return isset($this->errors[$key]) ? (array) $this->errors[$key] : [];
    }

    /**
     * @param array $error
     * @param array $values
     * @return array
     */
    protected function replacer(array $error, array $values)
    {
        if (!isset($error[Error::DETAIL])) {
            return $error;
        }

        foreach ($values as $key => $value) {
            $error[Error::DETAIL] = str_replace($key, $value, $error[Error::DETAIL]);
        }

        return $error;
    }
}