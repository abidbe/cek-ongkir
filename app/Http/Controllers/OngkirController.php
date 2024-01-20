<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Kurir;
use App\Models\Provinsi;
use Illuminate\Http\Request;

class OngkirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $provinsis = $this->getProvinsi();
        $kurirs = $this->getKurir();
        return view("welcome", compact("provinsis", "kurirs"));
    }
    public function store(Request $request){
        $this->validate($request, [
            'origin' => 'required',
            'destination' => 'required',
            'weight' => 'required',
            'courier' => 'required'
        ]);
        $origin = $request->origin;
        $destination = $request->destination;
        $weight = $request->weight;
        $courier = $request->courier;
        $cost = $this->getCost($origin, $destination, $weight, $courier);
        $data = $cost['rajaongkir']['results'][0]['costs'];
        return view('welcome', compact('data'));
    }
    public function getKurir(){
        return Kurir::all();
    }
    public function getProvinsi(){
        return Provinsi::all();
    }
    public function getCity($id){
        return City::where('provinsi_code', $id)->pluck('title', 'code');
    }
    public function searchCity(Request $request){
        $search = $request->search;
        if($search == ''){
            $cities = City::orderby('title', 'asc')->select('title', 'code')->limit(5)->get();
        }else{
            $cities = City::orderby('title', 'asc')->select('title', 'code')->where('title', 'like', '%' .$search . '%')->limit(5)->get();
        }
        $response = [];
        foreach($cities as $city){
            $response[] = [
                "id" => $city->code,
                "text" => $city->title
            ];
        }
        return json_encode($response);
    }
}
