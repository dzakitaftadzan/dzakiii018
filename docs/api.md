# Inventory System API v1
Base URL: `http://localhost:8000/api/v1`

*Catatan: Semua endpoint (kecuali Register & Login) wajib menyertakan Headers berikut:*
- `Accept`: `application/json`
- `Authorization`: `Bearer {token}`

## Auth

POST /register
Body: { name, email, password, password_confirmation }
Response: 201 Created {
  "success": true,
  "data": { "user": {...}, "token": "..." },
  "message": "User registered"
}

POST /login
Body: { email, password }
Response: 200 OK {
  "success": true,
  "data": { "user": {...}, "token": "..." },
  "message": "User logged in"
}

## Categories

GET /categories
Response: 200 OK (Menampilkan semua kategori)

POST /categories
Body: { name }
Response: 201 Created

GET /categories/{id}
Response: 200 OK (Menampilkan detail satu kategori)

PUT /categories/{id}
Body: { name }
Response: 200 OK

DELETE /categories/{id} *(admin only)*
Response: 204 No Content

## Items

GET /items
Response: 200 OK (Menampilkan semua item)

POST /items
Body: { name, quantity, price, category_id }
Response: 201 Created

GET /items/{id}
Response: 200 OK (Menampilkan detail satu item)

PUT /items/{id}
Body: { name, quantity, price, category_id }
Response: 200 OK

DELETE /items/{id} *(admin only)*
Response: 204 No Content