<!DOCTYPE html>
<html>

<head>

    <title>
        Finance Partners
    </title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


</head>


<body class="bg-light">


    <div class="container mt-5">


        <div class="d-flex justify-content-between mb-4">


            <h2>
                Finance Partners
            </h2>


            <a href="{{ route('admin.finance.partner.create') }}" class="btn btn-primary">

                Add Partner

            </a>


        </div>




        <div class="card shadow">


            <div class="card-body">


                <table class="table table-bordered">


                    <thead class="table-dark">

                        <tr>

                            <th>
                                #
                            </th>

                            <th>
                                Bank Name
                            </th>

                            <th>
                                Assigned User
                            </th>


                            <th>
                                Email
                            </th>


                            <th>
                                Interest Rate
                            </th>


                            <th>
                                Maximum Years
                            </th>


                            <th>
                                Status
                            </th>


                            <th>
                                Action
                            </th>


                        </tr>

                    </thead>



                    <tbody>


                        @forelse($partners as $partner)
                            <tr>


                                <td>
                                    {{ $loop->iteration }}
                                </td>



                                <td>

                                    {{ $partner->name }}

                                </td>



                                <td>

                                    @if ($partner->user)
                                        {{ $partner->user->name }}
                                    @else
                                        <span class="text-danger">
                                            Not Assigned
                                        </span>
                                    @endif

                                </td>




                                <td>

                                    {{ $partner->user->email ?? '-' }}

                                </td>



                                <td>

                                    {{ $partner->interest_rate }}%

                                </td>



                                <td>

                                    {{ $partner->max_years }} Years

                                </td>




                                <td>


                                    @if ($partner->status)
                                        <span class="badge bg-success">
                                            Active
                                        </span>
                                    @else
                                        <span class="badge bg-danger">
                                            Inactive
                                        </span>
                                    @endif


                                </td>




                                <td>


                                    <form action="{{ route('admin.finance.partner.destroy', $partner->id) }}" method="POST" class="d-inline">

                                        @csrf
                                        @method('DELETE')


                                        <button class="btn btn-sm btn-danger">

                                            Delete

                                        </button>


                                    </form>


                                </td>


                            </tr>


                        @empty


                            <tr>

                                <td colspan="8" class="text-center">

                                    No Finance Partner Found

                                </td>

                            </tr>
                        @endforelse



                    </tbody>


                </table>



            </div>

        </div>



    </div>


</body>

</html>
