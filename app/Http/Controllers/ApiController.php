<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Apartment;
use App\Models\User;
use App\Models\Service;
use App\Models\Sponsor;
use App\Models\Statistic;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ApiController extends Controller
{

    public function getData()
    {
        $services = Service::all();
        $sponsors = Sponsor::all();

        return response()->json([
            "success" => true,
            "response" => [
                "services" => $services,
                "sponsors" => $sponsors,

            ]
        ]);

    }
    public function createApartment(Request $request)
    {
        $data = $request->validate([
            "title" => ["string", "required", "min:10", "max:64"],
            "description" => ["string", "required", "min:20", "max:255"],
            "price" => ["decimal:0,5", "required"],
            "rooms_num" => ["integer", "required", "max:100"],
            "beds_num" => ["integer", "required", "max:200"],
            "baths_num" => ["integer", "required", "max:50"],
            "size" => ["integer", "required"],
            "address" => ["string", "required", "max:255"],
            "lat" => ["required"],
            "long" => ["required"],
            "services" => ["array", "nullable"],
            'imageApartment' => ["image", "required", "mimes:jpg,png,jpeg,gif,svg", "max:2048"],

        ]);

        if (array_key_exists("imageApartment", $data)) {

            $img_path = Storage::put('uploads', $data['imageApartment']);
            $data['imageApartment'] = $img_path;
        } else {
            $data['imageApartment'] = 'avatar5.png';
        }

        $ap = Apartment::make($data);


        $id = auth()->user()->id;
        $currentuser = User::find($id);
        $ap->user()->associate($currentuser);
        $ap->save();

        $services = Service::find([$data["services"]]);
        $ap->services()->attach($services);

        $statistics = new Statistic();
        $statistics->ip_address = request()->ip();

        return response()->json([
            "success" => true,
            "response" => $ap
        ]);
    }
    public function createApartmentPage()
    {
        return view('createApartment');

    }
    public function userApartments()
    {
        // $apartments = Apartment::all()->where('user_id', 'like', auth()->user()->id);
        $apartments = DB::table('apartments')
            ->where('user_id', 'like', auth()->user()->id)
            ->get();

        return response()->json([
            "success" => true,
            "response" => $apartments
        ]);
    }
    public function userApartmentsPage()
    {
        return view('apartment');
    }
    public function getApartments()
    {
        $apartments = Apartment::all();

        return response()->json([
            "success" => true,
            "response" => $apartments
        ]);
    }
    public function deleteApartment(Apartment $apartment)
    {

        $apartment->sponsors()->sync([]);
        $apartment->services()->sync([]);
        $apartment->added_images()->delete();
        $apartment->delete();
        return response()->json([
            "success" => true,
            "response" => $apartment
        ]);
    }

    // public function geteditApartment(Apartment $apartment)
    // {

    //     return response()->json([
    //         "success" => true,
    //         "response" => $apartment
    //     ]);

    // }
    public function getApartment($id)
    {

        $apartment = Apartment::find($id);
        $apartment["services"] = $apartment->services;

        return response()->json([
            "success" => true,
            "response" => $apartment
        ]);

    }
    public function userEditApartmentsPage()
    {
        return view("editApartment");
    }
    public function updateApartment(Request $request, Apartment $apartment)
    {
        $data = $request->validate([
            "title" => ["string", "required", "min:10", "max:64"],
            "description" => ["string", "required", "min:20", "max:255"],
            "price" => ["decimal:0,5", "required"],
            "rooms_num" => ["required", "integer", "max:100"],
            "beds_num" => ["required", "integer", "max:200"],
            "baths_num" => ["required", "integer", "max:50"],
            "size" => ["required", "integer"],
            "address" => ["required", "string", "max:255"],
            "services" => ["nullable", "array"],
            'imageApartment' => ['nullable', 'image', ' mimes:jpg,png,jpeg,gif,svg', 'max:2048'],

        ]);

        // if (array_key_exists("imageApartment", $data)) {

        //     $img_path = Storage::put('uploads', $data['imageApartment']);
        //     $data['imageApartment'] = $img_path;
        // } else {
        //     $data['imageApartment'] = 'avatar5.png';
        // }
        if (array_key_exists("imageApartment", $data)) {
            $img_path = Storage::put('uploads', $data['imageApartment']);
            $data['imageApartment'] = $img_path;
        }
        $apartment->title = $data["title"];
        $apartment->description = $data["description"];
        $apartment->price = $data["price"];
        $apartment->rooms_num = $data["rooms_num"];
        $apartment->beds_num = $data["beds_num"];
        $apartment->baths_num = $data["baths_num"];
        $apartment->size = $data["size"];
        $apartment->address = $data["address"];
        if (array_key_exists("imageApartment", $data)) {
            $apartment->imageApartment = $data["imageApartment"];
        }
        // $apartment->imageApartment = $data["imageApartment"];

        $id = auth()->user()->id;
        $currentuser = User::find($id);
        $apartment->user()->associate($currentuser);
        $apartment->save();

        $services = Service::find([$data["services"]]);
        $apartment->services()->sync($services);

        // $statistics = new Statistic();
        // $statistics->ip_address = request()->ip();

        return response()->json([
            "success" => true,
            "response" => $apartment
        ]);
    }
    public function allApartments()
    {
        $apartments = Apartment::all();
        return response()->json([
            "success" => true,
            "response" => $apartments
        ]);
    }
    public function getUserLogged()
    {
        $user = auth()->user();
        return response()->json([
            "success" => true,
            "response" => $user
        ]);
    }
    public function logout()
    {
        Session::flush();
        Auth::logout();
    }
    public function searchApartment(Request $request)
    {

        $latitude = $request["latitude"];
        $longitude = $request["longitude"];
        $radius = $request["radius"];


        $haversine = "(
            6371 * acos(
                cos(radians(" . $latitude . "))
                * cos(radians(`lat`))
                * cos(radians(`long`) - radians(" . $longitude . "))
                + sin(radians(" . $latitude . ")) * sin(radians(`lat`))
            )
        )";

        $apartments = Apartment::select("*")
            ->selectRaw("$haversine AS distance")
            ->having("distance", "<=", $radius)
            ->orderby("distance", "desc")
            ->get();

        return response()->json([
            "success" => true,
            "response" => $apartments
        ]);

    }
}