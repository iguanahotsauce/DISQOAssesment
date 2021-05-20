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
     * 
     * @return  JSON response with with the specific note
     */
    public function index() {
        // Get the users email from the token using Sanctum
        $user = auth('sanctum')->user();

        // Get all of the notes associated with the user from the Note model and return them with a 200 response
        $response = [
            'notes' => Note::where('email', $user->email)->get()
        ];

        return response($response, 200);
    }
 
    /**
     * Returns a specific note
     * 
     * @param int $id
     * @return  JSON response with with the specific note
     */
    public function show($id)
    {
        // Get the users email from the token using Sanctum
        $user = auth('sanctum')->user();

        // Get the note for the given ID from the DB but also make sure to check that it was created by the current user
        $note = Note::where('email', $user->email)->where('id', $id)->get();

        // If there is no note returned from the DB return a 400 response with an error message saying no note exists
        if(!count($note)) {
            return response(['errors' => 'No note exists for the given ID'], 400);
        }

        $response = [
            'notes' => $note
        ];

        return response($response, 200);
    }

    /**
     * Update the note with the given id for the user associated with the token sent
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return JSON response with success/failure message
     */
    public function update(Request $request, $id)
    {
        // First validate the incoiming data from the request to make sure it fits our parameters
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:50',
            'note' => 'max:1000'
        ]);

        if($validator->fails()) {
            // There were errors with the validation, don't create the new note and return a 400 with the error messages

            return response(['errors' => $validator->messages()], 400);
        }

        $request_data = [
            'title' => $request->title,
            'note' => $request->note
        ];

        $update = Note::where('email', $request->user()->email)->where('id', $id)->update($request_data);

        // If there is no note updated return a 400 response with an error message saying no note exists
        if($update != 1) {
            return response(['errors' => 'No note exists for the given ID'], 400);
        }

        // The note exists and was created by the current user, return a 200 respoonse with a success message

        return response(['message' => 'Note was successfully updated'], 200);
    }

    /**
     * Delete the note with the given id for the user associated with the token sent
     *
     * @param  int  $id 
     * @return JSON response with success/failure message
     */
    public function destroy($id)
    {
        // Get the users email from the token using Sanctum
        $user = auth('sanctum')->user();

        $delete = Note::where('email', $user->email)->where('id', $id)->delete();

        // If there is no note deleted return a 400 response with an error message saying no note exists
        if($delete != 1) {
            return response(['errors' => 'No note exists for the given ID'], 400);
        }

        // The note exists and was created by the current user, return a 200 respoonse with a success message

        return response(['message' => 'Note was successfully deleted'], 200);
    }
}
