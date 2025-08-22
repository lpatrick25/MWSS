<?php

namespace App\Http\Controllers;

use App\Http\Requests\Notification\StoreNotificationRequest;
use App\Http\Requests\Notification\UpdateNotificationRequest;
use App\Http\Resources\Notification\NotificationResource;
use App\Http\Resources\Notification\NotificationCollection;
use App\Models\Notification;
use App\Services\NotificationServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationServices $notificationService, Request $request)
    {
        parent::__construct($request);
        $this->notificationService = $notificationService;
    }

    public function index(Request $request): NotificationCollection
    {
        $validated = $request->validate([
            'concessionaire_id' => 'nullable|exists:concessionaires,id',
            'bill_id' => 'nullable|exists:billings,id',
            'notification_types' => 'nullable|in:SMS,Email',
            'status' => 'nullable|in:Pending,Failed,Sent',
            'limit' => 'nullable|integer|min:1',
            'page' => 'nullable|integer|min:1',
        ]);

        $query = $this->notificationService->getAllNotifications($validated);
        $notifications = $query->paginate($this->limit, ['*'], 'page', $this->page);

        return new NotificationCollection($notifications);
    }

    public function show(Notification $notification): JsonResponse
    {
        $notification->load('concessionaire', 'bill');
        return $this->success(new NotificationResource($notification));
    }

    public function store(StoreNotificationRequest $request): JsonResponse
    {
        $notification = $this->notificationService->create($request->validated());
        $notification->load('concessionaire', 'bill');
        return $this->success(new NotificationResource($notification), 'Notification created', 201);
    }

    public function update(UpdateNotificationRequest $request, Notification $notification): JsonResponse
    {
        $notification = $this->notificationService->update($notification->id, $request->validated());
        $notification->load('concessionaire', 'bill');
        return $this->success(new NotificationResource($notification), 'Notification updated');
    }

    public function destroy(Notification $notification): JsonResponse
    {
        $notification->delete();
        return $this->success(null, 'Notification deleted');
    }
}
