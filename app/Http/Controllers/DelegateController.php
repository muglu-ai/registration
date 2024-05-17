<?php

namespace App\Http\Controllers;

use App\Http\Requests\DelegateVali1;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Mews\Captcha\Captcha;
use Monarobase\CountryList\CountryListFacade;
use App\Models\delegate_registration;
use App\Http\Controllers\ZohoApi;

class DelegateController extends Controller
{
    /**
     * Show the form for creating the resource.
     */
    public function create(): never
    {
        abort(404);
    }

    /**
     * Store the newly created resource in storage.
     */
    public function store(Request $request): never
    {
        abort(404);
    }

    /**
     * Display the resource.
     */
    public function show()
    {

        $countries = $this->countryList();

//        $countries = CountryListFacade::getList('en');
        $organisation = $this->organisation();
        $sector = $this->sectorList();
        $delegates = $this->no_of_delegates();

        return view('delegate.create', compact('countries', 'organisation','sector','delegates'));
    }

    /*
    *List of Type Organisation
    */
    private function organisation()
    {
        $organisation = array('Startup' => 'Startup', 'MSME' => 'MSME', 'Corporate / Industry' => 'Corporate / Industry',
        'R&D Labs' => 'R&D Labs',  'Investors' => 'Investors', 'Government' => 'Government', 'Industry Associations' => 'Industry Associations',
        'Consulting' => 'Consulting', 'Trade Mission' => 'Trade Mission','TiE Global'=>'TiE Global', 'Others' => 'Others');
        return $organisation;
    }
    /**
     * List of Sectors.
     */
    private function sectorList()
    {
        $sector = array('Information Technology' => 'Information Technology', 'Electronics' => 'Electronics', 'Biotechnology' => 'Biotechnology', 'Startup' => 'Startup', 'Academia & University (not for Student Only Faculty and HOD)' => 'Academia & University (not for Student Only Faculty and HOD)', 'Others' => 'Others');
        return $sector;
    }

    private function no_of_delegates()
    {
        $delegates = 5;
        return $delegates;
    }

    public function countryList()
    {
        $countries = Country::all()->pluck('name');
        return $countries;
    }

    /**
     * Delegate Submit Phase 1.
     */
   /* public function submit(Request $request): \Illuminate\Http\RedirectResponse
    {

        Log::info(print_r($request->all(), true));
//        $form_validated = $request->validate([
//            '_token' => 'required',
//            'sector' => 'required | string | max:100',
//            'organisation' => 'required | string | max:255',
//            'delegates' => 'required | integer',
//            'category' => 'required | string | max:255',
//            'org_name' => 'required | string | max:255',
//            'country' => 'required | string | max:150',
//            'mobile' => 'required | string | max:15',
//            'state' => 'required | string | max:150',
//            'city' => 'required | string | max:150',
//            'zipcode' => 'required | string | max:10',
//            'email' => 'required|email | max:255',
//            'tie_global_membership_id' => 'required | string | max:150',
//            'captcha' => 'required|captcha | max:25',
//        ]);
        $form_validated = $request->validate([
            'sector' => 'required|string|max:100',
            'organisation' => 'required|string|max:255',
            'delegates' => 'required|integer',
            'category' => 'required|string|max:255',
            'org_name' => 'required|string|max:255',
            'country' => 'required|string|max:150',
            'mobile' => 'required|string|max:15',
            'state' => 'required|string|max:150',
            'city' => 'required|string|max:150',
            'zipcode' => 'required|string|max:10',
            'email' => 'required|email|max:255',
            'tie_global_membership_id' => 'required|string|max:150',
            'captcha' => 'required|captcha|max:25',
        ]);

        if(!$form_validated){
            Log::info(print_r($form_validated, true));
            return redirect()->back()->withInput();
        }
        Log::info(print_r($form_validated, true));


        $request->session()->put('delegate', $form_validated);
        return redirect()->route('newdelegate2')->with('success', 'Registration success. Please login!');
    }*/

    public function submit(Request $request): \Illuminate\Http\RedirectResponse
    {
        Log::info(print_r($request->all(), true));
        //$form_validated = $request->validated();
        $mb_id  = $request->input('tie_global_membership_id');

//        $form_validated= $request->validate([
//            'sector' => 'required|string|max:100',
//            'organisation_type' => 'required|string|max:255',
//            'delegates' => 'required|integer',
//            'category' => 'required|string|max:255',
//            'org_name' => 'required|string|max:255',
//            'country' => 'required|string|max:150',
//            'mobile' => 'required|string|max:15',
//            'state' => 'required|string|max:150',
//            'city' => 'required|string|max:150',
//            'zipcode' => 'required|string|max:10',
//            //'email' => 'required|email|max:255',
//            'tie_global_membership_id' => 'string|max:150',
//            'captcha' => 'required|captcha|max:25',
//        ]);
        //store tie global membership id in a variable so that we can use it in the next phase
       // $tie_global_membership_id = $form_validated['tie_global_membership_id'];
        $tie_global_membership_id = $mb_id;
        $ID = '';
        if($tie_global_membership_id !='N/A' && $tie_global_membership_id !='' && $tie_global_membership_id !=null){
            $ID = $this->zohoApiIntegration($tie_global_membership_id);
            Log::info(print_r($ID, true));
            $request->session()->put('zohoApiIntegrationResult', $ID);

        }



        //Log::info(print_r($form_validated, true));

//        $form_validated = $request->validated();
        $request->session()->put('delegate', $request->all());

       // return redirect()->back()->with('success', 'Form submitted successfully!');
        return redirect()->route('delegate.create')->with('zohoApiIntegrationResult', $ID );
    }






    /**
     * Zoho API Integration.
     */
    public function zohoApiIntegration($id){
        //Log::info('Zoho API Integration');
        $zoho = new ZohoApi();
        $response = $zoho->searchByMembershipId($id);

        //Log::info(print_r($response, true));
        $chapter_name = $response['data'][0]['Chapter_Name']['Chapter_Name'];

     //   $chapter_name = $response['Chapter_Name'][0]['Chapter_Name'];
        $ID  = $response['data'][0]['Chapter_Name']['ID'];
        $mem = $response['data'][0]['Membership_Category1']['Membership_Category_Name'];

        return [$ID , $chapter_name, $mem];
        //take out results from zoho api Chapter_Name, "Name1": { "first_name": "testk33" }, Phone_Number



    }





    /**
     * Show the form for editing the resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Update the resource in storage.
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the resource from storage.
     */
    public function destroy(): never
    {
        abort(404);
    }

    public function generateCaptcha()
    {
        $captcha = new Captcha();
        return $captcha->create('default', true);
    }

    public function validateCaptcha(Request $request): void
    {
        Log::info(print_r($request->all(), true));
        $request->validate([
            'captcha' => 'required|captcha',
        ]);
    }
}
