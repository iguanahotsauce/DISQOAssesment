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

    public function removeNote($id, $user) {
        $delete = DB::table('notes')->where('email', '=', $user)->where('id', '=', $id)->delete();

        return $delete ? 'Note successfully deleted' : 'There was no note with that ID for the associated user';
    }

    public function updateNote($request, $id, $user) {
        $update = DB::table('notes')->where('email', '=', $user)->where('id', '=', $id)->update($request);

        return $update ? 'Note was successfully updated' : 'There was no note with that ID for the associated user';
    }

    public function getNote($user, $id = null) {
        $notes = DB::table('notes')->where('email', '=', $user);
        
        if($id) {
            $notes->where('id', '=', $id);
        }

        $notes = $notes->get();

        return $notes;
    }
}
