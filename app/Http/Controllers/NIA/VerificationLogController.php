<?php

namespace App\Http\Controllers\NIA;

use App\Http\Controllers\Controller;
use App\Models\NIA\VerificationLogModel;
use Illuminate\Http\Request;

class VerificationLogController extends Controller
{
    //
    public function callback(Request $request)
    {



        // Destructuring and getting individual data
        $data = request('data');
        $person = $data['person'] ?? NULL;
        $verified = $data['verified'] ?? NULL;
        $addresses = $person['addresses'] ?? NULL;
        $contact = $person['contact'] ?? NULL;
        $occupations = $person['occupations'] ?? NULL;
        $biometricFeed = $person['biometricFeed'] ?? NULL;
        $binaries = $person['binaries'] ?? NULL;


        $verificationLogModel = new VerificationLogModel();


        // Custom columns for testing
        $verificationLogModel->_verified = $verified;
        $verificationLogModel->_person = json_encode($person);
        $verificationLogModel->_addresses = json_encode($addresses);
        $verificationLogModel->_contacts = json_encode($contact);
        $verificationLogModel->_occupations = json_encode($occupations);
        $verificationLogModel->_biometricFeed = json_encode($biometricFeed);
        $verificationLogModel->_binaries = json_encode($binaries);


        // declare your actual database columns here
        $verificationLogModel->transactionGuid = $data['transactionGuid'];
        $verificationLogModel->shortGuid = $data['shortGuid'];
        $verificationLogModel->requestTimestamp = $data['requestTimestamp'];
        $verificationLogModel->responseTimestamp = $data['responseTimestamp'];
        $verificationLogModel->verified = $data['verified'];


        $verificationLogModel->save();

        if (request('code') == '00') {
            return response()->json([
                'message' => "Great 😎, Verified"
            ], 200);
        } else {
            return response()->json([
                'message' => 'Bad 😪, Did not verify'
            ], 200);
        }
    }


    public function verificationDetails($transactionGuid = null)
    {
        if (is_null($transactionGuid)) {
            return VerificationLogModel::paginate(10);
        } else {

            $data = VerificationLogModel::find($transactionGuid);

            if (is_null($data)) {
                return response()->json([
                    'message' =>   "No data found",
                    'data' => []
                ], 200);
            } else {
                return response()->json([
                    'message' =>  "Found data",
                    'data' => [$data]
                ], 200);
            }
        }
    }
}