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
   `password=[alphanumeric]`

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

  `curl -H "Accept: application/json" -X "POST" -d 'email=alexbeebe@icloud.com&password=password' http://34.219.211.233/api/login`
