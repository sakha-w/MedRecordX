<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Nurse;
use App\Models\Patient;
use App\Models\Poly;
use App\Models\Queue;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $queueCount = Queue::where('status', 0)->get()->count();

        $queueCount1 = Queue::where('status', 1)->get()->count();

        if (auth()->user()->role === 'dokter') {
            $queueCount = Queue::where('id_poli', auth()->user()->doctor->id_poli)
                               ->where('status', 0)
                               ->count();
        }

        return view('dashboard.index', [
            'pageTitle'    => 'Dashboard',
            'patientCount' => Patient::all()->count(),
            'doctorCount'  => Doctor::all()->count(),
            'nurseCount'   => Nurse::all()->count(),
            'queueCount'   => $queueCount,
            'queueCount1'  => $queueCount1,
            // 'polyCount'    => Poly::all()->count(),
            'queues'       => Queue::all()->filter(function ($todayQueue) {
                if (str_contains($todayQueue, now()->toDateString())) {
                    if (auth()->user()->role === 'dokter') {
                        return Queue::where('id_poli', auth()->user()->doctor->id_poli)->limit(5)->get();
                    }

                    return Queue::all();
                }
            })
        ]);
    }
}