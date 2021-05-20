<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class NoteModel extends Model
{
    use HasFactory;

    public function create($request) {
        $insert = DB::table('notes')->insert($request);

        return $insert ? 'New note successfully created' : 'There was an error inserting the new note';
    }
}
