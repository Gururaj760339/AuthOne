<!DOCTYPE html>
<html>

<head>

    <title>
        Add Finance Partner
    </title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


</head>


<body class="bg-light">


    <div class="container mt-5">


        <div class="card shadow">


            <div class="card-header">

                <h4>
                    Add Finance Partner
                </h4>

            </div>



            <div class="card-body">


                <form method="POST" action="{{ route('admin.finance.partner.store') }}">


                    @csrf



                    <div class="mb-3">


                        <label>
                            Select User
                        </label>


                        <select name="user_id" class="form-control">


                            <option value="">
                                Select Partner User
                            </option>


                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">

                                    {{ $user->name }}
                                    -
                                    {{ $user->email }}

                                </option>
                            @endforeach


                        </select>


                    </div>





                    <div class="mb-3">


                        <label>
                            Select Bank
                        </label>


                        <select name="bank_id" class="form-control">


                            <option value="">
                                Select Bank
                            </option>



                            @foreach ($banks as $bank)
                                <option value="{{ $bank->id }}">


                                    {{ $bank->name }}


                                </option>
                            @endforeach



                        </select>


                    </div>





                    <button class="btn btn-primary">

                        Add Partner

                    </button>


                </form>


            </div>


        </div>


    </div>



</body>

</html>
