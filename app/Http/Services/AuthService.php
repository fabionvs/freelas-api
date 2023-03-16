<?php

namespace App\Http\Services;
use Elliptic\EC;
use Illuminate\Support\Str;
use kornrunner\Keccak;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\User;
use App\Http\Repository\ChainRepository;
use Illuminate\Support\Facades\Redis;
class AuthService
{

    public function __construct(ChainRepository $chainRepository)
    {
        $this->chainRepository = $chainRepository;
    }

    public function signup($request)
    {
        if(Auth::user()->photo == null && Auth::user()->username == null){
            $user = User::where('id', Auth::user()->id)->first();
            if($user){


                $img = $request->input('image');
                $folderPath = "user/"; //path location

                $image_parts = explode(";base64,", $img);
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);
                $uniqid = Auth::user()->id;
                $file = $folderPath . $uniqid . '.'.$image_type;
                file_put_contents($file, $image_base64);

                $user->photo = $file;
                $user->username = $request->input('username');

                $user->save();
                return  [
                    "success" => true,
                    "user" => $user
                ];
            }
            return  [
                "success" => false,
            ];
        }

        return  [
            "success" => false,
        ];
    }

    public function sign()
    {
        $nonce = Str::random();
        $message = "Sign this message to enter on your Candy Wallet account.\nThis action require no costs.\n\nCode: " . $nonce;

        session()->put('sign_message', $message);

        return $message;
    }

    public function verifySignature(string $message, string $signature, string $address): bool
    {
        $hash = Keccak::hash(sprintf("\x19Ethereum Signed Message:\n%s%s", strlen($message), $message), 256);
        $sign = [
            'r' => substr($signature, 2, 64),
            's' => substr($signature, 66, 64),
        ];
        $recid = ord(hex2bin(substr($signature, 130, 2))) - 27;

        if ($recid != ($recid & 1)) {
            return false;
        }

        $pubkey = (new EC('secp256k1'))->recoverPubKey($hash, $sign, $recid);
        $derived_address = '0x' . substr(Keccak::hash(substr(hex2bin($pubkey->encode('hex')), 1), 256), 24);

        return (Str::lower($address) === $derived_address);
    }

    public function me($request)
    {
        if(Auth::user() !== null){
            $chain = Redis::set('user:chain:'.Auth::user()->id, intval($request->input('chain_id')));
            $chainExists = $this->chainRepository->chainExists($request->input('chain_id'));
            return [
            "success" => true, 
            'user' => [
                'eth_address' => Auth::user()->eth_address,
                'photo' => Auth::user()->photo,
                'username' => Auth::user()->username,
                'chain_exists' => $chainExists
            ]
        ];
        }else{
            return ["success" => true, 'user' => null];
        }
    }

}
