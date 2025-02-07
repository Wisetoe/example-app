
<x-app-layout>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
    <style>
        nav{
            background-color: rgb(31 41 55 / var(--tw-bg-opacity, 1));
        }
    </style>
</head>
<body style="background-color: white;">

<form method="GET" action="{{ route('todos.index') }}" class="mt-5">
        <div class="row justify-content-center">
            <div class="col-4">
                <input type="text" name="search" class="form-control" placeholder="Поиск по названию" value="{{ request('search') }}">
            </div>
            <div class="col-4">
                <select name="status" class="form-control">
                    <option value="">Все статусы</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="deferred" {{ request('status') == 'deferred' ? 'selected' : '' }}>Deferred</option>
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Применить</button>
            </div>
        </div>
    </form>

<div class="row justify-content-center mt-5">
    <div class="col-lg-6">
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">
                    {{$error}}
                </div>
            @endforeach
        @endif
    </div>
</div>

<div class="text-center mt-5">
    <h2 style="color: white;" >Add Todo</h2>

    <form class="row g-3 justify-content-center" method="POST" action="{{route('todos.store')}}">
        @csrf
        <div class="col-6">
            <input type="text" class="form-control" name="title" placeholder="Title">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3">Submit</button>
        </div>
    </form>
</div>

<div class="text-center">
    <h2 style="color: white;" >All Todos</h2>
    <div class="row justify-content-center">
        <div class="col-lg-6">

            <table class="table table-bordered">
                <thead>
                <tr style="color: white;">
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>

                @php $counter=1 @endphp

                @foreach($todos as $todo)
                    <tr style="color: white;">
                        <th>{{$counter}}</th>
                        <td>{{$todo->title}}</td>
                        <td>{{$todo->created_at}}</td>
                        <td>{{ ucfirst($todo->status) }}</td>
                        <td>
                            <a href="{{route('todos.edit',['todo'=>$todo->id])}}" class="btn btn-info">Edit</a>
                            <form action="{{ route('todos.destroy', ['todo' => $todo->id]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>

                    @php $counter++; @endphp

                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</x-app-layout>
