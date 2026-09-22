<?php


namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Create User
     * @param Request $request
     * @return User 
     */
    public function createUser(Request $request)
    {
        try {
            //Validated
            $validateUser = Validator::make($request->all(), 
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Login The User
     * @param Request $request
     * @return User
     */
    public function loginUser(Request $request)
    {

        try {
            $validateUser = Validator::make($request->all(), 
            [
                'email' => 'required',
                'password' => 'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }
              
            if(!Auth::attempt(['email'=>$request->email, 'password'=>$request->password])){
                return response()->json([
                    'status' => false,
                    'email'=>$request->email,
                    'password'=>$request->password,
                    'message' => 'username & Password does not match with our record.',
                ], 401);
            }

            $user = User::with('sites')->where('email',$request->email)->firstOrFail();
            $user->tokens()->where('name', 'MOBILE APP')->delete();

            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken('MOBILE APP')->plainTextToken,
                'user' => $user,
                'site' => $user->sites->first(),
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    public function test (){
        echo 'bonjour';
    }
    public function carte (Request $req){
        $carte=$req->get('carte',0);
        $pass=$req->get('pass',0);
        $c=\App\Models\Carte::whereRaw('numero=? and pin=?',[$carte,$pass])->first();
        if($c!=null)
        return [
            'error'=>0,
            'carte'=>[
                'client'=>$c->client->nom??'',
                'carte'=>$carte,
                'name'=>$c->benefiaire??'',
                'numero'=>$c->numero??'',
                'total'=>$c->solde,
                 ],
           ]; 
        else return [
            'error'=>1,
            'carte'=>$carte,
            'pass'=>$pass
        ];
    }
    public function debiter(Request $req){
        $carte=$req->get('carte');
        $code=$req->get('code');
        $montant=(int)$req->get('montant');
      $c=\App\Models\Carte::whereRaw('numero=? and pin=?',[$carte,$code])->first();
      if($c==null){
        return [
            'error'=>1,
            'message'=>'Carte ou Code incorrect'
        ];
      }
      else {
        
        if($c->solde < $montant)
        return [
            'error'=>1,
            'message'=> 'Solde Insuffisant'
        ];
        else{
            $c->debiter($montant);
            return [
            'error'=>0,
            'message'=> 'Operation Reussie',
            'carte'=>[
                'client'=>$c->client->nom??'',
                'name'=>$c->benefiaire??'',
                'carte'=>$c->numero??'',
                'montant'=>$montant,
                'solde'=>$c->solde
                 ],
           ]; 
        }
      }
    }
}
