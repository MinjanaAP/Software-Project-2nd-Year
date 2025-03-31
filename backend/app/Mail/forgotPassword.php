<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class forgotPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    /**
     * Create a new message instance.
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Forgot Password',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'free_adCreate',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

    public function build()
    {
        $baseUrl = env('APP_STAGING_URL');
         //Click <a href='http://127.0.0.1:8000/emailRecovery'>here</a> to recover your email.
        $header = "
        <tr>
            <td style='padding: 20px 0; text-align: center; background-color: #007BFF3F;'>
                <h1 style='color: #000000;'>Password Recovery</h1>
            </td>
        </tr>"; 

        $footer = "
        <tr>
            <td style='padding: 20px 0; text-align: center; background-color: #f8f9fa;'>
                <p style='color: #6c757d;'>This email was sent to you by findit.emporia.com . Please do not reply to this email.</p>
            </td>
        </tr>";

        $body = "
            <tr>
                <td style='padding: 20px 0;'>
                    <p>Hello,</p>
                    <p>We noticed that you requested a password recovery. Click the button below to reset your password:</p>
                    <p><a href='".$baseUrl."/emailRecovery?email=" . urlencode($this->details['email']) . "&token=" . urlencode($this->details['token']) . "' style='background-color: #007bff; color: #ffffff; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Reset Password</a></p>
                    <p>If you did not request a password recovery, you can ignore this email.</p>
                </td>
            </tr>";



        $emailContent = "
            <html>
                <head>
                    <style>
                        body { 
                            font-family: Arial, sans-serif; }
                        button{ 
                            text-decoration: none;
                            background-color: #007bff; 
                            color: #FFFFFF; 
                            padding: 10px 20px; 
                            border-radius: 5px; 
                        }
                        button:hover { 
                            background-color: #0056b3; 
                        }
                    </style>
                </head>
                <body style='margin: 0; padding: 0; font-family: Arial, sans-serif;'>
                <table cellpadding='0' cellspacing='0' width='100%' style='border-collapse: collapse;'>
                    $header
                    $body
                    $footer
                </table>
            </body>
            </html>
        ";

        
        return $this->subject('Email Recovery')->html($emailContent);
    }
}
