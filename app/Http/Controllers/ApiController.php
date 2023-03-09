<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Apartment;
use App\Models\User;
use App\Models\Service;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
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
            // "image" => ["nullable", "image"],

        ]);
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
        // $ap->image = $data["image"];
        $id = auth()->user()->id;
        $currentuser = User::find($id);
        $ap->user()->associate($currentuser);
        $ap->save();
        // $tags = Tag::find([$data["tag"]]);
        // $movie->tags()->attach($tags);
        // Mail::to('dda@gmail.com')->send(new NewMovie($movie));
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
}