<?php

namespace App\Services;

use App\Models\Notification;
use Illuminate\Database\Eloquent\Builder;

class NotificationServices
{
    public function getAllNotifications(array $validated): Builder
    {
        return Notification::query()
            ->with(['concessionaire', 'bill'])
            ->when($validated['concessionaire_id'] ?? null, fn ($q) => $q->where('concessionaire_id', $validated['concessionaire_id']))
            ->when($validated['bill_id'] ?? null, fn ($q) => $q->where('bill_id', $validated['bill_id']))
            ->when($validated['notification_types'] ?? null, fn ($q) => $q->where('notification_types', $validated['notification_types']))
            ->when($validated['status'] ?? null, fn ($q) => $q->where('status', $validated['status']));
    }

    public function create(array $data): Notification
    {
        return Notification::create($data);
    }

    public function update(int $id, array $data): Notification
    {
        $notification = Notification::findOrFail($id);
        $notification->update($data);
        return $notification;
    }
}
