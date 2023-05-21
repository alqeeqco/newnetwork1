<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Products extends Model
{

    protected $table = 'products';
    public $timestamps = true;
    protected $fillable = array('category_id', 'code', 'name_en', 'name_ar', 'price', 'des_en', 'des_ar', 'tax', 'status', 'image', 'discount', 'quantity', 'appear');

    public static $rules = [
        'name_ar' => 'required|min:3|max:255',
        'name_en' => 'required|min:3|max:255',
        'category_id' => 'required|integer|exists:categories,id',
        'price' => 'required|numeric|min:1',
//        'discount' => 'required|numeric',
        'test.*.quantity' => 'required|numeric|min:1',
        'test.*.colors' => 'required',

        'specifications.*.title_en' => 'required|min:1|max:255',
        'specifications.*.title_ar' => 'required|min:1|max:255',
        'specifications.*.option_en' => 'required|min:1|max:255',
        'specifications.*.option_ar' => 'required|min:1|max:255',
        'specifications.*.other_option_en' => 'nullable|min:1|max:255',
        'specifications.*.other_option_ar' => 'nullable|min:1|max:255',
//        'des_en' => 'required|min:3|max:255',
//        'des_ar' => 'required|min:3|max:255',
//        'image' => 'nullable|image',
    ];

    public static $rules2 = [
        'name_ar' => 'required|min:3|max:255',
        'name_en' => 'required|min:3|max:255',
        'category_id' => 'required|integer|exists:categories,id',
        'price' => 'required|numeric|min:1',
//        'discount' => 'required|numeric',
        'test.*.quantity' => 'required|numeric',
        'test.*.colors' => 'required',
        'specifications.*.title_en' => 'required|min:1|max:255',
        'specifications.*.title_ar' => 'required|min:1|max:255',
        'specifications.*.option_en' => 'required|min:1|max:255',
        'specifications.*.option_ar' => 'required|min:1|max:255',
        'specifications.*.other_option_en' => 'nullable|min:1|max:255',
        'specifications.*.other_option_ar' => 'nullable|min:1|max:255',
//        'des_en' => 'required|min:3',
//        'des_ar' => 'required|min:3',
        'image' => 'nullable|image',
    ];

    public function categories(){
        return $this->belongsTo('\App\Models\Categories' , 'category_id'  , 'id');
    }


    /**
     * Get the post's image.
     */
    public function images(): MorphMany
    {
        return $this->morphMany(Images::class, 'imageable');
    }

    public function imageable()
    {
        return $this->hasMany(Images::class, 'imageable_id');

    }

    public function reviews(){
        return $this->hasMany('\App\Models\Reviews' , 'product_id'  , 'id');
    }

    public function reviews2(){
        return $this->hasMany('\App\Models\Reviews' , 'product_id'  , 'id')->where('user_id' , auth()->user()->id ?? 0);
    }

    public function colors(){
        return $this->hasMany('\App\Models\Colors' , 'product_id'  , 'id');
    }

    public function specifications(){
        return $this->hasMany('\App\Models\Specifications' , 'product_id'  , 'id');
    }

    public function favorite(){
        return $this->hasMany('\App\Models\Favorite' , 'product_id'  , 'id')->where('user_id' , auth()->user()->id ?? 0);
    }

    public function scopeTableFilters($query)
    {
        $lang = app()->getLocale();

        return $query->when(request()->input('name_en', false), function ($query, $name) use ($lang) {
//        dd($query);
            return $query->where("name_$lang", 'like', '%' . $name . '%');
        });

    }
}
