<?php

namespace DesignByCode\Realtor\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDataController extends Controller
{

    public function userData()
    {


        $day1 = Carbon::parse('now')->subDays(7)->startOfDay();
        $day2 = Carbon::parse('now')->endOfDay();
        $select = [ DB::raw("count(id) as count, DATE_FORMAT(created_at, '%d %M') as date") ];


        $users = User::select($select)
            ->whereBetween('created_at', [$day1, $day2])
            ->orderBy('date', 'asc')
            ->groupBy('date')
            ->get();

        $labels = [];
        $rows = [];

        foreach ($users as $u) {
            $labels[] = $u->date;
            $rows[] = $u->count;
        }

        $data = [
            'labels' => $labels,
            'rows' => $rows
        ];

        return  response()->json(['data' => $data]);
    }


}
