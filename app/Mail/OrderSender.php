<?php

namespace App\Mail;

use App\Plugins\Suppliers\Model\Supplier;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Symfony\Component\Finder\SplFileInfo;

class OrderSender extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var SplFileInfo
     */
    private $file;

    /**
     * @var Supplier
     */
    private $supplier;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(SplFileInfo $file, Supplier $supplier)
    {
        $this->file = $file;
        $this->supplier = $supplier;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.supplier')->attach($this->file);
    }
}
