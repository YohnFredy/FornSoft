<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\BinaryPoint;
use App\Models\PointsHistory;
use Carbon\Carbon;

class CopyBinaryPointsToHistory extends Command
{
    /* php artisan copy:binary-points */

    protected $signature = 'copy:binary-points';
    protected $description = 'Copia los datos de binary_points a points_histories';

    public function handle()
    {
        $this->info('Iniciando copia de datos...');

        /* $startDate = Carbon::now()->startOfDay(); // Puedes cambiar la lógica si necesitas una fecha específica
        $endDate = Carbon::now()->endOfDay(); */

        $startDate = Carbon::parse('2025-07-01')->startOfDay();
        $endDate = Carbon::parse('2025-07-31')->endOfDay();

        $binaryPoints = BinaryPoint::all();

        foreach ($binaryPoints as $point) {
            PointsHistory::updateOrCreate(
                [
                    'user_id' => $point->user_id,
                    'start' => $startDate->toDateString(),
                    'end' => $endDate->toDateString(),
                ],
                [
                    'personal' => $point->personal,
                    'unilevel' => 0,
                    'left_binary' => $point->left_points,
                    'right_binary' => $point->right_points,
                ]
            );
        }
        $this->info('Copia completada exitosamente.');
    }
}
