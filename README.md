# API Documentation


**Login**
----
  Endpoint for receiving a new valid Bearer Token

* **URL**

  /login

* **Method:**
  
  `POST`
  
* **Data Params**

   **Required:**
 
   `email=[email]`
   `password=[string|urlencoded]`

* **Success Response:**

  * **Code:** 201 CREATED<br />
    **Content:** `{
    "user": {
        "id": 1,
        "email": "test-user@test.com",
        "email_verified_at": null,
        "created_at": "2021-05-20T21:25:42.000000Z",
        "updated_at": "2021-05-20T21:25:42.000000Z"
    },
    "token": "2|j9ptwJu2XnYskjwecHSfWrbS95nCbH2zRcR6vGcT"
}`
 
* **Error Response:**

  * **Code:** 401 UNAUTHORIZED <br />
    **Content:** `{
    "message": "The given data was invalid.",
    "errors": {
        "email": [
            "The email field is required."
        ],
        "password": [
            "The password field is required."
        ]
    }
}`

  OR
  
  * **Code:** 401 UNAUTHORIZED <br />
    **Content:** `{
    "message": "Invalid Credentials"
}`

* **Sample Call:**

  `curl -H "Accept: application/json" -X "POST" -d "email=test-user@test.com" -d "password=password" http://34.219.211.233/api/login`
  
  
**Create Note**
----
  Endpoint for creating a new note for the user associated with the bearer token sent

* **URL**

  /api/notes

* **Method:**
  
  `POST`
  
* **Data Params**

   **Required:**
 
   `title=[string|max:50|urlencoded]`

   **Optional:**
 
   `note=[string|max:1000|urlencoded]`

* **Success Response:**

  * **Code:** 201 CREATED<br />
    **Content:** `{
    "message": "New note successfully created",
    "note": {
        "email": "test-user@test.com",
        "title": "Test Note1",
        "note": "Test Note Body",
        "updated_at": "2021-05-20T21:27:15.000000Z",
        "created_at": "2021-05-20T21:27:15.000000Z",
        "id": 1
    }
}`
 
* **Error Response:**

  * **Code:** 400 BAD REQUEST <br />
    **Content:** `{
    "errors": {
        "title": [
            "The title field is required."
        ]
    }
}`
    
  OR
  
  * **Code:** 401 UNAUTHORIZED <br />
    **Content:** `{
    "message": "Unauthenticated."
}`

* **Sample Call:**

  `curl -H "Accept: application/json" -H "Authorization: Bearer 2|j9ptwJu2XnYskjwecHSfWrbS95nCbH2zRcR6vGcT" -X "POST" -d "title=Test+Note" -d "note=Test+Note+Body" http://34.219.211.233/api/notes`
  
  
**Read Note**
----
  Endpoint for getting one or all notes for the user associated with the bearer token sent

* **URL**

  /api/notes

* **Method:**

  `GET`
  
*  **URL Params**

   **Optional:**
 
   `id=[int]`

* **Success Response:**

  * **Code:** 200 OK<br />
    **Content:** `{
    "notes": [
        {
            "id": 1,
            "email": "test-user@test.com",
            "title": "Test Note1",
            "note": "Test Note Body",
            "created_at": "2021-05-20T21:27:15.000000Z",
            "updated_at": "2021-05-20T21:27:15.000000Z"
        }
    ]
}`

    OR

    `{
    "notes": [
        {
            "id": 1,
            "email": "test-user@test.com",
            "title": "Test Note1",
            "note": "Test Note Body",
            "created_at": "2021-05-20T21:27:15.000000Z",
            "updated_at": "2021-05-20T21:27:15.000000Z"
        },
        {
            "id": 2,
            "email": "test-user@test.com",
            "title": "Test Note2",
            "note": "Test Note Body",
            "created_at": "2021-05-20T21:29:05.000000Z",
            "updated_at": "2021-05-20T21:29:05.000000Z"
        }
    ]
}`

 
* **Error Response:**

  * **Code:** 401 UNAUTHORIZED <br />
    **Content:** `{
    "message": "Unauthenticated."
}`

* **Sample Call:**

  `curl -H "Accept: application/json" -H "Authorization: Bearer 2|j9ptwJu2XnYskjwecHSfWrbS95nCbH2zRcR6vGcT" -X "GET" http://34.219.211.233/api/notes/10`
  
  
**Update Note**
----

  Endpoint for updating a note, the note will only be updated if the id passed is a note owned by the user for the associated bearer token

* **URL**

  /api/notes

* **Method:**

  `PUT`
  
*  **URL Params**

   **Required:**
 
   `id=[int]`

* **Data Params**

  **Required:**
 
   `title=[string|max:50|urlencoded]`
   
  **Optional:**
 
   `note=[string|max:1000|urlencoded]`

* **Success Response:**
  
  * **Code:** 200 OK<br />
    **Content:** `{
    "message": "Note was successfully updated"
}`
 
* **Error Response:**

  * **Code:** 400 Bad Request <br />
    **Content:** `{
    "errors": {
        "title": [
            "The title field is required."
        ]
    }
}`

    
  OR
  
  * **Code:** 401 UNAUTHORIZED <br />
    **Content:** `{
    "message": "Unauthenticated."
}`

* **Sample Call:**

  `curl -H "Accept: application/json" -H "Authorization: Bearer 2|j9ptwJu2XnYskjwecHSfWrbS95nCbH2zRcR6vGcT" -X "PUT" -d "title=Updated+Note+Name" -d "note=Updated+Note+Body" http://34.219.211.233/api/notes/1`
  
  
**Delete Note**
----
  Endpoint for deleting a note, the note will only be deleted if the id passed is a note owned by the user for the associated bearer token

* **URL**

  /api/notes

* **Method:**

  `DELETE`
  
*  **URL Params**

   **Required:**
 
   `id=[int]`

* **Success Response:**

  * **Code:** 200 OK<br />
    **Content:** `{
    "message": "Note successfully deleted"
}`
 
* **Error Response:**

  * **Code:** 401 UNAUTHORIZED <br />
    **Content:** `{
    "message": "Unauthenticated."
}`

* **Sample Call:**

  `curl -H "Accept: application/json" -H "Authorization: Bearer 2|j9ptwJu2XnYskjwecHSfWrbS95nCbH2zRcR6vGcT" -X "DELETE" http://34.219.211.233/api/notes/1` 
