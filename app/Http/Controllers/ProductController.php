<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->user()->products()->with('category');
        
        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->has('category_id') && $request->category_id) {
            $query->where('category_id', $request->category_id);
        }
        
        $sortDirection = $request->get('sort_dir', 'asc');
        $sortBy = $request->get('sort_by', 'name');
        
        if (in_array($sortBy, ['name', 'quantity', 'id', 'created_at'])) {
            $query->orderBy($sortBy, $sortDirection === 'desc' ? 'desc' : 'asc');
        } else {
            $query->orderBy('name', 'asc');
        }

        $products = $query->paginate(12)->withQueryString();
        $categories = $request->user()->categories()->get();

        return Inertia::render('Products/Index', [
            'products' => $products,
            'categories' => $categories,
            'filters' => $request->only(['search', 'category_id', 'sort_by', 'sort_dir']),
        ]);
    }

    public function create(Request $request)
    {
        if ($request->user()->categories()->count() === 0) {
            return redirect()->route('categories.create')->with('alert', 'You must create a category first in order to create a product.');
        }

        $categories = $request->user()->categories()->get();
        return Inertia::render('Products/Create', [
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'image_url' => 'nullable|url',
            'image_file' => 'nullable|image|max:2048',
        ]);

        // Ensure category belongs to user
        $category = Category::where('id', $validated['category_id'])
            ->where('user_id', $request->user()->id)
            ->firstOrFail();

        if ($request->hasFile('image_file')) {
            $validated['image_path'] = $request->file('image_file')->store('products', 'public');
            $validated['image_url'] = null;
        }

        $request->user()->products()->create($validated);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Request $request, Product $product)
    {
        if ($product->user_id !== $request->user()->id) {
            abort(403);
        }

        $categories = $request->user()->categories()->get();
        return Inertia::render('Products/Edit', [
            'product' => $product,
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, Product $product)
    {
        if ($product->user_id !== $request->user()->id) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'image_url' => 'nullable|url',
            'image_file' => 'nullable|image|max:2048',
        ]);

        // Ensure category belongs to user
        Category::where('id', $validated['category_id'])
            ->where('user_id', $request->user()->id)
            ->firstOrFail();

        if ($request->hasFile('image_file')) {
            if ($product->image_path) {
                Storage::disk('public')->delete($product->image_path);
            }
            $validated['image_path'] = $request->file('image_file')->store('products', 'public');
            $validated['image_url'] = null;
        } elseif ($request->filled('image_url')) {
             if ($product->image_path) {
                Storage::disk('public')->delete($product->image_path);
                $validated['image_path'] = null;
            }
        }

        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Request $request, Product $product)
    {
        if ($product->user_id !== $request->user()->id) {
            abort(403);
        }

        if ($product->image_path) {
            Storage::disk('public')->delete($product->image_path);
        }

        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    public function quickSearch(Request $request)
    {
        $search = $request->get('q');
        
        $products = $request->user()->products()
            ->with('category')
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->limit(10)
            ->get();

        return response()->json($products);
    }
}
