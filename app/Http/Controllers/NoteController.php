<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
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

            return response(['errors' => $validator->messages()], 400);
        }

        // Passed validation, create the new note and return a 201

        $request_data = [
            'email' => $request->user()->email,
            'title' => $request->title,
            'note' => $request->note
        ];

        $response = [
            'message' => 'New note successfully created',
            'note' => Note::create($request_data)
        ];
        
        return response($response, 201);
    }


    /**
     * Returns all notes associated with the logged in user
     */
    public function index() {
        $user = auth('sanctum')->user();

        $note = new Note;

        $response = [
            'notes' => $note->getNote($user->email)
        ];

        return response($response, 200);
    }
 
    /**
     * Returns a specific note
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = auth('sanctum')->user();

        $note = new Note;

        $response = [
            'notes' => $note->getNote($user->email, $id)
        ];

        return response($response, 200);
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
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:50',
            'note' => 'max:1000'
        ]);

        if($validator->fails()) {
            // There were errors with the validation, don't create the new note and return a 400 with the error messages

            return response(['errors' => $validator->messages()], 400);
        }

        // Passed validation, select the note from the database

        $note = new Note;

        $request_data = [
            'title' => $request->title,
            'note' => $request->note
        ];

        $response = [
            'message' => $note->updateNote($request_data, $id, $request->user()->email)
        ];
        
        return response($response, 200);
    }

    /**
     * Delete the note with the given title for the user associated with the token sent
     *
     * @param  int  $id 
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = auth('sanctum')->user();

        $note = new Note;

        $response = [
            'message' => $note->removeNote($id, $user->email)
        ];

        return response($response, 200);
    }
}
