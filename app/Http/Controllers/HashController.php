<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Validator;

class HashController extends Controller
{

    protected string $ciphering = "AES-128-CTR";
    protected string $encryption_iv = "1234567891011121";

    /**
     * @param Request $request
     * @return JsonResponse
     * This function encrypt text by the key granted by user
     */
    public function encrypt (Request $request): JsonResponse
    {
        try {

            $validation = Validator::make($request->all(), [
                'text' => 'required|string',
                'key' => 'required|string'
            ]);

            if ($validation->fails()) {
                return $this->Error('Missing data please rectify the information sent.', $validation->errors()->getMessages(), 400);
            }

            $data = $request->all();
            $options = 0;

            $encryptHash = openssl_encrypt($data['text'], $this->ciphering,
                $data['key'], $options, $this->encryption_iv);


            return $this->Ok('success', [
                'textHash' => $encryptHash
            ]);
        } catch (Exception $e) {
            return $this->Error($e->getMessage(),[
                'ErrorLine' => $e->getLine(),
                'ErrorFile' => $e->getFile(),
            ], 500);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * This function decrypt text by the original key used for encrypt text
     */
    public function decrypt (Request $request): JsonResponse
    {
        try {

            $validation = Validator::make($request->all(), [
                'text' => 'required|string',
                'key' => 'required|string'
            ]);

            if ($validation->fails()) {
                return $this->Error('Missing data please rectify the information sent.', $validation->errors()->getMessages(), 400);
            }

            $data = $request->all();
            $options = 0;
            $decryptHash = openssl_decrypt($data['text'], $this->ciphering,
                $data['key'], $options, $this->encryption_iv);

            return $this->Ok('success', [
                'textHash' => $decryptHash
            ]);
        } catch (Exception $e) {
            return $this->Error($e->getMessage(),[
                'ErrorLine' => $e->getLine(),
                'ErrorFile' => $e->getFile(),
            ], 500);
        }
    }
}
