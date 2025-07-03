<?php
namespace App\Imports;

use App\Models\User;
use App\Models\Estudiante;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class StudentsImport implements ToCollection
{
    protected $idClase;

    public function __construct($idClase)
    {
        $this->idClase = $idClase;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {
            if ($index === 0) continue; // Saltar encabezado

            // Validar columnas no vacías
            if (empty($row[0]) || empty($row[1])) {
                continue;
            }

            $nombre = trim($row[0]);
            $email = trim($row[1]);

            $user = User::firstOrCreate(
                ['email' => $email],
                [
                    'name' => $nombre,
                    'password' => bcrypt('tecsup'),
                    'role' => 'estudiante'
                ]
            );

            Estudiante::updateOrCreate(
                ['id_user' => $user->id],
                ['id_clase' => $this->idClase]
            );
        }
    }
}
