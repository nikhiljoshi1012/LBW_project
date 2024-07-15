<?php

namespace App\Http\Controllers;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Intervention\Image\ImageManagerStatic as Image;
use Imagine\Gd\Imagine;
use Imagine\Image\Box;
use RealRashid\SweetAlert\Facades\Alert;



class ProfileController extends Controller
{
    public function createProfileForUser($userId) {
        $profile = new Profile();
        $profile->user_id = $userId;
        $profile->save();
    }
    public function index()
    {
        $current_userid = Auth::user()->id;
        $userinfo = User::where('id', '=', $current_userid)->first();
        $userprofile = Profile::where('user_id', '=', $current_userid)->first();
        $profilePicture = $userprofile->picture ?? 'default.jpg'; // Use a default image if no profile picture exists
    
        return view('profile.index', compact('userprofile', 'userinfo', 'profilePicture'));
    }

    
    public function updatepic(Request $request)
    {
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $userid = $request->input('userid');
            $uploadedfile = time() . '_' . $avatar->getClientOriginalName();
            
            // Ensure the directory exists
            if (!file_exists(public_path('images'))) {
                mkdir(public_path('images'), 0777, true);
            }
    
            $imagine = new Imagine();
            $size = new Box(300, 300);
            
            $imagine->open($avatar->getPathname())
                    ->resize($size)
                    ->save(public_path('images/' . $uploadedfile));
            
            $user = Profile::where('user_id', '=', $userid)->first();
            $user->picture = $uploadedfile;
            $user->save();
        }
        Alert::success('Success!', 'Profile picture updated successfully!');

        return redirect()->route('profile.index');
    }

    public function updateinfo(Request $request)
    {
        // Retrieve all input fields from the form
        $newmobile = $request['updmobile'];
        $newaddress = $request['updaddress'];
        $newstatus = $request['updStatus'];
        $newcompany = $request['updcompany'];
        $newposition = $request['updposition'];
        $userid = $request['userid'];
    
        // Find the profile record to update based on user ID
        $userinfo = Profile::where('user_id', '=', $userid)->first();
    
        // Update the profile fields with new values
        $userinfo->mobile = $newmobile;
        $userinfo->address = $newaddress;
        $userinfo->status = $newstatus; // Ensure this matches a valid value ('Single' or 'Married')
        $userinfo->company = $newcompany;
        $userinfo->position = $newposition;
    
        // Save the updated profile information
        $userinfo->save();
    
        // Redirect back to the profile index page
        return redirect('profile/index');
    }
}
