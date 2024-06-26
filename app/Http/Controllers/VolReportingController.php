<?php

namespace App\Http\Controllers;

use App\Models\Vol;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VolReportingController extends Controller
{
    public function index()
    {
        $vol = Vol::first();
//        return $vol->created_at->format('Y-m-d') . Carbon::today()->format('Y-m-d');
        $today = Carbon::today()->format('Y-m-d');
        $today_vols = Vol::whereRaw('DATE(created_at) = ?', $today)->orderBy('created_at', 'desc')->get();
        $last_vols = Vol::orderBy('created_at', 'desc')->limit(5)->get();
        $todayarrival_vols = Vol::whereRaw('DATE(date_vol) = ?', $today)->where('type_vol', '=', 0)->get();
        $todaydeparture_vols = Vol::whereRaw('DATE(date_vol) = ?', $today)->where('type_vol', '=', 1)->get();
        return view('vol.reporting')->with([
            'today_vols' => $today_vols,
            'last_vols' => $last_vols,
            'todayarrival_vols' => $todayarrival_vols,
            'todaydeparture_vols' => $todaydeparture_vols
        ]);
    }

        public function download(Request $request) {
            $today = Carbon::today()->format('Y-m-d');
            if($request->has('tv')){
                $pdf=app('dompdf.wrapper');
                $today_vols = Vol::whereRaw('DATE(created_at) = ?', $today)->orderBy('created_at', 'desc')->get();
                $pdf->loadView('vol.pdf',['today_vols'=>$today_vols]);
                return $pdf->download($today.'todayvols.pdf');
            }

            elseif ($request->has('lv')){
                $pdf=app('dompdf.wrapper');
                $last_vols = Vol::orderBy('created_at', 'desc')->limit(5)->get();
                $pdf->loadView('vol.pdf',['last_vols'=>$last_vols]);
                return $pdf->download($today.'lastvols.pdf');
            }

            elseif ($request->has('tav')){
                $pdf=app('dompdf.wrapper');
                $todayarrival_vols = Vol::whereRaw('DATE(date_vol) = ?', $today)->where('type_vol', '=', 0)->get();
                $pdf->loadView('vol.pdf',['todayarrival_vols'=>$todayarrival_vols]);
                return $pdf->download($today.'todayarrival_vols.pdf');
            }

            elseif ($request->has('tdv')){
                $pdf=app('dompdf.wrapper');
                $todaydeparture_vols = Vol::whereRaw('DATE(date_vol) = ?', $today)->where('type_vol', '=', 1)->get();
                $pdf->loadView('vol.pdf',['todaydeparture_vols'=>$todaydeparture_vols]);
                return $pdf->download($today.'todaydeparture_vols.pdf');
            }
            return dd('allo');
        }



}
