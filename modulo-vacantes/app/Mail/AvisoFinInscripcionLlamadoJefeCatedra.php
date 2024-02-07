<?php

namespace App\Mail;

use App\Models\Llamado;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AvisoFinInscripcionLlamadoJefeCatedra extends Mailable
{

    public $llamado;

    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(Llamado $llam)
    {
        $this->llamado = $llam;
    }

    /**
     * Get the message envelope.
     */
    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: 'Aviso Fin Inscripcion Llamado Jefe Catedra',
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

    // COMENTADAS PORQUE NOSE PARA QUE SIRVEN


    public function build()
    {
        return $this->subject('Aviso Fin Inscripcion a Llamado')
                    ->view('Emails.aviso_fin_inscripcion_llamado')->with('llamado',$this->llamado);
    }
}
