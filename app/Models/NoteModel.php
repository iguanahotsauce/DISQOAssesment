<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class NoteModel extends Model
{
    use HasFactory;

    public function createNote($request) {
        $insert = DB::table('notes')->insert($request);

        return $insert ? 'New note successfully created' : 'There was an error inserting the new note';
    }

    public function removeNote($title, $user) {
        $delete = DB::table('notes')->where('email', '=', $user)->where('title', '=', $title)->delete();

        return $delete ? 'Note successfully deleted' : 'There was no note with that title for the associated user';
    }
}
