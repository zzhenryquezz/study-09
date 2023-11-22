<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h1>Home page</h1>

    <h2>Todos</h2>

    @if (session("success"))
        <p style="color:green" >{{ session("success") }}</p>
    @endif

    <form action="todos" method="POST">
        @csrf
        <input type="text" name="title" placeholder="Title" autofocus>
        <button type="submit">Add</button>
    </form>

    @if (!count($todos))
        <p>No todos</p>
    @else
        <ul>
            @foreach ($todos as $todo)
            
                <li>
                    <div style="display:flex">
                        <form action="todos/{{ $todo->id }}/done" method="POST">
                            @csrf
                            <input
                                type="checkbox"
                                name="done"
                                {{ $todo->done ? "checked" : "" }}
                                onchange="this.form.submit()"
                            >
                        </form>
                        
                        <div>
                            {{ $todo->title }}
                        </div>

                        <form action="todos/{{ $todo->id }}" method="POST">
                            @csrf
                            @method("DELETE")
                            <button type="submit">X</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif

    <form action="logout" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>