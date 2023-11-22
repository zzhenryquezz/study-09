<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Todo;

class TodosController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();

        $payload = $request->validate([
            "title" => "required"
        ]);


        $todo = new Todo();
        
        $todo->title = $payload["title"];
        $todo->user_id = $user->id;
        
        $todo->save();

        return redirect("/")->with("success", "Todo created");
    }

    public function done(Request $request, $id)
    {
        $user = Auth::user();

        $todo = Todo::where("user_id", $user->id)->findOrFail($id);

        $todo->done = $request->has("done");

        $todo->save();

        return redirect("/")->with("success", "Todo updated");
    }

    public function destroy($id)
    {
        $user = Auth::user();

        $todo = Todo::where("user_id", $user->id)->findOrFail($id);

        $todo->delete();

        return redirect("/")->with("success", "Todo deleted");
    }
}
