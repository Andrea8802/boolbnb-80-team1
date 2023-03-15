<?php

namespace App\Http\Controllers;

use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use App\Models\Apartment;
use App\Models\User;
use App\Models\Service;
use App\Models\Sponsor;
use App\Models\Statistic;
use App\Models\Message;
use App\Models\AddedImage;
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

    /* Rotta per creare apartment */

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
            "lat" => ["nullable"],
            "long" => ["nullable"],
            "services" => ["array", "required"],
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




        // if (array_key_exists("services", $data)) {
        $services = Service::find([$data["services"]]);
        $ap->services()->attach($services);
        // }
        // $services = Service::find([$data["services"]]);
        // $ap->services()->attach($services);

        $statistics = new Statistic();
        $statistics->ip_address = request()->ip();

        return response()->json([
            "success" => true,
            "response" => [
                "apartments" => $ap,
            ]
        ]);
    }

    /* Rotta per creare added images */

    public function createAddedImages(Request $request, $id)
    {

        /* foreach ($request->images as $image) {
        $path = Storage::put('uploads', $image["image"]);
        $image["image"] = $path;
        $added_image = AddedImage::make($image["image"]);
        $ap = Apartment::find($id);
        $added_image->apartment()->associate($ap);
        $added_image->save();
        return response()->json([
        "success" => true,
        "response" => [
        "added_images" => $added_image,
        ]
        ]);
        }
        ; */
        $allowedfileExtension = ['jpg', 'png', 'jpeg', 'gif', 'svg'];
        $files = $request->file('image');
        foreach ($files as $file) {
            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension, $allowedfileExtension);
            if ($check) {
                foreach ($request->fileName as $mediaFiles) {

                    $path = $mediaFiles->store('public/images');


                    //store image file into directory and db
                    $save = AddedImage::make();
                    $save->image = $path;
                    $ap = Apartment::find($id);
                    $ap->added_images()->associate($save);
                    /* $save->apartment()->associate($ap); */
                    $save->save();
                }
            } else {
                return response()->json(['invalid_file_format'], 422);
            }

            return response()->json(['file_uploaded'], 200);
        }

        /* for ($i = 0; $i < count($data); $i++) {
        if (array_key_exists("image", $data[$i])) {
        $path = Storage::put('uploads', $data["image"][$i]);
        $data["image"][$i] = $path;
        } else {
        $$data['image'] = 'avatar5.png';
        }
        $added_image = AddedImage::make($data[$i]);
        $ap = Apartment::find($id);
        $added_image->apartment()->associate($ap);
        $added_image->save();
        return response()->json([
        "success" => true,
        "response" => [
        "added_images" => $added_image,
        ]
        ]);
        } */

        /* foreach ($data as $imagefile) {
        $path = Storage::put('uploads', $imagefile['image']);
        $imagefile['image'] = $path;
        $added_image = AddedImage::make($imagefile);
        $ap = Apartment::find($id);
        $ap->added_images()->associate($added_image);
        return response()->json([
        "success" => true,
        "response" => [
        "added_images" => $added_image,
        ]
        ]);
        }
        ; */
    }
    /*     $new_img = $request->validate(["image" => ["image", "required", "mimes:jpg,png,jpeg,gif,svg", "max:2048"]]);
    if (array_key_exists("image", $new_img)) {
    $path = Storage::put('uploads', $new_img['image']);
    $new_img['image'] = $path;
    }
    ;
    $added_image = AddedImage::make($new_img);
    $currentaps = Apartment::find($id);
    $currentaps->added_images()->associate($added_image);
    $added_image->save();  */


    /* $data_adIm = $request->validate([
    "name" => ["string", "nullable"],
    "image" => ["image", "mimes:jpg,png,jpeg,gif,svg", "max:2048"],
    ]); */

    /* $arrayImg = [];
    array_push($arrayImg, $data_adIm);
    $add_img_path = Storage::put('uploads', $arrayImg[$data_adIm['image']]);
    $arrayImg[$data_adIm['image']] = $add_img_path;
    $added_images = AddedImage::make($data_adIm);
    $ap->added_images()->associate($added_images); */






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
    public function getApartmentDetail($id)
    {

        $apartment = Apartment::find($id);
        $apartment["services"] = $apartment->services;
        $apartment["added_images"] = $apartment->added_images;
        $apartment["user_id"] = $apartment->user_id;

        $user = User::find($apartment->user_id);

        return response()->json([
            "success" => true,
            "response" => [
                $apartment,
                $user
            ]
        ]);

    }
    public function userEditApartmentsPage(Apartment $apartment)
    {
        if ($this->authorize('update', $apartment)) {
            return view("editApartment", compact('apartment'));
        } else {
            return view('/');
        }


    }
    public function updateApartment(Request $request, Apartment $apartment)
    {
        $this->authorize('update', $apartment);
        $data = $request->validate([
            "title" => ["string", "required", "min:10", "max:64"],
            "description" => ["string", "required", "min:20", "max:255"],
            "price" => ["decimal:0,5", "required"],
            "rooms_num" => ["required", "integer", "max:100"],
            "beds_num" => ["required", "integer", "max:200"],
            "baths_num" => ["required", "integer", "max:50"],
            "size" => ["required", "integer"],
            "address" => ["required", "string", "max:255"],
            "lat" => ["nullable"],
            "long" => ["nullable"],
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
        $apartment->lat = $data["lat"];
        $apartment->long = $data["long"];
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
        $apartments = Apartment::whereDoesntHave('sponsors')->get();
        $apartmentsSponsored = Apartment::whereHas('sponsors')->get();

        return response()->json([
            "success" => true,
            "apartments" => $apartments,
            "apartmentsSponsored" => $apartmentsSponsored
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

        $latitude = $request["lat"];
        $longitude = $request["long"];
        $radius = $request["radius"];

        $haversine = "(
            6371 * acos(
                cos(radians(" . $latitude . "))
                * cos(radians(`lat`))
                * cos(radians(`long`) - radians(" . $longitude . "))
                + sin(radians(" . $latitude . ")) * sin(radians(`lat`))
            )
            
            )";
        $apartmentsSponsored = Apartment::select("*")->whereHas('sponsors')
            ->selectRaw("$haversine AS distance")
            ->having("distance", "<=", $radius)
            ->orderby("distance", "desc")
            ->get();
        $apartments = Apartment::select("*")->whereDoesntHave('sponsors')
            ->selectRaw("$haversine AS distance")
            ->having("distance", "<=", $radius)
            ->orderby("distance", "desc")
            ->get();



        return response()->json([
            "success" => true,
            "apartments" => $apartments,
            "apartmentsSponsored" => $apartmentsSponsored
        ]);

    }
    public function getSponsors()
    {
        $sponsors = Sponsor::all();
        return response()->json([
            "success" => true,
            "response" => $sponsors
        ]);
    }
    public function sponsorPayment(Request $request)
    {
        $sponsor = $request["sponsors"];
        $id = $request["apartmentId"];
        $apartment = Apartment::find($id);
        $apartment->sponsors()->attach($sponsor);
        return response()->json([
            "success" => true,
            "response" => $apartment
        ]);
    }
    public function getApartmentsSponsor()
    {
        // $apartments = Apartment::select("*")

        //     ->join('apartment_sponsor', 'apartments.id', '=', 'apartment_sponsor.apartment_id')
        //     ->join('sponsors', 'apartment_sponsor.sponsor_id', '=', 'sponsors.id')
        //     ->where('apartment.id', 'like', 'apartment_sponsor.apartment.id')
        //     ->get();
        $apartments = Apartment::whereHas('sponsors')->get();

        return response()->json([
            "success" => true,
            "response" => $apartments
        ]);
    }

    public function advancedSearch(Request $request)
    {

        $latitude = $request["lat"];
        $longitude = $request["long"];
        $radius = $request["radius"];
        $roomsNumber = $request["rooms_num"];
        $bedsNumber = $request["beds_num"];
        $services = $request["services"];

        $haversine = "(
            6371 * acos(
                cos(radians(" . $latitude . "))
                * cos(radians(`lat`))
                * cos(radians(`long`) - radians(" . $longitude . "))
                + sin(radians(" . $latitude . ")) * sin(radians(`lat`))
            ))";


        $apartments = Apartment::select("*")
            ->selectRaw("$haversine AS distance")
            ->having("distance", "<=", $radius)
            ->where("rooms_num", ">=", $roomsNumber)
            ->where("beds_num", ">=", $bedsNumber)
            ->join('apartment_service', 'apartments.id', '=', 'apartment_service.apartment_id')
            ->join('services', 'apartment_service.service_id', '=', 'services.id')
            ->orderby("distance", "asc");

        if ($services) {
            $apartments->whereIn("services.id", $services);
        }

        $apartments = $apartments->get();


        return response()->json([
            "success" => true,
            "response" => $apartments,
            "services" => $services
        ]);
    }

    public function getApartmentEdit(Request $request, $id)
    {
        $apartment = Apartment::find($id);
        $this->authorize('update', $apartment);
        $apartment["services"] = $apartment->services;
        $apartment["added_images"] = $apartment->added_images;
        $apartment["user_id"] = $apartment->user_id;

        $id = auth()->user()->id;
        $currentuser = User::find($id);


        return response()->json([
            "success" => true,
            "response" => [
                $apartment,
                $currentuser
            ]
        ]);



    }

    public function sendMessage(Request $request, Apartment $apartment)
    {
        $data = $request->validate([
            "name" => ["string", "required"],
            "surname" => ["string", "required"],
            "text" => ["string", "required"],
            "email" => ["string", "required"]
        ]);

        $m = Message::make($data);
        $m->apartment()->associate($apartment);
        $m->save();

        return response()->json([
            "success" => true,
            "response" => $m,
        ]);
    }


}