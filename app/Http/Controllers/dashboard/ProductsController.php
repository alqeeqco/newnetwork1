<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Colors;
use App\Models\Images;
use App\Models\Products;
use App\Models\Specifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Cookie;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:Product-List|Product-Create|Product-Edit|Product-Delete', ['only' => ['index','store']]);
        $this->middleware('permission:Product-Create', ['only' => ['create','store']]);
        $this->middleware('permission:Product-Edit', ['only' => ['edit','update']]);
        $this->middleware('permission:Product-Delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $Products_s = Products::with('categories', 'images')->orderBy('id' , 'DESC');

        if ($request->type == "most_recent") {
            $Products_s->where('appear', 'most_recent');
        } elseif ($request->type == "best_seller") {
            $Products_s->where('appear', 'best_seller');
        } elseif ($request->type == "first_home_page") {
            $Products_s->where('appear', 'first_home_page');
        } elseif ($request->type == "only_product") {
            $Products_s->where('appear', 'only_product');
        } elseif ($request->type == "all") {
            $Products_s->where('appear', 'all');
        }
        $Products_s = $Products_s->get();

        if ($request->ajax()) {
            return view('dashboard.Products.table-data', compact('Products_s'))->render();
        }
        return view('dashboard.Products.index', compact('Products_s'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $cat = Categories::get();
        return view('dashboard.Products.create', compact('cat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Cookie::get('images')){
            $data = $request->except('image');
            if (!$request->file('image')) {
                $validator = $request->validate([
                    'image' => 'nullable|image',
                ]);
            }else{
                $name = Str::random(12);
                $path = $request->file('image');
                $name = $name . time() . '.' . $request->file('image')->getClientOriginalExtension();
                $data['image'] = $name;
                $path->move('dashboard/images', $name);
                Cookie::queue('images', $data['image'] , 30);
            }
        }else{
            $data = $request->except('image');
            if (!$request->file('image')) {
                $validator = $request->validate([
                    'image' => 'required|image',
                ]);
            }else{
                $name = Str::random(12);
                $path = $request->file('image');
                $name = $name . time() . '.' . $request->file('image')->getClientOriginalExtension();
                $data['image'] =  $name;
                $path->move('dashboard/images', $name);
                Cookie::queue('images', $data['image'] , 30);
            }
        }
        $validator = $request->validate(Products::$rules);
        $data['image'] = Cookie::get('images');
		if ($request->status == 'on') {
            $data['status'] = 1;
        } else {
            $data['status'] = 0;
        }
        $quantity = 0;
        if($request->test) {
            foreach ($request->test as $i => $key) {
                $quantity = $quantity + $key['quantity'];
            };
        }
        $data['quantity'] = $quantity;


        $product = Products::create($data);

        if($request->specifications){
            foreach ($request->specifications as $i => $key) {
                Specifications::create([
                    'product_id' => $product->id,
                    'title_en' => $key['title_en'],
                    'title_ar' => $key['title_ar'],
                    'option_en' => $key['option_en'],
                    'option_ar' => $key['option_ar'],
                    'other_option_en' => $key['other_option_en'],
                    'other_option_ar' => $key['other_option_ar'],
                ]);
            };
        }
        if($request->test) {
            foreach ($request->test as $i => $key) {
                Colors::create([
                    'product_id' => $product->id,
                    'color' => $key['colors'],
                    'quantity' => $key['quantity'],
                ]);
            };
        }
        Cookie::queue(Cookie::forget('images'));
        return redirect()->route('products.index')->with('success', __('lang.success'))->with('image' , $data['image'] ?? "");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Products_s = Products::with('categories')->where('category_id', $id)->get();

        return view('dashboard.Products.index', compact('Products_s', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $cat = Categories::get();
        $products_s = Products::with('colors' , 'specifications')->find($id);
        return view('dashboard.Products.edite', compact('products_s', 'cat'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
//        return $request->all();
        $validator = $request->validate(Products::$rules2);
        $Products = Products::find($request->id);
        $data = $request->except('image');
        if ($request->file('image')) {
            $name = Str::random(12);
            $path = $request->file('image');
            $name = $name . time() . '.' . $request->file('image')->getClientOriginalExtension();
            $data['image'] = $name;
            $path->move('dashboard/images', $name);
        }
        if ($request->status == 'on') {
            $data['status'] = 1;
        } else {
            $data['status'] = 0;
        }
        $quantity = 0;
        foreach ($request->test as $i => $key) {
            $quantity = $quantity + $key['quantity'];
        };
        $data['quantity'] = $quantity;
        $Products->update($data);
        $specifications = Specifications::where('product_id', $Products->id)->delete();
        if ($request->specifications){
            foreach ($request->specifications as $i => $key) {
                Specifications::create([
                    'product_id' => $Products->id,
                    'title_en' => $key['title_en'],
                    'title_ar' => $key['title_ar'],
                    'option_en' => $key['option_en'],
                    'option_ar' => $key['option_ar'],
                    'other_option_en' => $key['other_option_en'],
                    'other_option_ar' => $key['other_option_ar'],
                ]);
            };
        }
        $color = Colors::where('product_id', $Products->id)->delete();
        foreach ($request->test as $i => $key) {
            Colors::create([
                'product_id' => $Products->id,
                'color' => $key['colors'],
                'quantity' => $key['quantity'],
            ]);
        };
        return redirect()->route('products.index')->with('success', __('lang.success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Products = Products::find($id)->delete();
        return redirect()->route('products.index')->with('success', __('lang.delete'));
    }

    public function updateStauts($id)
    {
        $Products = Products::find($id);
        if ($Products->status == '1') {
            $Products->update(['status' => 0]);

        } else {
            $Products->update(['status' => 1]);

        }
        return redirect()->route('products.index');
    }

    public function appearUpdate(Request $request, $id)
    {
//        return $request->all();
        $product = Products::find($id);
        $product->appear = $request->appear;
        $product->update();
//        return redirect()->route('products.index');
    }

    public function reStore(Request $request , $id)
    {
        $oldProduct = Products::find($id);
        $newProduct = $oldProduct->replicate();
        $newProduct->save();

        foreach ($oldProduct->specifications as $item) {
            $newSpecification = $item->replicate();
            $newProduct->specifications()->save($newSpecification);
        }

        foreach ($oldProduct->colors as $item) {
            $newColor = $item->replicate();
            $newProduct->colors()->save($newColor);
        }

        foreach ($oldProduct->imageable as $item) {
            Images::create([
                'image' => $item->image,
                'imageable_type' => '\App\Models\products',
                'imageable_id' => $newProduct->id,
            ]);
        }

        return redirect()->back();
    }
}
