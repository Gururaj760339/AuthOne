<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Spare Part</title>

   <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-5xl mx-auto py-10">

    <div class="bg-white rounded-xl shadow-lg p-8">

        <h2 class="text-3xl font-bold mb-8">
            Edit Spare Part
        </h2>

        <form action="{{ route('vendor.spare-parts.update',$sparePart->id) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="grid md:grid-cols-2 gap-6">

                <div>
                    <label>Name</label>

                    <input type="text"
                           name="name"
                           value="{{ old('name',$sparePart->name) }}"
                           class="w-full border rounded-lg p-3">
                </div>

                <div>
                    <label>Category</label>

                    <select name="category_id"
                            class="w-full border rounded-lg p-3">

                        @foreach($categories as $category)

                            <option value="{{ $category->id }}"
                                {{ $sparePart->category_id==$category->id?'selected':'' }}>

                                {{ $category->name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div>
                    <label>Brand</label>

                    <input type="text"
                           name="brand"
                           value="{{ old('brand',$sparePart->brand) }}"
                           class="w-full border rounded-lg p-3">
                </div>

                <div>
                    <label>Model</label>

                    <input type="text"
                           name="model"
                           value="{{ old('model',$sparePart->model) }}"
                           class="w-full border rounded-lg p-3">
                </div>

                <div>
                    <label>Part Number</label>

                    <input type="text"
                           name="part_number"
                           value="{{ old('part_number',$sparePart->part_number) }}"
                           class="w-full border rounded-lg p-3">
                </div>

                <div>
                    <label>Country</label>

                    <input type="text"
                           name="country"
                           value="{{ old('country',$sparePart->country) }}"
                           class="w-full border rounded-lg p-3">
                </div>

                <div>
                    <label>Price</label>

                    <input type="number"
                           step="0.01"
                           name="price"
                           value="{{ old('price',$sparePart->price) }}"
                           class="w-full border rounded-lg p-3">
                </div>

                <div>
                    <label>Stock</label>

                    <input type="number"
                           name="stock"
                           value="{{ old('stock',$sparePart->stock) }}"
                           class="w-full border rounded-lg p-3">
                </div>

                <div>
                    <label>Unit</label>

                    <input type="text"
                           name="unit"
                           value="{{ old('unit',$sparePart->unit) }}"
                           class="w-full border rounded-lg p-3">
                </div>

                <div>
                    <label>Status</label>

                    <select name="status"
                            class="w-full border rounded-lg p-3">

                        <option value="Available" {{ $sparePart->status=='Available'?'selected':'' }}>
                            Available
                        </option>

                        <option value="Out of Stock" {{ $sparePart->status=='Out of Stock'?'selected':'' }}>
                            Out of Stock
                        </option>

                        <option value="Inactive" {{ $sparePart->status=='Inactive'?'selected':'' }}>
                            Inactive
                        </option>

                    </select>

                </div>

                <div class="md:col-span-2">

                    <label>Description</label>

                    <textarea
                        name="description"
                        rows="5"
                        class="w-full border rounded-lg p-3">{{ old('description',$sparePart->description) }}</textarea>

                </div>

                <div>

                    <label>Current Image</label>

                    <img src="{{ asset('storage/'.$sparePart->image) }}"
                         class="w-40 h-40 object-cover rounded-lg border mt-2">

                </div>

                <div>

                    <label>New Image</label>

                    <input type="file"
                           name="image"
                           class="w-full border rounded-lg p-3 mt-2">

                </div>

                <div class="md:col-span-2">

                    <label class="inline-flex items-center">

                        <input type="checkbox"
                               name="featured"
                               value="1"
                               {{ $sparePart->featured ? 'checked':'' }}
                               class="mr-2">

                        Featured Product

                    </label>

                </div>

            </div>

            <div class="mt-8 flex gap-3">

                <button class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg">
                    Update Spare Part
                </button>

                <a href="{{ route('vendor.spare-parts.index') }}"
                   class="bg-gray-600 hover:bg-gray-700 text-white px-8 py-3 rounded-lg">
                    Cancel
                </a>

            </div>

        </form>

    </div>

</div>

</body>
</html>