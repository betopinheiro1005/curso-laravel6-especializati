<?php

namespace App\Http\Controllers;

use App\Product;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    protected $request;
    private $repository;

    public function __construct(Request $request, Product $product){
        // dd($request->prm1);
        
        // $this->middleware('auth');

        // $this->middleware('auth')->only([
        //     'create', 'store'
        // ]);

        // $this->middleware('auth')->except([
        //      'index', 'show'
        // ]);

        $this->request = $request;
        $this->repository = $product;
    }

    public function index()
    {
        
        // $products = Product::all();
        $products = Product::latest()->paginate();
        
        return view('admin.pages.products.index', [
            'products' => $products
        ]);

        
        // $teste = "<script>alert('Olá mundo!')</script>";
        // $teste = 123;
        // $teste2 = 456;
        // $teste3 = 789;
        // $teste4 = [];
        // $products = ['TV', 'Geladeira', 'Forno', 'Sofá'];
        // $products2 = [];

        // return view('admin.pages.products.index', [
        //     'teste' => $teste,
        //     'teste2' => $teste2
        // ]);


        // return view('admin.pages.products.index', compact('teste', 'teste2', 'teste3', 'teste4', 'products', 'products2'));
    }

    public function create()
    {
        return view('admin.pages.products.create');
    }


    public function store(StoreUpdateProductRequest $request)
    {
        $data = $request->only('name', 'description', 'price');

        if ($request->hasFile('image') && $request->image->isValid()) {
            $imagePath = $request->image->store('products');

            $data['image'] = $imagePath;
        }

        $this->repository->create($data);

        return redirect()->route('products.index');
        
/*         // dd('Ok');

        // $request->validate([
        //     'name' => 'required|min:3|max:255',
        //     'description' => 'nullable|min:3|max:10000',
        //     'photo' => 'required|image'
        // ]);

        // dd('ok');

        // dd($request->all());
        // dd($request->only(['name', 'description']));
        // dd($request->name);
        // dd($request->has('name'));
        // dd($request->input('teste', 'default'));
        // dd($request->except(['_token']));
        // dd($request->file('photo'));
        // dd($request->file('photo')->isValid());
 */        
/*         if($request->file('photo')->isValid()) {
               // dd($request->photo->extension());
               // dd($request->photo->getClientOriginalName());
               // dd($request->file('photo')->store('products'));
             $nameFile = $request->name . '.' . $request->photo->extension();
             dd($request->file('photo')->storeAs('products', $nameFile));
         }
 */
    }

    public function show($id)
    {

        // $products = Product::where('id', $id)->first;

        if(!$product = $this->repository->find($id)){
            return redirect()->back();
        }

        return view('admin.pages.products.show', [
            'product' => $product
        ]);

        // return "Detalhes do produto de id {$id}";

    }

    public function edit($id)
    {

        $product = $this->repository->where('id', $id)->first();

        if(!$product){
            return redirect()->back();
        }

        return view('admin.pages.products.edit', [
            'id' => $id,
            'product' => $product
        ]);
    }

    public function update(ProductRequest $request, $id)
    {
        $product = $this->repository->where('id', $id)->first();

        if(!$product){
            return redirect()->back();
        }


        $data = $request->all();

        if ($request->hasFile('image') && $request->image->isValid()) {
            
            if ($product->image && Storage::exists($product->image)) {
                Storage::delete($product->image);
            }
            
            $imagePath = $request->image->store('products');

            $data['image'] = $imagePath;
        }

        $product->update($data);
        return redirect()->route('products.index');
       
    }

    public function destroy($id)
    {
        $product = $this->repository->where('id', $id)->first();

        if(!$product){
            return redirect()->back();
        }

        if ($product->image && Storage::exists($product->image)) {
            Storage::delete($product->image);
        }

        $product->delete();

        return redirect()->route('products.index');
    }

    public function search(Request $request){

        $filters = $request->except('_token');

        $products = $this->repository->search($request->filter);

        return view('admin.pages.products.index', [
            'products' => $products,
            'filters' => $filters
        ]);


        // dd($request->all());
    }

}
