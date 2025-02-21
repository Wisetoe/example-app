<x-app-layout>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <title>Hello, world!</title>
        <style>
            nav{
                background-color: rgb(31 41 55 / var(--tw-bg-opacity, 1));
            }
        </style>
    </head>
    <div class="text-center">
        <h1 style="color: white;">Пользователи</h1>
        <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Добавить пользователя</a>

        @if(session()->has('success'))
            <div class="alert alert-success">{{ session()->get('success') }}</div>
        @endif

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr style="color: white;">
                            <th>ID</th>
                            <th>Имя</th>
                            <th>Email</th>
                            <th>Роль</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr style="color: white;">
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{  ucfirst($user->role) }}</td> 
                                <td>
                                    <a class="btn btn-warning" href="{{ route('users.edit', $user->id) }}">Редактировать</a>
                                    <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Удалить</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>