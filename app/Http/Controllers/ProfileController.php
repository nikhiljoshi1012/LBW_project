<?php

namespace App\Http\Controllers;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
// use Intervention\Image\Facades\Image;
// use Dompdf\FrameDecorator\Image;
// use Svg\Tag\Image :: make();


class ProfileController extends Controller
{
    public function index()
    {
        $current_userid = Auth()->user()->id;
        $userinfo = User::where('id','=',$current_userid)->first();
        $userprofile = Profile::where('user_id','=',$current_userid)->first();

        return view('profile.index',compact('userprofile','userinfo'));
    }
    public function updatepic(Request $request){
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $userid = $request->input('userid'); // Use input() to get request data
            $uploadedfile = time() . '_' . $avatar->getClientOriginalName();
            
            // Save the image using Intervention Image
            Image::make($avatar)->resize(300, 300)->save(public_path('images/' . $uploadedfile));
    
            // Find the user profile
            $userProfile = Profile::where('user_id', $userid)->first();
    
            if ($userProfile) {
                $userProfile->picture = $uploadedfile;
                $userProfile->save();
            } else {
                // Handle the case where the user profile is not found
                return redirect('profile/index')->withErrors('User profile not found.');
            }
        }
        return redirect('profile/index')->with('success', 'Profile picture updated successfully.');
    }
    public function updateinfo(Request $request){
        $newmobile = $request['updmobile']; $newaddress = $request['updaddress']; $newstatus = $request['updStatus'];
        $newcompany = $request['updcompany']; $newposition = $request['updposition']; $userid = $request['userid'];

        $userinfo = Profile::where('user_id','=',$userid)->first();
        $userinfo->mobile =$newmobile;
        $userinfo->address =$newaddress;
        $userinfo->status =$newstatus;
        $userinfo->company =$newcompany;
        $userinfo->position =$newposition;
        $userinfo->save();
        return redirect('profile/index');
    }
}
