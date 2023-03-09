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
            "title" => ["string", "nullable"],
            "description" => ["string", "nullable"],
            "price" => ["integer", "nullable"],
            "rooms_num" => ["nullable", "integer"],
            "beds_num" => ["nullable", "integer"],
            "baths_num" => ["nullable", "integer"],
            "size" => ["nullable", "integer"],
            "address" => ["nullable", "string"],
            "lat" => ["nullable", "integer"],
            "long" => ["nullable", "integer"],
            "image" => ["nullable", "image", " mimes:jpg,png,jpeg,gif,svg", "max:2048"],
            "services" => ["nullable"],
            "sponsors" => ["nullable"],
            'imageApartment' => ['nullable', 'image', ' mimes:jpg,png,jpeg,gif,svg', 'max:2048'],

        ]);

        if (array_key_exists("imageApartment", $data)) {

            $img_path = Storage::put('uploads', $data['imageApartment']);
            $data['imageApartment'] = $img_path;
        } else {
            $data['imageApartment'] = 'avatar5.png';
        }
        // $ap = Apartment::create($data);


        $ap = new Apartment();
        $ap->title = $data["title"];
        $ap->description = $data["description"];
        $ap->price = $data["price"];
        $ap->rooms_num = $data["rooms_num"];
        $ap->beds_num = $data["beds_num"];
        $ap->baths_num = $data["baths_num"];
        $ap->size = $data["size"];
        $ap->address = $data["address"];
        $ap->lat = $data["lat"];
        $ap->long = $data["long"];
        $ap->imageApartment = $data["imageApartment"];

        $id = auth()->user()->id;
        $currentuser = User::find($id);
        $ap->user()->associate($currentuser);
        $ap->save();

        $services = Service::find([$data["services"]]);
        $ap->services()->attach($services);
        $sponsors = Sponsor::find($data["sponsors"]);
        $ap->sponsors()->attach($sponsors);

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
        $services = Service::all();
        return response()->json([
            "success" => true,
            "response" => $services
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
}