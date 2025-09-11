<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Concerns\UploadedFile;
use Illuminate\Http\Request;
use App\Models\CryptoPayment;

class CryptoPaymentController extends Controller
{
    use UploadedFile;

    public function cryptoPaymentRecieving(Request $request){
        $setTitle = "Crypto Payment Processing";
        // $gateways = $this->paymentGatewayService->getGatewayByPaginate(GatewayType::AUTOMATIC);

        $details= CryptoPayment::all();

        return view('admin.payment_gateway.crypto_payment', compact(
            'setTitle',
            'details'
        ));
    }

    public function cryptoPaymentStore(Request $request){
        if($request->edit_id!=""){
            $prev_details= CryptoPayment::where("id", $request->edit_id)->first();

            $logo       = $request->hasFile('logo') ? $this->move($request->file('logo')) : $prev_details->logo;
            $qr_code    = $request->hasFile('qr_code') ? $this->move($request->file('qr_code')) : $prev_details->qr_code;

            CryptoPayment::where("id", $prev_details->id)->update([
                "logo"              =>  $logo,
                "qr_code"           =>  $qr_code,
                "crypto_address"    =>  $request->crypto_address,
                "network"           =>  $request->network,
                "status"            =>  $request->status,
            ]);

            return back()->with('notify', [['success', "Record has been updated"]]);
        }else{
            $request->validate([
                'logo'              => 'required',
                'qr_code'           => 'required',
                'crypto_address'    => 'required',
                'network'           => 'required',
                'status'            => 'required',
            ]);

            $logo       = $request->hasFile('logo') ? $this->move($request->file('logo')) : "";
            $qr_code    = $request->hasFile('qr_code') ? $this->move($request->file('qr_code')) : "";

            CryptoPayment::create([
                "logo"              =>  $logo,
                "qr_code"           =>  $qr_code,
                "crypto_address"    =>  $request->crypto_address,
                "network"           =>  $request->network,
                "status"            =>  $request->status,
            ]);

            return back()->with('notify', [['success', "Record has been inserted"]]);
        }
    }

    public function editCryptoPaymentRecieving(Request $request, $edit_id){
        $prev_details= CryptoPayment::where("id", $edit_id)->first();

        $setTitle = "Crypto Payment Processing";
        // $gateways = $this->paymentGatewayService->getGatewayByPaginate(GatewayType::AUTOMATIC);

        $details= CryptoPayment::all();

        return view('admin.payment_gateway.crypto_payment', compact(
            'setTitle',
            'details',
            'prev_details'
        ));
    }

    public function deleteCryptoPaymentRecieving(Request $request, $edit_id){
        CryptoPayment::find($edit_id)->delete();
        return back()->with('notify', [['success', "Record has been deleted"]]);
    }
}
