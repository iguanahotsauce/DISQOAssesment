<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class NoteModel extends Model
{
    use HasFactory;

    // Create a new note for the user associated with the token sent
    public function createNote($request) {
        $insert = DB::table('notes')->insert($request);

        return $insert ? 'New note successfully created' : 'There was an error inserting the new note';
    }

    // Delete the note for the ID sent if it was created by the user associated with the token sent
    public function removeNote($id, $user) {
        $delete = DB::table('notes')->where('email', '=', $user)->where('id', '=', $id)->delete();

        return $delete ? 'Note successfully deleted' : 'There was no note with that ID for the associated user';
    }

    // Update the note for the ID sent if it was created by the user associated with the token sent
    public function updateNote($request, $id, $user) {
        $update = DB::table('notes')->where('email', '=', $user)->where('id', '=', $id)->update($request);

        return $update ? 'Note was successfully updated' : 'There was no note with that ID for the associated user';
    }

    // Get a note or notes
    // If ID is passed then get the specific note but only if it was created by the user associated with the token sent
    // If no ID is passed get all notes for the user associated with the token sent
    public function getNote($user, $id = null) {
        $notes = DB::table('notes')->where('email', '=', $user);
        
        if($id) {
            $notes->where('id', '=', $id);
        }

        $notes = $notes->get();

        return $notes;
    }
}
