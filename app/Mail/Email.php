<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Facades\Log;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Support\Facades\Queue;

class Email extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $data;
    public $view;

    public function __construct($data = null, $view = null)
    {
        $this->data = $data;
        $this->view = $view;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->data['subject'],
        );
    }

    public function content(): Content
    {

        // $this->data['agent'] = '';

        return new Content(
            // markdown: 'mail.default',
            view: 'mail.'.$this->view,
            with: [
                'data' => $this->data,
                // 'level' => 'good',
                // 'introLines' => [],
                // 'outroLines' => [],

            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
