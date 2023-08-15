<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if(Auth::check())
        {
            $currentDate = Carbon::today()->startOfDay();

            //for today
            $count_today = Visitor::whereDate('created_at', $currentDate)->count();

            // for a week
            $thisMonday = $currentDate->copy()->startOfWeek(Carbon::MONDAY);
            $currentDateofthisWeek = Carbon::today()->endOfDay();
            // dd($thisMonday);
            $count_week = Visitor::whereBetween('created_at', [$thisMonday, $currentDateofthisWeek])->count();
            // dd($count_week);    

            // for yesterday
            $yesterday = Carbon::yesterday();
            // if ($yesterday->isWeekend()) {
            //     $yesterday = $yesterday->previous(Carbon::FRIDAY);
            // }
            $count_yesterday = Visitor::whereDate('created_at', $yesterday)->count();
            // dd(['count_today' => $count_today, 'count_week' => $count_week, 'count_yesterday' => $count_yesterday]);
            

            return view('home', compact('count_today', 'count_week', 'count_yesterday'));
        }

        return redirect('login');
    }

    function getDataCharts() {
        $resultDates = [];
        $today = Carbon::today();
    
        for ($i = 0; $i < 7; $i++) {
            // Jika hari saat ini adalah hari Sabtu (6) atau Minggu (0)
            // Loncati akhir pekan dengan memundurkan tanggal ke hari Jumat (5)
    
            $resultDates[] = $today->format('Y-m-d');
            $today->subDay();
        }
        // dd($resultDates);

        $feedbackCounts = [];

        foreach ($resultDates as $date) {
            $feedbackCounts[$date] = [
                'sad' => 0,
                'angry' => 0,
                'happy' => 0,
                'netral' => 0,
            ];

            // Ambil jumlah feedback berdasarkan kategori pada tanggal tertentu
            $visitors = Visitor::whereDate('created_at', $date)->get();

            foreach ($visitors as $visitor) {
                $feedback = strtolower($visitor->feedback);
                if (array_key_exists($feedback, $feedbackCounts[$date])) {
                    $feedbackCounts[$date][$feedback]++;
                }
            }
        }

        $feedbackCounts = array_reverse($feedbackCounts, true);
        // dd($feedbackCounts);
        return response()->json($feedbackCounts);
            // dd($feedbackCounts);
    }
}
