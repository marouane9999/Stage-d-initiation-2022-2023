<?php

namespace App\Http\Controllers;

use App\Http\Requests\RestaurationRequest;
use App\Models\Hebergement;
use App\Models\Participant;
use App\Models\Repas;
use App\Models\Restauration;
use Illuminate\Http\Request;

class RestaurationController extends Controller
{
    public function __construct(Restauration $restauration)
    {
        $this->restauration = $restauration;
    }

    public function index()

    {
        $restaurations = Restauration::paginate(7);
        $repas = Repas::limit(4)->get();
        $site_restau = config('custom_arrays.site_restau');
        return view('restaurations.index')->with([
            'restaurations' => $restaurations,
            'site_restau'=>$site_restau,
            'repas'=>$repas
        ]);


    }
    public function create()
    {
        $site_restau = config('custom_arrays.site_restau');
        $cat_rp = Repas::limit(4)->get();
        $participants =Participant::select('*')->whereNotIn('id',function($query) {
            $query->select('participant_id')->from('restaurations');
        })->get();
        return response()->json([
            'success' => true,
            'html' => view('restaurations.form')->with([
                'restauration' => $this->restauration,
                'participants'=>$participants,
                'title' => 'Ajouter Restauration',
                'repas' => $cat_rp,
                'action' => route('restaurations.store'),
                'site_restau' => $site_restau,
            ])->render()
        ]);
    }
    public function store(RestaurationRequest $request)
    {

        $restauration = new Restauration();
        $restauration->numero_rest = $request->numero_rest;
        $restauration->site_restau = $request->site_restau;
        $restauration->ville = $request->ville;
        $restauration->prestataire = $request->prestataire;
        $restauration->rep_id = $request->rep_id;
        $restauration->participant_id = $request->participant_id;
        $restauration->save();

        return response()->json([
            'success' => true,
            'msg' => 'Restauration créé avec succès.',
        ]);
    }
    public function edit($id)
    {
        $restauration = Restauration::find($id);
        $cat_rp = Repas::get();
        $site_restau = config('custom_arrays.site_restau');
        return response()->json([
            'success' => true,
            'html' => view('restaurations.form')->with([
                'restauration' => $restauration,
                'participants'=>Participant::all(),
                'title' => 'Modifier Restauration',
                'repas' => $cat_rp,
                'action' => route('restaurations.update', $id),
                'site_restau' => $site_restau,
            ])->render()
        ]);
    }
    public function update(RestaurationRequest $request,$id)
    {
        {
            $restauration = Restauration::find($id);
            $restauration->numero_rest = $request->numero_rest;
            $restauration->site_restau = $request->site_restau;
            $restauration->ville = $request->ville;
            $restauration->prestataire = $request->prestataire;
            $restauration->rep_id = $request->rep_id;
            $restauration->participant_id = $request->participant_id;
            $restauration->save();
        }
        return response()->json([
            'success' => true,
            'msg' => 'Restauration updated avec succès.',
        ]);

    }
    public function delete($id)
    {
        $restauration = Restauration::find($id);
        if ($restauration) {
            $restauration->delete();
            return response()->json([
                'success' => true,
                'msg' => 'Restauration deleted avec succès.',
            ]);
        }
    }
    public function show($id)
    {
        $restauration = Restauration::find($id);
        $restauration->get();
        $site_restau = config('custom_arrays.site_restau');
        $countries = config('custom_arrays.countries');
        return view('restaurations.show',['restau'=>$restauration,'site_restau'=>$site_restau,'countries'=>$countries]);
    }

    public function search(Request $request)
    {
        $site_restau = config('custom_arrays.site_restau');
        if($request->site_restau){
        $restaurations = Restauration::where('site_restau','=',$request->site_restau)->paginate(7);
        return view('restaurations.index')->with([
            'restaurations' => $restaurations,
            'site_restau'=>$site_restau
        ]);
        }

        if($request->repas){
        $restaurations = Restauration::where('rep_id','=',$request->repas)->paginate(7);
        $repas = Repas::limit(4)->get();
            return view('restaurations.index')->with([
            'restaurations' => $restaurations,
            'site_restau'=>$site_restau,
            'repas'=>$repas
        ]);

        }
    }


}
