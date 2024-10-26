<?php

namespace App\Mail;

use App\Models\Order;
use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illumniate\Mail\Mailables\Address;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderPlaced extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order, $user_id)
    {
        $this->order = $order;
        Message::create([
            "sender_id" => 1,
            "body" => "A new order has been placed. Please <a href='https://kikae.com.ng/dashboard/my-store?transactions=true#store-menu'>click here</a> to go and view the order.",
            "recepient_id" => $user_id
        ]);
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Order Placed',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            markdown: 'emails.orders.placed',
            with: [
                'url' => "https://kikae.com.ng/dashboard/my-store?transactions=true#store-menu",
            ],        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}