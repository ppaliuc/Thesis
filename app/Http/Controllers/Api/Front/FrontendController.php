<?php

namespace App\Http\Controllers\Api\Front;

use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use App\Http\Resources\CounterResource;
use App\Http\Resources\DpsPlanResource;
use App\Http\Resources\FaqResource;
use App\Http\Resources\FdrPlanResource;
use App\Http\Resources\LoanPlanResource;
use App\Http\Resources\ServiceResource;
use App\Http\Resources\TestimonialResource;
use App\Models\AccountProcess;
use App\Models\Counter;
use App\Models\Currency;
use App\Models\DpsPlan;
use App\Models\Faq;
use App\Models\FdrPlan;
use App\Models\Feature;
use App\Models\Generalsetting;
use App\Models\Language;
use App\Models\LoanPlan;
use App\Models\Page;
use App\Models\Pagesetting;
use App\Models\Review;
use App\Models\Service;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function __construct()
    {
        $this->ps = Pagesetting::first();
        $this->gs = Generalsetting::first();
    }

    public function banner(){
        $data['photo'] = asset('assets/images/'.$this->ps->hero_photo);
        $data['title'] = $this->ps->hero_title;
        $data['subtitle'] = $this->ps->hero_subtitle;
        $data['button_url'] = $this->ps->hero_btn_url;
        $data['video_link'] = $this->ps->hero_link;

        return response()->json(['status' => true, 'data' => $data, 'error' => []]);
    }

    public function feature(){
        try{
            $data = Feature::orderBy('id','desc')->orderBy('id','desc')->limit(4)->get();

            return response()->json(['status' => true, 'data' => $data, 'error' => []]);
        }catch(\Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }
    }

    public function about(){
        $data['photo'] = asset('assets/images/'.$this->ps->about_photo);
        $data['title'] = $this->ps->about_title;
        $data['description'] = $this->ps->about_text;

        if($this->ps->about_attributes){
            foreach (json_decode($this->ps->about_attributes,true) as $key=>$attribute) {
                $attributes[$key] = $attribute;
            }
        }
        $data['features'] = $attributes;
        $data['button_link'] = $this->ps->about_link;

        return response()->json(['status' => true, 'data' => $data, 'error' => []]);
    }

    public function works(){
        $data['title'] = $this->ps->strategy_title;
        $data['description'] = $this->ps->strategy_details;
        $process = AccountProcess::orderBy('id','desc')->get();

        $data['process'] = $process;
        $data['photo'] = asset('assets/images/'.$this->ps->strategy_banner);

        return response()->json(['status' => true, 'data' => $data, 'error' => []]);
    }

    public function plans(){
        $data['title'] = $this->ps->plan_title;
        $data['description'] = $this->ps->plan_subtitle;
        $loanplans = LoanPlan::orderBy('id','desc')->whereStatus(1)->limit(3)->get();
        $depositsplans = DpsPlan::orderBy('id','desc')->whereStatus(1)->limit(3)->get();
        $fdrplans = FdrPlan::orderBy('id','desc')->whereStatus(1)->limit(3)->get();

        $data['deposit'] = DpsPlanResource::collection($depositsplans);
        $data['pension'] = FdrPlanResource::collection($fdrplans);
        $data['loan'] = LoanPlanResource::collection($loanplans);

        return response()->json(['status' => true, 'data' => $data, 'error' => []]);
    }

    public function apps(){
        $data['title'] = $this->ps->app_title;
        $data['description'] = $this->ps->app_details;
        $data['photo'] = asset('assets/images/'.$this->ps->app_banner);
        $data['google_play_store_photo'] = asset('assets/images/'.$this->ps->app_google_store);
        $data['google_play_store_link'] = $this->ps->app_google_link;
        $data['app_store_photo'] = asset('assets/images/'.$this->ps->app_store_photo);
        $data['app_store_store_link'] = $this->ps->app_store_link;

        return response()->json(['status' => true, 'data' => $data, 'error' => []]);
    }

    public function testimonials(){
        $data['title'] = $this->ps->review_title;
        $data['description'] = $this->ps->review_text;
        $testimonials = Review::orderBy('id','desc')->get();
        $data['reviews'] = TestimonialResource::collection($testimonials);

        return response()->json(['status' => true, 'data' => $data, 'error' => []]);
    }

    public function counters(){
        try{
            $data = Counter::orderBy('id','desc')->get();

            return response()->json(['status' => true, 'data' => CounterResource::collection($data), 'error' => []]);
        }catch(\Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }
    }

    public function cta(){
        $data['title'] = $this->ps->quick_title;
        $data['description'] = $this->ps->quick_subtitle;
        $data['photo'] = asset('assets/images/'.$this->ps->quick_photo);
        $data['background_photo'] = asset('assets/images/'.$this->ps->quick_background);
        $data['button_link'] = $this->ps->quick_link;

        return response()->json(['status' => true, 'data' => $data, 'error' => []]);
    }

    public function services(){
        try{
            $services = Service::orderBy('id','desc')->orderBy('id','desc')->get();

            return response()->json(['status' => true, 'data' => ServiceResource::collection($services), 'error' => []]);
        }catch(\Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }
    }

    public function faqs(){
        try{
            $faqs = Faq::orderBy('id','desc')->get();
            return response()->json(['status' => true, 'data' => FaqResource::collection($faqs), 'error' => []]);
        }catch(\Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }
    }

    public function pages(){
        try{
            $pages = Page::whereStatus(1)->orderBy('id','desc')->get();
            return response()->json(['status' => true, 'data' => $pages, 'error' => []]);
        }catch(\Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }
    }

    public function page_details($slug){
        try{
            $page = Page::whereSlug($slug)->first();
            return response()->json(['status' => true, 'data' => $page, 'error' => []]);
        }catch(\Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }
    }

    public function info(){
        $data['latitude'] = $this->gs->latitude;
        $data['longitude'] = $this->gs->longitude;
        $data['subtitle'] = $this->ps->side_title;
        $data['description'] = $this->ps->side_text;
        $data['address'] = $this->ps->street;
        $data['phone'] = $this->ps->phone;
        $data['email'] = $this->ps->email;

        return response()->json(['status' => true, 'data' => $data, 'error' => []]);
    }

    public function contact(Request $request)
    {
        try {
            $gs = Generalsetting::findOrFail(1);

            $subject = $request->subject;

            $to = $this->ps->contact_email;
            $name = $request->name;
            $phone = $request->phone;
            $from = $request->email;
            $msg = "Name: ".$name."\Phone: ".$phone."\nEmail: ".$from."\nMessage: ".$request->message;

            if($gs->is_smtp)
            {
                $data = [
                    'to' => $to,
                    'subject' => $subject,
                    'body' => $msg,
                ];

                $mailer = new GeniusMailer();
                $mailer->sendCustomMail($data);
            }
            else
            {
                $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
                mail($to,$subject,$msg,$headers);
            }

            return response()->json(['status' => true, 'data' => ['message' => 'Email Sent Successfully!'], 'error' => []]);
        } catch (\Throwable $th) {
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $th->getMessage()]]);
        }

    }

    public function defaultLanguage() {
        try{
            $language = Language::where('is_default','=',1)->first();
            if(!$language){
                return response()->json(['status' => true, 'data' => [], 'error' => ['message' => 'No Language Found']]);
            }
            $data_results = file_get_contents(resource_path().'/lang/'.$language->file);
            $lang = json_decode($data_results);
            return response()->json(['status' => true, 'data' => ['basic' => $language ,'languages' => $lang], 'error' => []]);
        }
        catch(\Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }
    }

    public function language($id) {
        try{
            $language = Language::find($id);
            if(!$language){
                return response()->json(['status' => true, 'data' => [], 'error' => ['message' => 'No Language Found']]);
            }
            $data_results = file_get_contents(resource_path().'/lang/'.$language->file);
            $lang = json_decode($data_results);
            return response()->json(['status' => true, 'data' => ['basic' => $language ,'languages' => $lang], 'error' => []]);
        }
        catch(\Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }
    }

    public function languages() {
        try{
            $languages = Language::all();
            return response()->json(['status' => true, 'data' => $languages, 'error' => []]);
        }
        catch(\Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }
    }

    public function defaultCurrency() {
        try{
            $currency = Currency::where('is_default','=',1)->first();
            if(!$currency){
                return response()->json(['status' => true, 'data' => [], 'error' => ['message' => 'No Currency Found']]);
        }
            return response()->json(['status' => true, 'data' => $currency, 'error' => []]);
        }
        catch(\Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }
    }


    public function currency($id) {
        try{
            $currency = Currency::find($id);
            if(!$currency){
                return response()->json(['status' => true, 'data' => [], 'error' => ['message' => 'No Currency Found']]);
        }
         return response()->json(['status' => true, 'data' => $currency, 'error' => []]);
        }
        catch(\Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }
    }

    public function currencies() {
        try{
            $currencies = Currency::all();
            return response()->json(['status' => true, 'data' => $currencies, 'error' => []]);
        }
        catch(\Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }
    }
}
