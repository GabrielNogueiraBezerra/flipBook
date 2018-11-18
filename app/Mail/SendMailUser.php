<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use App\Models\Venda;

class SendMailUser extends Mailable {

    use Queueable,
        SerializesModels;

    protected $venda;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Venda $venda) {
        $this->venda = $venda;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->from(Auth::user()->contato->email)->subject("Compra no site FlipBook")->view('pages.pagamento')->with('venda', $this->venda);
    }

}
