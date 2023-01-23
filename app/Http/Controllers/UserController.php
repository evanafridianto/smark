<?php

namespace App\Http\Controllers;

use App\Models\Roas;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;
use App\Exports\ReportExport;
use App\Models\Advertisement;
use App\Exports\UserByIdExport;
use App\Exports\ReportByUserExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BusinessByUserIdExport;

class UserController extends Controller
{

    public function index()
    {
        return view('user.index', [
            'title' => 'User & UMKM',
            'users' => User::latest()->where('role', 'user')->whereHas('businessProfile')->filter(request('search'))->paginate(10)->withQueryString()
        ]);
    }

    public function show($data, $id)
    {
        $user = User::find($id);
        $title = '';
        if ($data == 'user') {
            $title = 'Data User';
        } elseif ($data == 'business-profile') {
            $title = 'Profil UMKM';
        } elseif ($data == 'sales') {
            $title = 'Penjualan';
        } elseif ($data == 'advertisement') {
            $title = 'Advertisement';
        } elseif ($data == 'roas') {
            $title = 'ROAS';
        };

        return view('user.show', [
            'title' => $title,
            'user' =>  $user,
            'sales' => Sale::latest()->where('business_profile_id', $user->businessProfile->id)->filter(request(['start_date', 'end_date']))->paginate(5)->withQueryString(),
            'advertisements' => Advertisement::latest()->where('business_profile_id', $user->businessProfile->id)->filter(request(['start_date', 'end_date']))->paginate(5),
            'roas' => Roas::latest()->whereHas(
                'advertisement',
                fn ($q) =>
                $q->where('business_profile_id', $user->businessProfile->id)
            )->filter(request(['start_date', 'end_date']))->paginate(5),
        ]);
    }

    public function export()
    {
        return (new ReportExport())->download('ReportUser.xlsx');
    }

    public function exportById($id)
    {
        return (new ReportByUserExport($id))->download('ReportByUser.xlsx');
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        $user->tokens()->delete();
        $user->businessProfile()->delete();
        return back()->with('status', 'user-deleted');
    }
}