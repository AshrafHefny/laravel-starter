<?php

namespace App\Starter\BaseApp\Traits;

use Illuminate\Support\Facades\Log;

trait Logger {
    public function logs() {
        return $this->morphMany(Log::class, 'loggable');
    }

    public static function bootLogger() {
        if (env('ENABLE_LOG')) {
            static::created(function ($model) {
                $model->logCreated();
            });
            static::updating(function ($model) {
                $model->logUpdated();
            });
            static::deleting(function ($model) {
                $model->logDeleted($model);
            });
        }
    }

    protected function insertNewLog($action, $before, $after) {
        $userId = auth()->user()->id;
        return $this->logs()->save(new \App\Models\Log(['user_id' => $userId,
                    'action' => $action,
                    'before' => $before ? json_encode($before) : null,
                    'after' => $after ? json_encode($after) : null]));
    }

    protected function logCreated() {
        $model = $this->stripRedundantKeys();
        return $this->insertNewLog('created', null, $model);
    }

    protected function logUpdated() {
        $diff = $this->getDiff();
        return $this->insertNewLog('updated', $diff['before'], $diff['after']);
    }

    protected function logDeleted() {
        $model = $this->stripRedundantKeys();
        return $this->insertNewLog('deleted', $model, null);
    }

    /**
     * Fetch a diff for the model's current state.
     */
    protected function getDiff() {
        $after = $this->getDirty();
        $before = array_intersect_key($this->fresh()->toArray(), $after);
        return compact('before', 'after');
    }

    protected function stripRedundantKeys() {
        $model = $this->toArray();
        if (isset($model['created_at'])) {
            unset($model['created_at']);
        }

        if (isset($model['updated_at'])) {
            unset($model['updated_at']);
        }

        if (isset($model['id'])) {
            unset($model['id']);
        }

        return $model;
    }

}
