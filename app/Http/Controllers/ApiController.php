<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
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
            'added_images' => ["array", "required"]

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

        foreach ($data["added_images"] as $image) {
            $addedimage = new AddedImage();
            $addedimg_path = Storage::put('uploads', $image);
            $addedimage->image = $addedimg_path;
            $apartmentid = $ap->id;
            $addedimage->apartment()->associate($apartmentid);
            $addedimage->save();
        }
        // $addedimage->image = $data["added_images"];
        // $apartmentid = $ap->id;
        // $addedimage->apartment()->associate($apartmentid);
        // $addedimage->save();


        // if (array_key_exists('added_images', $data)) {


        //     foreach ($data['added_images'] as $image) {
        //         $addedImage = new AddedImage;
        //         $img_path = Storage::put('uploads', $image);
        //         $image = $img_path;
        //         $addedImage->image->attach($image);

        //         $ap->added_images()->attach($addedImage);

        //         $addedImage->save();


        //     }
        // }

        // if (array_key_exists("services", $data)) {
        $services = Service::find([$data["services"]]);
        $ap->services()->attach($services);

        $statistics = new Statistic();
        $statistics->ip_address = request()->ip();

        return response()->json([
            "success" => true,
            "apartments" => $ap,
        ]);
    }

    public function createApartmentPage()
    {
        return view('createApartment');

    }
    public function userApartments(Request $request)
    {
        $timezone = new DateTimeZone('Europe/Rome');
        $date = new DateTime('now', $timezone);
        DB::table('apartment_sponsor')
            ->where('end_date', '<=', $date->format('Y-m-d H:i:s'))
            ->delete();

        $apartments = Apartment::where('user_id', 'like', auth()->user()->id)->get();
        foreach ($apartments as $apartment) {
            $apartment['messages'] = $apartment->messages;
            $apartment['sponsors'] = $apartment->sponsors;

            if (count($apartment['sponsors']) !== 0) {
                $apartmentId = $request['apartmentId'];
                $sponsorId = $request['sponsorId'];
                $apartment_sponsor = DB::table('apartment_sponsor')
                    ->where($sponsorId, '=', $apartmentId)->get('end_date');
                $apartment['end_date'] = $apartment_sponsor;
            } else {
                $apartment['end_date'] = [];
            }

        }
        ;
        return response()->json([
            "success" => true,
            "response" => [
                $apartments,
            ]
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
            'added_images' => ['array', 'nullable']
        ]);

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


        if (array_key_exists("added_images", $data)) {
            AddedImage::select('*')->where('apartment_id', 'like', $apartment->id)->delete();
            foreach ($data["added_images"] as $image) {
                $addedimage = new AddedImage();
                $addedimg_path = Storage::put('uploads', $image);
                $addedimage->image = $addedimg_path;
                $apartmentid = $apartment->id;
                $addedimage->apartment()->associate($apartmentid);
                $addedimage->save();
            }
        }


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
        $timezone = new DateTimeZone('Europe/Rome');
        $date = new DateTime('now', $timezone);
        DB::table('apartment_sponsor')
            ->where('end_date', '<=', $date->format('Y-m-d H:i:s'))
            ->delete();

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


        $timezone = new DateTimeZone('Europe/Rome');
        $date = new DateTime('now', $timezone);
        DB::table('apartment_sponsor')
            ->where('end_date', '<=', $date->format('Y-m-d H:i:s'))
            ->delete();



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


        if (! $apartment->sponsors()->where('apartment_id', $id)->exists()) {
            $apartment->sponsors()->attach($sponsor);
            $date = new DateTime();
            $dateTime = $date->setTimeZone(new DateTimeZone('CET'));

        } else {
            $dateTime = $apartment->sponsors()->select('end_date')->where('apartment_id', $id)->first()->end_date;
            $dateTime = new DateTime($dateTime);

        }


        if ($sponsor == 1) {
            $exDate = $dateTime->modify('+1 day');

        } else if ($sponsor == 2) {
            $exDate = $dateTime->modify('+3 day');

        } else {
            $exDate = $dateTime->modify('+6 day');
        }


        $apartment->sponsors()->sync([
            $sponsor => ['end_date' => $exDate->format('Y-m-d H:i:s')]
        ]);



        return response()->json([
            "success" => true,
            "response" => $exDate,
        ]);
    }
    public function getApartmentsSponsor()
    {
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


        $timezone = new DateTimeZone('Europe/Rome');
        $date = new DateTime('now', $timezone);
        DB::table('apartment_sponsor')
            ->where('end_date', '<=', $date->format('Y-m-d H:i:s'))
            ->delete();

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
    public function getMessages(Request $request)
    {
        $apartmentId = $request["apartmentId"];
        $apartment = Apartment::find($apartmentId);
        $this->authorize('update', $apartment);
        $apartmentId = $request["apartmentId"];
        $apartment = Apartment::find($apartmentId);
        $messages = $apartment->messages()->get();
        return response()->json([
            "success" => true,
            "response" => $messages,
        ]);
    }


}