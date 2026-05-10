<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GRÏP</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Manrope:wght@400;500;600;700&family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin_interface.css') }}">
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg bg-white border-bottom">
        <div class="container-fluid px-4 px-xl-5 justify-content-between">
            <a class="navbar-brand logo" href="{{ route('admin.inventory') }}">GRÏP</a>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="nav-icon fs-5" style="background:none;border:0;">
                    <i class="ph ph-user"></i>
                </button>
            </form>
        </div>
    </nav>
</header>

<div class="d-flex px-4 justify-content-between pt-4 align-items-center border-bottom product-bar">
    <p class="products-title px-4">Edit product</p>
</div>
<form method="POST" action="{{ route('admin.update', $product) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row py-4 px-5">
        <div class="col-12 col-sm-6 px-5 mb-3">
            <label for="productName" class="form-label">Product Name</label>
            <input type="text" name="product_name" id="productName" class="input-box form-control" value="{{ old('productName', $product->name) }}" required>
        </div>
        <div class="col-12 col-sm-6 px-5 mb-3">
            <label for="productPrice" class="form-label">Product Price</label>
            <input type="number" name="product_price" id="productPrice" min="0" class="input-box form-control" value="{{ old('productPrice', number_format($product->price)) }}" required>
        </div>
        <div class="col-12 col-sm-6 px-5 mb-3">
            <label for="productColor" class="form-label">Product Color</label>
            <input type="text" name="product_color" id="productColor" class="input-box form-control" value="{{ old('productColor', $product->color) }}" required>
        </div>
        <div class="col-12 col-sm-6 px-5 mb-3">
            <label for="productPrice" class="form-label">Discount</label>
            <input type="number" name="product_discount" id="productDiscount" min="0" step="1" max="100" class="input-box form-control" value="{{ old('productDiscount', $product->discount_percent) }}" required>
        </div>
        <div class="col-12 px-5 mb-3">
            <label for="briefDescription" class="form-label">Brief description</label>
            <input type="text" name="brief_description" id="briefDescription" class="input-box form-control" value="{{ old('shortDescription', $product->brief_description) }}" required>
        </div>
        <div class="col-12 px-5 mb-3">
            <label for="detailedDescription" class="form-label">Detailed description</label>
            <textarea type="text" name="detailed_description" id="detailedDescription" class="input-box form-control" style="height: 100px;">{{ old('detailedDescription', $product->detailed_description) }}</textarea>
        </div>
        <div class="col-12 px-5 mb-3">
            <label for="featuresSpecifications" class="form-label">Features & Specifications</label>
            <textarea type="text" name="features" id="featuresSpecifications" class="input-box form-control" style="height: 100px;">{{ old('featureSpecifications', $product->features_specifications) }}</textarea>
        </div>
        <div class="col-12 px-5 mb-3">
            <label for="images" class="form-label">Product Images</label>
            <div id="image-container" class="col-12 d-flex flex-wrap gap-4">
                @foreach($product->images->sortBy('sort_order') as $image)
                    <div class="image-item flex-column d-flex gap-2" data-id="{{ $image->id }}">
                        <img src="{{ asset($image->image_url ?? 'images/placeholder.jpg') }}" class="img-manage">

                        <input type="text" name="existing_images[{{ $image->id }}][alt_text]" class="form-control" value="{{ $image->alt_text }}" placeholder="alt text" required>
                        <input type="number" name="existing_images[{{ $image->id }}][sort_order]" class="form-control" value="{{ $image->sort_order }}" placeholder="sort order" required>
                        <input type="checkbox" name="remove_images[]" class="btn-check remove-button" id="image-{{ $image->id }}" value="{{ $image->id }}" autocomplete="off">
                        <label for="image-{{ $image->id }}" class="btn btn-outline-dark">Remove</label>
                    </div>
                @endforeach
            </div>
            <input type="file" name="new_images[]" id="images" class="form-control mt-4" accept="image/*" multiple>
        </div>
        <div class="col-12 col-sm-6 px-5 mb-3">
            <p class="mb-3">Category</p>
            <div class="d-flex flex-wrap gap-3">
                @foreach($mainCategories as $category)
                    <input type="radio" name="category" data-name="{{ $category->name }}" class="btn-check parent-category" id="category-{{ $category->id }}" value="{{ $category->id }}" autocomplete="off" {{ $product->category->parent_category_id == $category->id || $product->category_id == $category->id  ? 'checked' : '' }}>
                    <label for="category-{{ $category->id }}" class="btn btn-outline-dark">{{ $category->name }}</label>
                @endforeach
            </div>
            <p class="my-3">Subcategory</p>
            @foreach($mainCategories as $category)
                <div class="subcategory-group d-none" data-parent="{{ $category->id }}">
                    <div class="d-flex flex-wrap gap-3">
                        @foreach($category->children as $child)
                            <input type="radio" name="sub_category" data-name="{{ $child->name }}" class="btn-check" id="category-{{ $child->id }}" value="{{ $child->id }}" autocomplete="off" {{ $product->category_id == $child->id ? 'checked' : ''}}>
                            <label for="category-{{ $child->id }}" class="btn btn-outline-dark">{{ $child->name}}</label>
                        @endforeach
                    </div>
                </div>
            @endforeach
            <p class="my-3">Tags</p>
            <div class="d-flex flex-wrap gap-3">
                @foreach($tags['promo'] ?? [] as $tag)
                    <input type="checkbox" name="tags[]" data-name="{{ $tag->name }}" class="btn-check" id="tag-{{ $tag->id }}" value="{{ $tag->id }}" autocomplete="off" {{ $product->tags->contains($tag->id) ? 'checked' : '' }}>
                    <label for="tag-{{ $tag->id }}" class="btn btn-outline-dark">{{ $tag->name }}</label>
                @endforeach

                @foreach($tags['audience'] ?? [] as $tag)
                    <input type="checkbox" name="tags[]" class="btn-check audience-tag" data-name="{{ $tag->name }}" id="tag-{{ $tag->id }}" value="{{ $tag->id }}" autocomplete="off" {{ $product->tags->contains($tag->id) ? 'checked' : '' }}>
                    <label for="tag-{{ $tag->id }}" class="btn btn-outline-dark">{{ $tag->name }}</label>
                @endforeach

                @foreach($tags['color'] ?? [] as $tag)
                    <input type="checkbox" name="tags[]" class="btn-check" id="tag-{{ $tag->id }}" value="{{ $tag->id }}" autocomplete="off" {{ $product->tags->contains($tag->id) ? 'checked' : '' }}>
                    <label for="tag-{{ $tag->id }}" class="btn btn-outline-dark">{{ $tag->name }}</label>
                @endforeach
            </div>
        </div>
        <div class="col-12 col-sm-6 px-5 mb-3">
            <label for="brand" class="mb-3">Brand</label>
            <select name="brand_id" id="brand" class="form-select register-input mb-3">
                @foreach($brands as $brand)
                    <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                @endforeach
            </select>
            <p class="mb-3">Sizes</p>
            <div id="adult-clothing-sizes" class="d-flex flex-wrap gap-3 mt-3 d-none">
                @foreach($tags['adult_clothing_size'] ?? [] as $tag)
                    <input type="checkbox" name="tags[]" class="btn-check" id="tag-{{ $tag->id }}" value="{{ $tag->id }}" autocomplete="off" {{ $product->tags->contains($tag->id) ? 'checked' : '' }}>
                    <label for="tag-{{ $tag->id }}" class="btn btn-outline-dark">{{ $tag->name }}</label>
                @endforeach
            </div>
            <div id="adult-shoe-sizes" class="d-flex flex-wrap gap-3 mt-3 d-none">
                @foreach($tags['adult_shoe_size'] ?? [] as $tag)
                    <input type="checkbox" name="tags[]" class="btn-check" id="tag-{{ $tag->id }}" value="{{ $tag->id }}" autocomplete="off" {{ $product->tags->contains($tag->id) ? 'checked' : '' }}>
                    <label for="tag-{{ $tag->id }}" class="btn btn-outline-dark">{{ $tag->name }}</label>
                @endforeach
            </div>
            <div id="kids-clothing-sizes" class="d-flex flex-wrap gap-3 mt-3 d-none">
                @foreach($tags['kids_clothing_size'] ?? [] as $tag)
                    <input type="checkbox" name="tags[]" class="btn-check" id="tag-{{ $tag->id }}" value="{{ $tag->id }}" autocomplete="off" {{ $product->tags->contains($tag->id) ? 'checked' : '' }}>
                    <label for="tag-{{ $tag->id }}" class="btn btn-outline-dark">{{ $tag->name }}</label>
                @endforeach
            </div>
            <div id="kids-shoe-sizes" class="d-flex flex-wrap gap-3 mt-3 d-none">
                @foreach($tags['kids_shoe_size'] ?? [] as $tag)
                    <input type="checkbox" name="tags[]" class="btn-check" id="tag-{{ $tag->id }}" value="{{ $tag->id }}" autocomplete="off" {{ $product->tags->contains($tag->id) ? 'checked' : '' }}>
                    <label for="tag-{{ $tag->id }}" class="btn btn-outline-dark">{{ $tag->name }}</label>
                @endforeach
            </div>
        </div>
        <div class="d-flex justify-content-center gap-5 pt-5 border-top">
            <button type="submit" id="confirm-button" class="checkout-pill">Confirm</button>
            <a href="{{ route('admin.inventory') }}" class="checkout-pill">Cancel</a>
        </div>
    </div>
</form>


<script src="{{ asset('js/admin_scripts.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.2"></script>
</body>
</html>
