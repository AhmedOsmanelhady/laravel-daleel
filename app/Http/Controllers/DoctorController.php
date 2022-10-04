<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;
use App\Http\Resources\DoctorCollection;
use App\Http\Resources\DoctorResource;
use App\Models\Doctor;

use Illuminate\Support\Facades\File;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctor = Doctor::query()->latest('id')->get();
        if ($doctor) {
            return DoctorCollection::collection($doctor);
        } else {
            return response()->json([
                "status" => "error",
                "message" => "Something went wrong",
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDoctorRequest $request)
    {
        $doctor = new Doctor();

        if ($doctor) {
            $doctor->name = $request->name;
            $doctor->title = $request->title;
            $doctor->about = $request->about;
            $doctor->mobile = $request->mobile;
            $doctor->phone = $request->phone;
            $doctor->address = $request->address;
            $doctor->city = $request->city;
            if ($request->hasfile("image")) {
                $file = $request->file("image");
                $extension = $file->getClientOriginalExtension();
                $filename = time() . "." . $extension;
                $file->move("uploads/doctors/", $filename);
                $doctor->image = $filename;
            }

            $doctor->save();
            return new DoctorResource($doctor);
        } else {
            return response()->json([
                "status" => "error",
                "message" => "Something went wrong",
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $doctor = Doctor::find($id);
        if ($doctor) {
            return new DoctorResource($doctor);
        } else {
            return response()->json([
                "status" => "error",
                "message" => "Something went wrong",
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDoctorRequest $request, $id)
    {
        $doctor = Doctor::find($id);

        if ($doctor) {
            $doctor->name = $request->name;
            $doctor->title = $request->title;
            $doctor->about = $request->about;
            $doctor->mobile = $request->mobile;
            $doctor->phone = $request->phone;
            $doctor->address = $request->address;
            $doctor->city = $request->city;
            if ($request->hasfile("image")) {
                $destenation = "uploads/doctors/" . $doctor->image;
                if (File::exists($destenation)) {
                    File::delete($destenation);
                }
                $file = $request->file("image");
                $extension = $file->getClientOriginalExtension();
                $filename = time() . "." . $extension;
                $file->move("uploads/doctors/", $filename);
                $doctor->image = $filename;
            }

            $doctor->update();

             return new DoctorResource($doctor);
        } else {
            return response()->json([
                "status" => "error",
                "message" => "Something went wrong",
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $doctor = Doctor::find($id);
        if ($doctor) {
            $destination = "uploads/doctors/" . $doctor->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $doctor->delete();

            return response()->json([
                "success" => true,
                "message" => "Doctor deleted successfully",
            ]);
        } else {
            return response()->json([
                "status" => "error",
                "message" => "Something went wrong",
            ]);
        }
    }
}
