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
   `password=[string]`

* **Success Response:**

  * **Code:** 201 CREATED<br />
    **Content:** `{
    "user": {
        "email": "alexbeebe@icloud.com",
        "updated_at": "2021-05-20T04:56:23.000000Z",
        "created_at": "2021-05-20T04:56:23.000000Z",
        "id": 5
    },
    "token": "5|wCJjAQbhYGnABhPymX5iLJn8n4g7fK8UzPO1s3Lc"
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

* **Sample Call:**

  `curl -H "Accept: application/json" -X "POST" -d "email=alexbeebe@icloud.com&password=password" http://34.219.211.233/api/login`
  
  
**Create Note**
----
  Endpoint for creating a new note for the user associated with the bearer token sent

* **URL**

  /api/notes

* **Method:**
  
  `POST`
  
* **Data Params**

   **Required:**
 
   `title=[string|max:50]`

   **Optional:**
 
   `note=[string|max:1000]`

* **Success Response:**

  * **Code:** 201 CREATED<br />
    **Content:** `{
    "message": "New note successfully created"
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

* **Sample Call:**

  `curl -H "Accept: application/json" -H "Authorization: Bearer 7|XST8R5NPNgfg0BsW7fxjhuuFcRHT8acBC9AtuSXM" -X "POST" -d "title=Test Note&note=Test Note Body" http://34.219.211.233/api/notes`
  
  
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
    "message": [
        {
            "id": 10,
            "email": "alexbeebe@icloud.com",
            "title": "Test Note",
            "note": "Test Note Body",
            "created_at": "2021-05-20 09:05:40",
            "updated_at": "2021-05-20 09:05:40"
        }
    ]
}`

    OR

    `{
        "message": [
            {
                "id": 10,
                "email": "alexbeebe@icloud.com",
                "title": "Test Note",
                "note": "Test Note Body",
                "created_at": "2021-05-20 09:05:40",
                "updated_at": "2021-05-20 09:05:40"
            },
            {
                "id": 11,
                "email": "alexbeebe@icloud.com",
                "title": "Test Note2",
                "note": "Test Note Body",
                "created_at": "2021-05-20 09:13:20",
                "updated_at": "2021-05-20 09:13:20"
            }
        ]
    }`

 
* **Error Response:**

  * **Code:** 401 UNAUTHORIZED <br />
    **Content:** `{
    "message": "Unauthenticated."
}`

* **Sample Call:**

  `curl -H "Accept: application/json" -H "Authorization: Bearer 7|XST8R5NPNgfg0BsW7fxjhuuFcRHT8acBC9AtuSXM" -X "GET" http://34.219.211.233/api/notes/10`
  
  
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
 
   `title=[string|max:50]`
   
  **Optional:**
 
   `note=[string|max:1000]`

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

* **Sample Call:**

  `curl -H "Accept: application/json" -H "Authorization: Bearer 7|XST8R5NPNgfg0BsW7fxjhuuFcRHT8acBC9AtuSXM" -X "PUT" -d "title=Update Note Name&note=Update Note Body" http://34.219.211.233/api/notes/10`
  
  
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

  `curl -H "Accept: application/json" -H "Authorization: Bearer 7|XST8R5NPNgfg0BsW7fxjhuuFcRHT8acBC9AtuSXM" -X "DELETE" http://34.219.211.233/api/notes/10` 
