<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactSubmission;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\ContactFormMail;
use App\Mail\ContactThankYouMail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string|max:1000',
            'property_interest' => 'nullable|string|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        ContactSubmission::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
            'property_interest' => $request->property_interest
        ]);

        // Send email notification
        $recipientEmail = 'amlsampath666@gmail.com';
        Log::info('Attempting to send contact form email', [
            'recipient' => $recipientEmail,
            'submission_name' => $request->name,
            'submission_email' => $request->email,
            'property_interest' => $request->property_interest ?? 'Not specified'
        ]);

        try {
            Mail::to($recipientEmail)->send(
                new ContactFormMail(
                    $request->name,
                    $request->email,
                    $request->phone,
                    $request->property_interest,
                    $request->message
                )
            );
            
            Log::info('Contact form email sent successfully', [
                'recipient' => $recipientEmail,
                'submission_name' => $request->name,
                'submission_email' => $request->email
            ]);
        } catch (TransportExceptionInterface $e) {
            // Handle SMTP connection/timeout errors specifically
            Log::error('SMTP transport error - failed to send contact form email', [
                'recipient' => $recipientEmail,
                'submission_name' => $request->name,
                'submission_email' => $request->email,
                'error_message' => $e->getMessage(),
                'error_type' => 'SMTP Transport Exception',
                'error_file' => $e->getFile(),
                'error_line' => $e->getLine()
            ]);
        } catch (\Exception $e) {
            // Log the error with full details but don't break the user experience
            Log::error('Failed to send contact form email', [
                'recipient' => $recipientEmail,
                'submission_name' => $request->name,
                'submission_email' => $request->email,
                'error_message' => $e->getMessage(),
                'error_file' => $e->getFile(),
                'error_line' => $e->getLine(),
                'error_trace' => $e->getTraceAsString()
            ]);
        }

        // Send thank you email to customer
        try {
            Log::info('Attempting to send thank you email to customer', [
                'customer_email' => $request->email,
                'customer_name' => $request->name
            ]);

            Mail::to($request->email)->send(
                new ContactThankYouMail(
                    $request->name,
                    $request->email
                )
            );

            Log::info('Thank you email sent successfully to customer', [
                'customer_email' => $request->email,
                'customer_name' => $request->name
            ]);
        } catch (TransportExceptionInterface $e) {
            // Handle SMTP connection/timeout errors specifically
            Log::error('SMTP transport error - failed to send thank you email to customer', [
                'customer_email' => $request->email,
                'customer_name' => $request->name,
                'error_message' => $e->getMessage(),
                'error_type' => 'SMTP Transport Exception',
                'error_file' => $e->getFile(),
                'error_line' => $e->getLine()
            ]);
        } catch (\Exception $e) {
            // Log the error but don't break the user experience
            Log::error('Failed to send thank you email to customer', [
                'customer_email' => $request->email,
                'customer_name' => $request->name,
                'error_message' => $e->getMessage(),
                'error_file' => $e->getFile(),
                'error_line' => $e->getLine()
            ]);
        }

        return redirect()->back()->with('success', 'Thank you for your message! We will get back to you soon.');
    }
}
