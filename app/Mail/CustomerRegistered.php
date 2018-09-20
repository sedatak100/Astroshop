<?php

namespace App\Mail;

use App\Model\Customers\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CustomerRegistered extends Mailable
{
    use Queueable, SerializesModels;

    public $customer;

    /**
     * Create a new message instance.
     * CustomerRegistered constructor.
     * @param Customer $customer
     */
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->customer->email)
            ->subject('Üyelik Bilgilendirmesi')
            ->from('uyelik@astroshop.com.tr', 'Astro Shop')
            ->view('frontend.mails.customer_registered');
    }
}
