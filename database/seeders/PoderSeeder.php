<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Poder;
use App\Models\Nivel;

class PoderSeeder extends Seeder
{
    public function run(): void
    {
        $nivel1 = Nivel::where('numero_nivel', 1)->first();
        $nivel2 = Nivel::where('numero_nivel', 2)->first();
        $nivel3 = Nivel::where('numero_nivel', 3)->first();

        if (!$nivel1 || !$nivel2 || !$nivel3) {
            $this->command->info('¡Asegúrate de ejecutar NivelSeeder primero para crear los niveles!');
            return;
        }

        Poder::create([
            'nivel_id' => $nivel1->id,
            'nombre_poder' => 'Protección',
            'descripcion' => 'El Guerrero puede interceptar hasta 10 puntos de daño dirigidos a un compañero de equipo. Del daño interceptado, el Guerrero solo recibe el 80%.',
            'clase_personaje' => 'Guerrero',
            'ruta_imagen' => 'images/powers/proteccion.png',
            'costo_pp' => 10
        ]);
        Poder::create([
            'nivel_id' => $nivel1->id,
            'nombre_poder' => 'Botiquín',
            'descripcion' => 'El guerrero recupera 5 HP como mínimo, más 1 HP por cada nivel que tenga por encima.',
            'clase_personaje' => 'Guerrero',
            'ruta_imagen' => 'images/powers/botiquin.png',
            'costo_pp' => 10
        ]);
        Poder::create([
            'nivel_id' => $nivel1->id,
            'nombre_poder' => 'Caza',
            'descripcion' => 'El guerrero puede comer en la clase.',
            'clase_personaje' => 'Guerrero',
            'ruta_imagen' => 'images/powers/caza.png',
            'costo_pp' => 10
        ]);

        Poder::create([
            'nivel_id' => $nivel2->id,
            'nombre_poder' => 'ContraAtaque',
            'descripcion' => 'El guerrero obtiene un indicio para una pregunta en un examen.',
            'clase_personaje' => 'Guerrero',
            'ruta_imagen' => 'images/powers/contraataque.png',
            'costo_pp' => 20
        ]);
        Poder::create([
            'nivel_id' => $nivel2->id,
            'nombre_poder' => 'Grito de Guerra',
            'descripcion' => 'Motiva al equipo: todos los miembros recuperan 5 PP.',
            'clase_personaje' => 'Guerrero',
            'ruta_imagen' => 'images/powers/grito_guerra.png',
            'costo_pp' => 20
        ]);
        
        Poder::create([
            'nivel_id' => $nivel3->id,
            'nombre_poder' => 'Arma Secreta',
            'descripcion' => 'En un examen, el guerrero puede usar una hoja con notas provista por el maestro del juego.',
            'clase_personaje' => 'Guerrero',
            'ruta_imagen' => 'images/powers/arma_secreta.png',
            'costo_pp' => 25
        ]);
        Poder::create([
            'nivel_id' => $nivel3->id,
            'nombre_poder' => 'Asalto Frontal',
            'descripcion' => 'Todos los miembros de un equipo pueden entregar una tarea un día más tarde.',
            'clase_personaje' => 'Guerrero',
            'ruta_imagen' => 'images/powers/asalto_frontal.png',
            'costo_pp' => 30
        ]);
        Poder::create([
            'nivel_id' => $nivel3->id,
            'nombre_poder' => 'Muro de Hierro',
            'descripcion' => 'Durante un día completo, el guerrero no puede perder HP (una vez por semana).',
            'clase_personaje' => 'Guerrero',
            'ruta_imagen' => 'images/powers/muro_hierro.png',
            'costo_pp' => 30
        ]);
        Poder::create([
            'nivel_id' => $nivel3->id,
            'nombre_poder' => 'Carga Heroica',
            'descripcion' => 'El guerrero puede cancelar la penalización de un compañero antes de que se aplique (como si no hubiera fallado).',
            'clase_personaje' => 'Guerrero',
            'ruta_imagen' => 'images/powers/carga_heroica.png',
            'costo_pp' => 25
        ]);

        // --- Poderes de MAGO (sin cambios) ---
        Poder::create([
            'nivel_id' => $nivel1->id,
            'nombre_poder' => 'Transferencia',
            'descripcion' => 'Todos los miembros del equipo, excepto los magos, ganan 7 AP.',
            'clase_personaje' => 'Mago', 
            'ruta_imagen' => 'images/powers/magos/transferencia.png', 
            'costo_pp' => 35
        ]);
        Poder::create([
            'nivel_id' => $nivel1->id,
            'nombre_poder' => 'Invisibilidad',
            'descripcion' => 'El mago queda exento de ser elegido para responder una pregunta.',
            'clase_personaje' => 'Mago',
            'ruta_imagen' => 'images/powers/magos/invisibilidad.png', 
            'costo_pp' => 15
        ]);
        Poder::create([
            'nivel_id' => $nivel1->id,
            'nombre_poder' => 'Teletransporte',
            'descripcion' => 'El mago obtiene tiempo adicional para completar una actividad en clase.',
            'clase_personaje' => 'Mago',
            'ruta_imagen' => 'images/powers/magos/teletransporte.png', 
            'costo_pp' => 25
        ]);

        Poder::create([
            'nivel_id' => $nivel2->id,
            'nombre_poder' => 'Engañar a la Muerte',
            'descripcion' => 'Un compañero caído (que no sea el mago) puede volver a lanzar el dado maldito, pero debe aceptar el nuevo resultado.',
            'clase_personaje' => 'Mago',
            'ruta_imagen' => 'images/powers/magos/enganar_muerte.png', 
            'costo_pp' => 15
        ]);
        Poder::create([
            'nivel_id' => $nivel2->id,
            'nombre_poder' => 'Escudo de Maná',
            'descripcion' => 'El mago evita la pérdida de PS a sí mismo (cuesta 3 AP por 1 PS).',
            'clase_personaje' => 'Mago',
            'ruta_imagen' => 'images/powers/magos/escudo_mana.png', 
            'costo_pp' => 0 
        ]);
        Poder::create([
            'nivel_id' => $nivel2->id,
            'nombre_poder' => 'Distorsión Temporal',
            'descripcion' => 'El mago puede omitir una tarea.',
            'clase_personaje' => 'Mago',
            'ruta_imagen' => 'images/powers/magos/distorsion_temporal.png', 
            'costo_pp' => 35
        ]);

        Poder::create([
            'nivel_id' => $nivel3->id,
            'nombre_poder' => 'Fuente de Maná',
            'descripcion' => 'Un compañero de equipo, que no sea un mago, recarga todos sus AP.',
            'clase_personaje' => 'Mago',
            'ruta_imagen' => 'images/powers/magos/fuente_mana.png', 
            'costo_pp' => 40
        ]);
        Poder::create([
            'nivel_id' => $nivel3->id,
            'nombre_poder' => 'Clarividencia',
            'descripcion' => 'Todos los miembros del equipo del mago obtienen tiempo adicional en una actividad en clase.',
            'clase_personaje' => 'Mago',
            'ruta_imagen' => 'images/powers/magos/clarividencia.png', 
            'costo_pp' => 40
        ]);
        Poder::create([
            'nivel_id' => $nivel3->id,
            'nombre_poder' => 'Círculo de Mago',
            'descripcion' => 'Todos los miembros del equipo del mago pueden omitir una tarea.',
            'clase_personaje' => 'Mago',
            'ruta_imagen' => 'images/powers/magos/circulo_mago.png', 
            'costo_pp' => 50
        ]);

        // --- Poderes de SANADOR (ACTUALIZADOS) ---
        // Poderes Básicos (Nivel 1)
        Poder::create([
            'nivel_id' => $nivel1->id,
            'nombre_poder' => 'Cura I',
            'descripcion' => 'Un compañero obtiene 10 PS.',
            'clase_personaje' => 'Sanador',
            'ruta_imagen' => 'images/powers/sanadores/cura1.png', 
            'costo_pp' => 15
        ]);
        Poder::create([
            'nivel_id' => $nivel1->id,
            'nombre_poder' => 'Santidad',
            'descripcion' => 'El sanador puede usar auriculares durante el trabajo en clase.',
            'clase_personaje' => 'Sanador',
            'ruta_imagen' => 'images/powers/sanadores/santidad.png', 
            'costo_pp' => 10
        ]);
        Poder::create([
            'nivel_id' => $nivel1->id,
            'nombre_poder' => 'Fe Ardiente',
            'descripcion' => 'El sanador puede tomar un breve descanso del trabajo en clase.',
            'clase_personaje' => 'Sanador',
            'ruta_imagen' => 'images/powers/sanadores/feardiente.png', 
            'costo_pp' => 15
        ]);

        // Poderes Intermedios (Nivel 2)
        Poder::create([
            'nivel_id' => $nivel2->id,
            'nombre_poder' => 'Cura II',
            'descripcion' => 'Un compañero obtiene 20 PS.',
            'clase_personaje' => 'Sanador',
            'ruta_imagen' => 'images/powers/sanadores/cura2.png', 
            'costo_pp' => 20
        ]);
        Poder::create([
            'nivel_id' => $nivel2->id,
            'nombre_poder' => 'Favor de los Dioses',
            'descripcion' => 'El sanador puede trabajar con un compañero en la tarea individual.',
            'clase_personaje' => 'Sanador',
            'ruta_imagen' => 'images/powers/sanadores/favordelosdioses.png', 
            'costo_pp' => 25
        ]);
        Poder::create([
            'nivel_id' => $nivel2->id,
            'nombre_poder' => 'Resucitar',
            'descripcion' => 'Cuando un compañero de equipo(sin incluir al sanador) cae a 0 PS, evita todas las penalizaciones y resucita con 1 PS.',
            'clase_personaje' => 'Sanador',
            'ruta_imagen' => 'images/powers/sanadores/resucitar.png', 
            'costo_pp' => 25
        ]);

        Poder::create([
            'nivel_id' => $nivel3->id,
            'nombre_poder' => 'Cura III', 
            'descripcion' => 'El sanador puede usar notas durante una prueba.', 
            'clase_personaje' => 'Sanador',
            'ruta_imagen' => 'images/powers/sanadores/cura3.png', 
            'costo_pp' => 30
        ]);
        Poder::create([
            'nivel_id' => $nivel3->id,
            'nombre_poder' => 'Oración', 
            'descripcion' => 'Todos los miembros del equipo, excepto el Sanador, ganan 15 PS.', 
            'clase_personaje' => 'Sanador',
            'ruta_imagen' => 'images/powers/sanadores/oracionpa.png', 
            'costo_pp' => 30
        ]);
        Poder::create([
            'nivel_id' => $nivel3->id,
            'nombre_poder' => 'Círculo de Curación',
            'descripcion' => 'Todos los miembros del equipo del mago pueden omitir una tarea.', 
            'clase_personaje' => 'Sanador',
            'ruta_imagen' => 'images/powers/sanadores/circulocuracion.png', 
            'costo_pp' => 50
        ]);
    }
}