<?php

namespace App\Http\Controllers;

use App\Models\ClientResponse;
use App\Services\AdminNotificationService;
use App\Services\MailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TestEmailController extends Controller
{
    protected $mailService;
    protected $adminNotificationService;

    public function __construct(MailService $mailService, AdminNotificationService $adminNotificationService)
    {
        $this->mailService = $mailService;
        $this->adminNotificationService = $adminNotificationService;
    }

    public function testEmail()
    {
        try {
            $to = env('MAIL_ADMIN_EMAIL', 'mohamedtolba161@gmail.com');
            $subject = 'Test Email from DevsAI';
            $message = '<h1>Test Email</h1><p>This is a test email from DevsAI.</p>';

            $result = $this->mailService->sendEmail(
                $to,
                $subject,
                $message
            );

            if ($result) {
                Log::info('Test email sent successfully to ' . $to);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Test email sent successfully to ' . $to
                ]);
            } else {
                Log::error('Failed to send test email to ' . $to);
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to send test email'
                ], 500);
            }
        } catch (\Exception $e) {
            Log::error('Error sending test email: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Error sending test email: ' . $e->getMessage()
            ], 500);
        }
    }

    public function testUnifiedNotification()
    {
        try {
            // Get the latest client response
            $clientResponse = ClientResponse::latest()->first();

            if (!$clientResponse) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No client response found'
                ], 404);
            }

            $userName = $clientResponse->user ? $clientResponse->user->name : 'Test User';

            $result = $this->adminNotificationService->sendUnifiedNotification($clientResponse, $userName);

            if ($result) {
                Log::info('Test unified notification sent successfully');
                return response()->json([
                    'status' => 'success',
                    'message' => 'Test unified notification sent successfully'
                ]);
            } else {
                Log::error('Failed to send test unified notification');
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to send test unified notification'
                ], 500);
            }
        } catch (\Exception $e) {
            Log::error('Error sending test unified notification: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Error sending test unified notification: ' . $e->getMessage()
            ], 500);
        }
    }
}
