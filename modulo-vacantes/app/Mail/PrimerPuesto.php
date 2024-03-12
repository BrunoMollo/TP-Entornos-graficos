<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Llamado;


class PrimerPuesto extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(Llamado $llam,String $contenido)
    {
        //
        $this->llamado = $llam;
        $this->contenido = $contenido;
    }


    public function build()
    {
        return $this->subject('Primer puesto llamado '.$this->llamado->catedra)
                    ->view('Emails.primer_puesto')->with(['llamado' => $this->llamado,'contenido' => $this->contenido]);
    }

    /**
    
    */
    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: 'Primer Puesto',
    //     );
    // }

    // /**
    //  * Get the message content definition.
    //  */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'view.name',
    //     );
    // }

    // /**
    //  * Get the attachments for the message.
    //  *
    //  * @return array<int, \Illuminate\Mail\Mailables\Attachment>
    //  */
    // public function attachments(): array
    // {
    //     return [];
    // }


    
}
