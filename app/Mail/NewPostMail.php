<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Crypt;

class NewPostMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $post;
    public $unsubscribeToken;

    /**
     * Create a new message instance.
     */
    public function __construct($post, $unsubscribeToken)
    {
        $this->post = $post;
        $this->unsubscribeToken = $unsubscribeToken;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Post Mail From Ecommerce',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $encryptedToken = Crypt::encrypt($this->unsubscribeToken);
        $unsubscribeUrl = route('unsubscribe', ['token' => $encryptedToken]);
        return new Content(
            view: 'shop.mail.post',
            with: ['post' => $this->post,
                'title_en' => strip_tags($this->post->getTranslation('title','en')),
                'title_ar' => strip_tags($this->post->getTranslation('title','ar')),
                'description_en' => strip_tags($this->post->getTranslation('description','en')),
                'description_ar' => strip_tags($this->post->getTranslation('description','ar')),
                'unsubscribeUrl' => $unsubscribeUrl,
            ]
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
}
