<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait UuidPrimaryKeyable
{
    /**
     * Boot the UUID model trait for the model.
     */
    protected static function bootUuidModelTrait()
    {
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    /**
     * Get the value indicating whether the IDs are incrementing.
     *
     * @return bool
     */
    public function getIncrementing()
    {
        return false;
    }

    /**
     * Get the data type for the ID.
     *
     * @return string
     */
    public function getKeyType()
    {
        return 'string';
    }

    /**
     * Perform an insert operation.
     */
    protected function performInsert(\Illuminate\Database\Eloquent\Builder $query)
    {
        if ($this->getKeyType() === 'string' && ! isset($this->attributes[$this->primaryKey])) {
            $this->setId();
        }

        parent::performInsert($query);
    }

    /**
     * Set the UUID as the ID.
     */
    protected function setId()
    {
        $this->attributes[$this->primaryKey] = (string) Str::uuid();
    }
}
