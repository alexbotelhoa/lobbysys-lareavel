<?php
//
//namespace App\Http\Controllers;
//
//use App\User;
//use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Hash;
//use Illuminate\Support\Facades\Validator;
//use Illuminate\Http\Request;
//
//class AuthController extends Controller
//{
//    /**
//     * Store a newly created resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @return \Illuminate\Http\Response
//     */
//    public function register (Request $request) {
//
//        $validator = Validator::make($request->all(), [
//            'name' => 'required|string|max:255',
//            'email' => 'required|string|email|max:255|unique:users',
//            'password' => 'required|string|min:6|confirmed',
//        ]);
//
//        if ($validator->fails())
//        {
//            return response(['errors'=>$validator->errors()->all()], 422);
//        }
//
//        $request['password']=Hash::make($request['password']);
//        $user = User::create($request->toArray());
//
//        $token = $user->createToken('Laravel Password Grant Client')->accessToken;
//        $response = ['token' => $token];
//
//        return response($response, 200);
//
//    }
//
//
//
//
//
//
//
//
//
//
//
//
//
//    /**
//     * Store a newly created resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @return \Illuminate\Http\Response
//     */
////    public function login (Request $request) {
////
////        $user = User::where('email', $request->email)->first();
////
////        if ($user) {
////
////            if (Hash::check($request->password, $user->password)) {
////                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
////                $response = ['token' => $token];
////                return response($response, 200);
////            } else {
////                $response = "Password missmatch";
////                return response($response, 422);
////            }
////
////        } else {
////            $response = 'User does not exist';
////            return response($response, 422);
////        }
////
////    }
////
//
//
//
//
//
//
//    /**
//     * Store a newly created resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @return \Illuminate\Http\Response
//     */
//    public function login(Request $request)
//    {
//        $data = $request->all();
//
//        $user = User::where('email',$data['email'])->first();
//
//        if($user != null && Hash::check($data['password'], $user->getAuthPassword())) {
//            $user->api_token = str_random(60);
//            $user->save();
//
//            return response($user, 200);
//        }
//
////        return response($data, 200);
//    }
//
//
//
//
//    public function logout()
//    {
//        $user = Auth::user()->token();
//        $user->revoke();
//        return 'logged out';
//    }
//
//
//
//
//
//    /**
//     * Store a newly created resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @return \Illuminate\Http\Response
//     */
////    public function logout (Request $request) {
////
////        $token = $request->user()->token();
////        $token->revoke();
////
////        $response = 'You have been succesfully logged out!';
////        return response($response, 200);
////
////    }
//
//
//
//    /*
//    * This function will get the authenticated user
//    * unset and save the api token
//    */
////    public function logout()
////    {
////        $user = Auth::user();
////        $user->api_token = null;
////        $user->save();
////        return $this->outputJSON(null,"Successfully Logged Out");
////    }
//}
