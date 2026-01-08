<?php

namespace App\Traits;

trait AutoIdGenerator
{
    public static function bootAutoIdGenerator()
    {
        static::creating(function ($model) {

            $field = $model->autoIdField ?? $model->getKeyName();
            $incrementLength = $model->autoIdIncrementLength ?? 3;

            // Ambil prefix
            $prefix = null;

            // Jika property autoIdPrefix ada dan string
            if (isset($model->autoIdPrefix) && is_string($model->autoIdPrefix)) {
                $prefix = $model->autoIdPrefix;
            }

            // Jika ada method getAutoIdPrefix, pakai method
            if (method_exists($model, 'getAutoIdPrefix')) {
                $prefix = $model->getAutoIdPrefix();
            }

            if (!$prefix) {
                $prefix = '';
            }

            // Jika incrementLength = 0, langsung pakai prefix
            if ($incrementLength === 0) {
                $model->$field = $prefix;
                return;
            }

            // Ambil last ID berdasarkan prefix
            $lastId = $model->newQuery()
                ->where($field, 'like', $prefix . '%')
                ->orderBy($field, 'desc')
                ->value($field);

            $lastNumber = $lastId
                ? (int) substr($lastId, strlen($prefix))
                : 0;

            $model->$field = $prefix . str_pad($lastNumber + 1, $incrementLength, '0', STR_PAD_LEFT);
        });
    }
}
