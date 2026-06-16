# Bid Management API Documentation

This API provides CRUD operations for managing bids in the university assignment project.

## Base URL
`/api`

## Endpoints

### 1. Get All Bids
**URL:** `/api/bids`  
**Method:** `GET`  
**Response:** `200 OK`
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

### 2. Get Bid by ID
**URL:** `/api/bids/{id}`  
**Method:** `GET`  
**Response:** `200 OK` or `404 Not Found`

### 3. Create a New Bid
**URL:** `/api/bids`  
**Method:** `POST`  
**Payload:**
```json
{
  "title": "New Item",
  "description": "Description of the item",
  "amount": 150.50,
  "status": "pending"
}
```
**Response:** `201 Created`

### 4. Update Bid (Partial)
**URL:** `/api/bids/{id}`  
**Method:** `PATCH`  
**Payload:**
```json
{
  "amount": 200.00,
  "status": "accepted"
}
```
**Response:** `200 OK`

### 5. Delete Bid
**URL:** `/api/bids/{id}`  
**Method:** `DELETE`  
**Response:** `200 OK`

## Validation Rules
- **POST:**
    - `title`: required, string
    - `amount`: required, numeric
    - `status`: required, must be one of: `pending`, `accepted`, `rejected`
- **PATCH:**
    - Fields are optional but validated if provided.
