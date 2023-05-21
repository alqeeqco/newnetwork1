<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\Settings;
use App\Models\Subscribe;
use App\Models\WhyChooseUs;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class QuickLinkController extends Controller
{
    public function about(Request $request)
    {
        $min = Products::first();
        $max = Products::orderBy('id', 'desc')->first();
        if ($min || $max){
            $single_product = Products::where('id', rand($min->id, $max->id))->first();
        }else{
            $single_product = Products::first();
        }
        if (App::getLocale() == 'en'){
            $about = Settings::where('key_id' , 'about_en')->first();
        } else{
            $about = Settings::where('key_id' , 'about_ar')->first();
        }
        $Why_People_Choose_Us = WhyChooseUs::where('status' , '1')->orderByDesc('id')->get();

        return view('web.quick_link.about', compact('about' , 'Why_People_Choose_Us' , 'single_product'));
    }

    public function terms_use(Request $request)
    {
        $min = Products::first();
        $max = Products::orderBy('id', 'desc')->first();
        if ($min || $max){
            $single_product = Products::where('id', rand($min->id, $max->id))->first();
        }else{
            $single_product = Products::first();
        }
        if (App::getLocale() == 'en'){
            $conditions = Settings::where('key_id' , 'conditions_en')->first();
        } else{
            $conditions = Settings::where('key_id' , 'conditions_ar')->first();
        }
        $Why_People_Choose_Us = WhyChooseUs::where('status' , '1')->orderByDesc('id')->get();
        return view('web.quick_link.terms_of_use', compact('conditions' , 'single_product' , 'Why_People_Choose_Us'));
    }

    public function privacy_policy(Request $request)
    {
        $min = Products::first();
        $max = Products::orderBy('id', 'desc')->first();
        if ($min || $max){
            $single_product = Products::where('id', rand($min->id, $max->id))->first();
        }else{
            $single_product = Products::first();
        }
        if (App::getLocale() == 'en'){
            $privacy = Settings::where('key_id' , 'privacy_en')->first();
        } else{
            $privacy = Settings::where('key_id' , 'privacy_ar')->first();
        }

        $Why_People_Choose_Us = WhyChooseUs::where('status' , '1')->orderByDesc('id')->get();

        return view('web.quick_link.privacy_policy', compact('privacy' , 'single_product' , 'Why_People_Choose_Us'));
    }

    public function faq(Request $request)
    {
        $min = Products::first();
        $max = Products::orderBy('id', 'desc')->first();
        if ($min || $max){
            $single_product = Products::where('id', rand($min->id, $max->id))->first();
        }else{
            $single_product = Products::first();
        }
        if (App::getLocale() == 'en'){
            $faq = Settings::where('key_id' , 'faq_en')->first();
        } else{
            $faq = Settings::where('key_id' , 'faq_ar')->first();
        }
        $Why_People_Choose_Us = WhyChooseUs::where('status' , '1')->orderByDesc('id')->get();
        return view('web.quick_link.faq', compact('faq' , 'single_product' , 'Why_People_Choose_Us'));
    }
}
