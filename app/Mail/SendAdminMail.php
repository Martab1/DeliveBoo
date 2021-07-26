<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendAdminMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $restaurant_id;
    private $my_order;
    public function __construct($data)
    {
        $this->my_order = $data;
        $this->restaurant_id = $data["restaurant_id"];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.sendAdminMail')->with(["order" => $this->my_order, "restaurant_id" => $this->restaurant_id]);
    }
}
