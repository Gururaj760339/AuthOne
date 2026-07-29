<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add User - AutoOne</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>


<body class="bg-gray-100">


    <div class="max-w-3xl mx-auto py-10 px-5">


        <div class="bg-white shadow rounded-lg p-8">


            <h2 class="text-2xl font-bold mb-6 text-gray-800">
                Add New User
            </h2>



            <form action="{{ route('admin.store.users') }}" method="POST" enctype="multipart/form-data">

                @csrf

                <!-- Name -->

                <div class="mb-4">

                    <label class="block mb-2 font-medium">
                        Name
                    </label>

                    <input type="text" name="name" value="{{ old('name') }}"
                        class="w-full border rounded-lg px-4 py-2" placeholder="Enter name">


                    @error('name')
                        <p class="text-red-600 text-sm">
                            {{ $message }}
                        </p>
                    @enderror


                </div>





                <!-- Email -->

                <div class="mb-4">

                    <label class="block mb-2 font-medium">
                        Email
                    </label>

                    <input type="email" name="email" value="{{ old('email') }}"
                        class="w-full border rounded-lg px-4 py-2" placeholder="Enter email">


                    @error('email')
                        <p class="text-red-600 text-sm">
                            {{ $message }}
                        </p>
                    @enderror


                </div>






                <!-- Phone -->

                <div class="mb-4">

                    <label class="block mb-2 font-medium">
                        Phone
                    </label>

                    <input type="text" name="phone" value="{{ old('phone') }}"
                        class="w-full border rounded-lg px-4 py-2" placeholder="Phone number">


                </div>







                <!-- Avatar -->

                <div class="mb-4">

                    <label class="block mb-2 font-medium">
                        Avatar
                    </label>


                    <input type="file" name="avatar" class="w-full border rounded-lg px-4 py-2">


                </div>







                <!-- Role -->

                <div class="mb-4">

                    <label class="block mb-2 font-medium">
                        Role
                    </label>


                    <select name="role" class="w-full border rounded-lg px-4 py-2">


                        <option value="customer">
                            Customer
                        </option>


                        <option value="vendor">
                            Vendor
                        </option>


                        <option value="admin">
                            Admin
                        </option>

                        <option value="finance_partner">
                            Finance Partner
                        </option>


                    </select>


                </div>







                <!-- Password -->

                <div class="mb-6">

                    <label class="block mb-2 font-medium">
                        Password
                    </label>


                    <input type="password" name="password" class="w-full border rounded-lg px-4 py-2"
                        placeholder="Password">


                    @error('password')
                        <p class="text-red-600 text-sm">
                            {{ $message }}
                        </p>
                    @enderror


                </div>








                <div class="flex justify-between">


                    <a href="{{ route('admin.users') }}" class="bg-gray-500 text-white px-5 py-2 rounded-lg">

                        Back

                    </a>



                    <button type="submit" class="bg-red-600 text-white px-5 py-2 rounded-lg hover:bg-red-700">

                        Create User

                    </button>


                </div>




            </form>



        </div>


    </div>


</body>

</html>
