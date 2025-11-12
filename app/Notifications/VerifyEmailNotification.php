<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as BaseVerifyEmail;
use Illuminate\Support\Facades\URL;

class VerifyEmailNotification extends BaseVerifyEmail
{
    protected function verificationUrl($notifiable)
    {
        // 1) Generate API signed URL
        $signedUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );

        // 2) Transform host from API to frontend
        $frontend = rtrim(config('app.frontend_url'), '/'); // e.g. https://app.mysquarely.com

        $parts = parse_url($signedUrl);
        $path = $parts['path'] ?? '';    // /api/v1/verify-email/1/hash
        $query = $parts['query'] ?? '';  // expires & signature

        // Optional: strip /api/v1 prefix if frontend route is /verify-email/:id/:hash
        $path = preg_replace('#^/api/v1#', '', $path);
        var_dump($frontend.$path.($query ? '?'.$query : ''));

        return $frontend.$path.($query ? '?'.$query : '');
    }
}
