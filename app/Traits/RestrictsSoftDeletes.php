<?php

namespace App\Traits;

use Filament\Notifications\Notification;

trait RestrictsSoftDeletes
{
    protected static function bootRestrictsSoftDeletes()
    {
        static::deleting(function ($model) {
            // Biarkan database menangani Force Delete
            if (method_exists($model, 'isForceDeleting') && $model->isForceDeleting()) {
                return;
            }

            if (property_exists($model, 'restrictSoftDeletes')) {
                foreach ($model->restrictSoftDeletes as $relation => $message) {
                    if (is_numeric($relation)) {
                        $relation = $message;
                        $message = 'Data ini tidak bisa dihapus karena masih memiliki relasi dengan data lain.';
                    }

                    if (method_exists($model, $relation) && $model->$relation()->exists()) {
                        if (class_exists(Notification::class)) {
                            Notification::make()
                                ->danger()
                                ->title('Gagal Menghapus Data')
                                ->body($message)
                                ->send();
                        }
                        return false;
                    }
                }
            }
        });
    }
}