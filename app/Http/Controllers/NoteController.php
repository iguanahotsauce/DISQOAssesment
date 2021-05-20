<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NoteModel;
use Illuminate\Support\Facades\Validator;

class NoteController extends Controller
{
    /** 
     * Create a new note
     * 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JSON response showing valid insert or error message
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:50',
            'note' => 'max:1000'
        ]);

        if($validator->fails()) {
            // There were errors with the validation, don't create the new note and return a 400 with the error messages

            return response()->json($validator->messages(), 400);
        }

        // Passed validation, create the new note and return a 201

        $note = new NoteModel;

        $request_data = [
            'email' => $request->user()->email,
            'title' => $request->title,
            'note' => $request->note
        ];

        $response = [
            'message' => $note->createNote($request_data)
        ];
        
        return response($response, 201);
    }
 
    /**
     * Returns a specific note
     * 
     * @param string $email
     * @param string $title
     * @return \Illuminate\Http\Response
     */
    public function show($email, $title)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Delete the note with the given title for the user associated with the token sent
     *
     * @param  string  $title 
     * @return \Illuminate\Http\Response
     */
    public function destroy($title)
    {
        if(!isset($title)) return response(['message' => 'Title is required'], 400);

        $user = auth('sanctum')->user();

        $note = new NoteModel;

        $response = [
            'message' => $note->removeNote($title, $user->email)
        ];

        return response($response, 200);
    }
}
