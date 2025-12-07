<?php

namespace App\Traits;

trait AutoIdGenerator
{
    public static function bootAutoIdGenerator()
    {
        static::creating(function ($model) {

            $field = $model->autoIdField;
            $prefix = $model->autoIdPrefix;

            $last = self::orderBy($field, 'desc')->first();
            $lastNumber = $last ? (int) substr($last->$field, strlen($prefix)) : 0;
            $newNumber = $lastNumber + 1;

            $model->$field = $prefix . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
        });
    }
}
