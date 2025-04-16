<?php
 
namespace App\Http\Controllers;
 
use App\Models\Organization;
 
use Illuminate\Http\Request;
 
class OrganizationController extends Controller
{
    public function index()
    {
        $organization = Organization::orderby('created_at', 'desc')->get();
        return view('Dashboard.Organization', compact('organization'));
    }
    public function AddNewOrg(Request $data)
    {
        $organization = new Organization();
 
        $organization->name = $data->input('name');
        $organization->address = $data->input('address');
        $organization->phone = $data->input('phone');
        $organization->email = $data->input('email');
        $organization->timezone = $data->input('timezone');
        if ($data->hasFile('file')) {
            $file = $data->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('Uploads/profiles/vehicles/'), $filename);
            $organization->logo = $filename;
        } else {
            $organization->logo = 'default.png'; // or handle based on your logic
        }
        $organization->save();
        return redirect()->back()->with('success', 'congrats');
    }
    public function updateOrg(Request $data)
    {
 
        $organization = Organization::find($data->input('id'));
 
        // $organization->id=$data->input('id');
        if ($data->input('name')) {
            $organization->name = $data->input('name');
        }
 
        $organization->address = $data->input('address');
        $organization->phone = $data->input('phone');
        $organization->email = $data->input('email');
        $organization->timezone = $data->input('timezone');
       
        if ($data->file('file') != null) {
            $organization->logo = $data->file('file')->getClientOriginalName();
            $data->file('file')->move('Uploads/profiles/vehicles/', $organization->logo);
        }
        $organization->save();
        return redirect()->back()->with('success', 'update successfully');
    }
    public function deleteOrg($id)
    {
        $organization = Organization::find($id);
   
       
   
        $organization->delete();
   
        return redirect()->back()->with('success', 'Deleted successfully');
    }
   
 
}