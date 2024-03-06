<?php

namespace App\Services;

use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
class ChartServices
{

    public function appointmentCount()
    {
        $mountCounts = Appointment::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(1) as count')
        )
            ->groupBy('month')
            ->get()
            ->toArray();

        $counts = array_fill(0, 12, 0);

        foreach ($mountCounts as $mountCount) {
            $index = $mountCount['month'] - 1;
            $counts[$index] = $mountCount['count'];
        }

        return $counts;
    }

    public function doctorsChart()
    {
        $now = Carbon::now();
        $end = $now->format('Y-m-d');
        $start = $now->subYear()->format('Y-m-d');

        return [
            'end' => $end,
            'start' => $start
        ];
    }

    public function doctorsCharJson(Request $request)
    {
        $start = $request->input('start');
        $end = $request->input('end');

        $doctors = User::doctors()
            ->select('name')
            ->withCount([
                'attendedAppointments' => function ($query) use ($start, $end) {
                    $query->whereBetween('scheduled_date', [$start, $end]);
                },
                'cancellAppointments' => function ($query) use ($start, $end) {
                    $query->whereBetween('scheduled_date', [$start, $end]);
                }
            ])
            ->orderBy('attended_appointments_count', 'desc')
            ->take(5)
            ->get();

        $data = [];
        $data['categories'] = $doctors->pluck('name');

        $series = [];
        $series1['name'] = 'Citas atendidas';
        $series1['data'] =  $doctors->pluck('attended_appointments_count');
        $series2['name'] = 'Citas canceladas';
        $series2['data'] =  $doctors->pluck('cancell_appointments_count');

        $series[] = $series1;
        $series[] = $series2;

        $data['series'] = $series;

        return $data;
    }
}
