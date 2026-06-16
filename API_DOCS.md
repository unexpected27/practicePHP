# API Documentation

This document provides detailed information about the REST API endpoints for both the Laravel and Symfony implementations of the Bid Management system.

---

## 1. Symfony API

**Base URL:** `http://localhost:8001/api/bids`

### Get All Bids
- **URL:** `/`
- **Method:** `GET`
- **Description:** Returns a list of all bids.
- **Success Response:**
  - **Code:** 200 OK
  - **Content:**
    ```json
    [
      {
        "id": 1,
        "title": "Old Laptop",
        "description": "Functional MacBook Pro 2015",
        "amount": "500.00",
        "status": "pending",
        "createdAt": "2026-06-16T15:50:12+00:00",
        "updatedAt": "2026-06-16T15:50:12+00:00"
      }
    ]
    ```

### Get Bid by ID
- **URL:** `/{id}`
- **Method:** `GET`
- **Description:** Returns a single bid by its ID.
- **Success Response:**
  - **Code:** 200 OK
  - **Content:** Same as a single item in the list above.
- **Error Response:**
  - **Code:** 404 Not Found
  - **Content:** `{"error": "Bid not found"}`

### Create Bid
- **URL:** `/`
- **Method:** `POST`
- **Description:** Creates a new bid.
- **Request Body:**
    ```json
    {
      "title": "New Bid",
      "description": "Description of new bid",
      "amount": "750.00",
      "status": "pending"
    }
    ```
- **Success Response:**
  - **Code:** 201 Created
  - **Content:** The created Bid object including generated `id` and timestamps.
- **Error Response:**
  - **Code:** 400 Bad Request
  - **Content:** Validation errors or `{"error": "Invalid JSON or data"}`

### Update Bid (Partial)
- **URL:** `/{id}`
- **Method:** `PATCH`
- **Description:** Updates an existing bid partially.
- **Request Body:**
    ```json
    {
      "amount": "800.00",
      "status": "accepted"
    }
    ```
- **Success Response:**
  - **Code:** 200 OK
  - **Content:** The updated Bid object.
- **Error Response:**
  - **Code:** 404 Not Found or 400 Bad Request.

### Delete Bid
- **URL:** `/{id}`
- **Method:** `DELETE`
- **Description:** Deletes a bid.
- **Success Response:**
  - **Code:** 204 No Content

---

## 2. Laravel API

**Base URL:** `http://localhost:8000/api/bids`

### Get All Bids
- **URL:** `/`
- **Method:** `GET`
- **Description:** Returns a list of all bids.
- **Success Response:**
  - **Code:** 200 OK
  - **Content:**
    ```json
    [
      {
        "id": 1,
        "title": "Vintage Camera",
        "description": "A well-preserved Leica M3 from the 1950s.",
        "amount": "1200.00",
        "status": "pending",
        "created_at": "2026-06-16T17:00:00.000000Z",
        "updated_at": "2026-06-16T17:00:00.000000Z"
      }
    ]
    ```

### Get Bid by ID
- **URL:** `/{id}`
- **Method:** `GET`
- **Description:** Returns a single bid by its ID.
- **Success Response:**
  - **Code:** 200 OK
  - **Content:** Same as a single item in the list above.
- **Error Response:**
  - **Code:** 404 Not Found
  - **Content:** `{"message": "Bid not found"}`

### Create Bid
- **URL:** `/`
- **Method:** `POST`
- **Description:** Creates a new bid.
- **Request Body:**
    ```json
    {
      "title": "New Item",
      "description": "Description of the item",
      "amount": 150.50,
      "status": "pending"
    }
    ```
- **Success Response:**
  - **Code:** 201 Created
  - **Content:**
    ```json
    {
      "message": "Bid created successfully",
      "data": { "id": 2, "title": "...", "created_at": "...", ... }
    }
    ```
- **Error Response:**
  - **Code:** 422 Unprocessable Entity (Validation failed)

### Update Bid (Partial)
- **URL:** `/{id}`
- **Method:** `PATCH`
- **Description:** Updates an existing bid partially.
- **Request Body:**
    ```json
    {
      "amount": 200.00,
      "status": "accepted"
    }
    ```
- **Success Response:**
  - **Code:** 200 OK
  - **Content:**
    ```json
    {
      "message": "Bid updated successfully",
      "data": { ... }
    }
    ```

### Delete Bid
- **URL:** `/{id}`
- **Method:** `DELETE`
- **Description:** Deletes a bid.
- **Success Response:**
  - **Code:** 200 OK
  - **Content:** `{"message": "Bid deleted successfully"}`
