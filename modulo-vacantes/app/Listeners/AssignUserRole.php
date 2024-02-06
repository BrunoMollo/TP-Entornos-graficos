<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Spatie\Permission\Models\Role;

class AssignUserRole
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        // Asigna el rol al usuario recién registrado,desde el register de Auth
        $role = Role::where('name', 'postulante')->first();

        if ($role) {
            $event->user->assignRole($role);
        }
    }
}
