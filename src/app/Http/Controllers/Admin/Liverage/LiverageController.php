<?php

namespace App\Http\Controllers\Admin\Liverage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Liverage;
use App\Concerns\UploadedFile;
use App\Models\LiverageRequest;
use App\Models\LiverageWallet;

class LiverageController extends Controller
{
    use UploadedFile;

    public function __construct()
    {
        
    }

    public function index(): View
    {
        $setTitle = 'Leverage';
        $users = User::where("status", "1")->get();
        // echo "<pre>";
        // print_r($users);
        // exit;

        return view('admin.liverage.index', compact('setTitle', 'users'));
    }

    public function view(): View
    {
        $setTitle = 'Liverage Details';
        $liverage_requests= LiverageRequest::with(['user', 'liverage'])->get();
        // echo "<pre>";
        // print_r($liverage_requests);
        // exit;

        return view('admin.liverage.view', compact('setTitle', 'liverage_requests'));
    }

    public function add (Request $request){
        $this->validate($request, [
            'liverage_name' => 'required',
            'liverage_image' => 'nullable|image|mimes:jpg,png,jpeg',
            'amount' => 'required',
            'time_duration' => 'required',
        ]);

        $insert = Liverage::create([
            "name"  =>  $request->input('liverage_name'),
            "image"  =>  $request->hasFile('liverage_image') ? $this->move($request->file('liverage_image')) : "",
            "amount"    =>  $request->input("amount"),
            "time_duration"    =>  $request->input("time_duration"),
        ]);

        if($insert){
            return back()->with('notify', [['success','Sucessfully Inserted']]);
        }else{
            return back()->with('notify', [['error','Problem Sucessfully Inserted']]);
        }
    }

    public function update($liverage_id, $user_id, $status, Request $request){
        $update = LiverageRequest::where("liverage_id", $liverage_id)->where("user_id", $user_id)->update([
            "status"    =>  $status
        ]);

        //get liverage details
        $details= Liverage::where("id", $liverage_id)->first();

        if ($status=='1') {
            $insert_wallet = LiverageWallet::create([
                "user_id"       =>  $user_id,
                "liverage_id"   =>  $liverage_id,
                "wallet"        =>  $details->amount
            ]);

            if (!$insert_wallet) {
                return back()->with('notify', [['error','There is some issue on inserting wallet...']]);    
            }
        }

        if ($update) {
            return back()->with('notify', [['success','Sucessfully Updated...']]);
        }else{
            return back()->with('notify', [['error','There is some issue on updating...']]);
        }
    }

    public function liverageSetting(): View
    {
        $setTitle = 'Liverage Setting';
        $details= Liverage::orderBy("id", "desc")->first();
        // echo "<pre>";
        // print_r($details);
        // exit;       
        return view('admin.liverage.setting', compact('setTitle', 'details'));
    }

    public function liverageConnection(): View
    {
        $setTitle = 'Liverage Connection';
        
        $users= User::where("status", "1")->get();

        return view('admin.liverage.connection', compact('setTitle', 'users'));
    }

    public function addSetting(Request $request){
        $this->validate($request, [
            'liverage_setting' => 'required',
        ]);

        $details= Liverage::orderBy("id", "desc")->first();

        $update = Liverage::where("id", $details->id)->update([
            "liverage_setting"  =>  $request->input("liverage_setting")
        ]);

        if ($update) {
            return back()->with('notify', [['success','Sucessfully Updated...']]);
        }else{
            return back()->with('notify', [['error','There is some issue on updating...']]);
        }
    }

    public function saveConnection(Request $request){
        $this->validate($request, [
            "user"              =>  "required",
            "liverage_enabled"  =>  "required"
        ]);

        if($request->input("user")=="all"){
            $update = User::query()->update([
                "liverage_enabled"  =>  $request->input("liverage_enabled")
            ]);
        }else{
            $update = User::where("id", $request->input("user"))->update([
                "liverage_enabled"  =>  $request->input("liverage_enabled")
            ]);
        }
        if ($update) {
            return back()->with('notify', [['success','Sucessfully Saved...']]);
        }else{
            return back()->with('notify', [['error','There is some issue on updating...']]);
        }
    }
}
