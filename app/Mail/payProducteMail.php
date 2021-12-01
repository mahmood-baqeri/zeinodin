<?php

namespace App\Mail;

use App\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class payProducteMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $product;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->product = Product::find($id);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('لینک دریافت فایل')
            ->with([
                'link' => $this->product->link,
            ])
            ->view('mail.payProduct');
    }
}
