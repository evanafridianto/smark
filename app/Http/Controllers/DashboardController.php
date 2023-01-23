<?php

namespace App\Http\Controllers;

use App\Models\Roas;
use Illuminate\Http\Request;
use App\Models\BusinessProfile;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {

        return view('dashboard', [
            'title' => 'Dashboard',
            'umkm' => BusinessProfile::count(),
            'roasLaba' => Roas::where('conclusion', 'Laba')->count(),
            'roasRugi' => Roas::where('conclusion', 'Rugi')->count(),

            'business_profiles' => DB::table('business_profiles')
                ->select('categories.name', DB::raw('count(business_profiles.id) as total'))
                ->leftJoin('categories', 'categories.id', '=', 'business_profiles.category_id')
                ->groupBy('categories.name')
                ->orderBy('total', 'desc')
                ->paginate(5),
            'advertisements' => DB::table('advertisements')
                ->select('advertisements.media', DB::raw('count(advertisements.business_profile_id) as total'))
                ->leftJoin('business_profiles', 'business_profiles.id', '=', 'advertisements.business_profile_id')
                ->groupBy('advertisements.media')
                ->orderBy('total', 'desc')
                ->paginate(5),


            'sales' => DB::table('sales')
                ->select('business_profiles.business_name')
                ->selectRaw('count(IF(status = "sold", 1, null)) as total_sold')
                ->selectRaw('count(IF(status = "return", 1, null)) as total_return')
                ->leftJoin('business_profiles', 'business_profiles.id', '=', 'sales.business_profile_id')
                ->groupBy('business_profiles.business_name')
                // ->orderBy('total_sold', 'desc')
                ->get(),


            'laba' => DB::table('roas')
                ->select('business_profiles.business_name', DB::raw('count(advertisements.business_profile_id) as total'))
                ->where('roas.conclusion', '=', 'Laba')
                ->leftJoin('advertisements', 'advertisements.id', '=', 'roas.advertisement_id')
                ->leftJoin('business_profiles', 'business_profiles.id', '=', 'advertisements.business_profile_id')
                ->groupBy('business_profiles.business_name')
                ->orderBy('total', 'desc')
                ->limit(5)
                ->get(),

        ]);
    }
}