# Cholot CMS API Documentation

## Overview
The Cholot CMS provides comprehensive REST APIs for managing content and media. All API endpoints are accessible at `/api/` and return JSON responses.

## Base URL
```
http://127.0.0.1:8003/api
```

## Authentication
Currently, the API endpoints are open. For production, implement Laravel Sanctum authentication.

## Content Management API

### List All Pages
Get a list of all pages in the CMS.

**Endpoint:** `GET /api/content/pages`

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "title": "Homepage",
      "slug": "home",
      "status": "published",
      "created_at": "2025-08-24T10:00:00Z",
      "updated_at": "2025-08-24T15:00:00Z"
    }
  ]
}
```

### Get Page Details
Retrieve full details of a specific page including all blocks.

**Endpoint:** `GET /api/content/pages/{slug}`

**Response:**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "title": "Homepage",
    "slug": "home",
    "blocks": [
      {
        "type": "cholot_services",
        "data": {
          "section_title": "Unsere Leistungen",
          "services": [
            {
              "title": "Rückbaumanagement",
              "description": "Professionelle Planung...",
              "image": 1,
              "link": "/rueckbaumanagement"
            }
          ]
        }
      }
    ]
  }
}
```

### Create Page
Create a new page with content blocks.

**Endpoint:** `POST /api/content/pages`

**Request Body:**
```json
{
  "title": "New Page",
  "slug": "new-page",
  "blocks": [
    {
      "type": "cholot_hero",
      "data": {
        "title": "Welcome",
        "subtitle": "To our new page"
      }
    }
  ],
  "meta_title": "SEO Title",
  "meta_description": "SEO Description",
  "status": "published"
}
```

### Update Page
Update an existing page.

**Endpoint:** `PUT /api/content/pages/{slug}`

**Request Body:**
```json
{
  "title": "Updated Title",
  "blocks": [...]
}
```

### Update Page Blocks
Update only the blocks of a page.

**Endpoint:** `PATCH /api/content/pages/{slug}/blocks`

**Request Body:**
```json
{
  "blocks": [
    {
      "type": "cholot_services",
      "data": {...}
    }
  ]
}
```

### Add Block to Page
Add a single block to an existing page.

**Endpoint:** `POST /api/content/pages/{slug}/blocks`

**Request Body:**
```json
{
  "type": "cholot_cta",
  "data": {
    "title": "Contact Us",
    "button_text": "Get Started",
    "button_link": "/contact"
  },
  "position": 2
}
```

### Delete Page
Delete a page from the CMS.

**Endpoint:** `DELETE /api/content/pages/{slug}`

### Get Block Types
Get available block types and their fields.

**Endpoint:** `GET /api/content/block-types`

**Response:**
```json
{
  "success": true,
  "data": {
    "cholot_hero": {
      "name": "Hero Section",
      "fields": ["title", "subtitle", "description", "cta_text", "cta_link"]
    },
    "cholot_services": {
      "name": "Services Grid",
      "fields": {
        "section_title": "string",
        "services": ["title", "description", "image", "link"]
      }
    }
  }
}
```

## Media Management API

### List Media Files
Get a paginated list of media files.

**Endpoint:** `GET /api/media`

**Query Parameters:**
- `mime_type` - Filter by MIME type (e.g., "image")
- `search` - Search by filename
- `per_page` - Items per page (default: 20)
- `page` - Page number

**Response:**
```json
{
  "success": true,
  "data": {
    "current_page": 1,
    "data": [
      {
        "id": 1,
        "filename": "abbruch2.jpg",
        "path": "services/abbruch2.jpg",
        "url": null,
        "mime_type": "image/jpeg",
        "size": 245678,
        "disk": "public",
        "created_at": "2025-08-24T15:00:00Z"
      }
    ],
    "total": 6
  }
}
```

### Upload Single File
Upload a single file to the media library.

**Endpoint:** `POST /api/media/upload`

**Request:** `multipart/form-data`
- `file` - The file to upload (required)
- `path` - Directory path (optional, default: "uploads")
- `disk` - Storage disk (optional, default: "public")

**Response:**
```json
{
  "success": true,
  "message": "File uploaded successfully",
  "data": {
    "id": 7,
    "filename": "new-image.jpg",
    "url": "http://127.0.0.1:8003/storage/uploads/xyz123.jpg",
    "path": "uploads/xyz123.jpg",
    "size": 123456,
    "mime_type": "image/jpeg"
  }
}
```

### Upload Multiple Files
Upload multiple files at once.

**Endpoint:** `POST /api/media/upload-multiple`

**Request:** `multipart/form-data`
- `files[]` - Array of files (required)
- `path` - Directory path (optional)
- `disk` - Storage disk (optional)

### Upload from URL
Download and store a file from a URL.

**Endpoint:** `POST /api/media/upload-from-url`

**Request Body:**
```json
{
  "url": "https://example.com/image.jpg",
  "filename": "custom-name.jpg",
  "path": "imports",
  "disk": "public"
}
```

### Get Media Details
Get details of a specific media file.

**Endpoint:** `GET /api/media/{id}`

**Response:**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "filename": "abbruch2.jpg",
    "url": "http://127.0.0.1:8003/storage/services/abbruch2.jpg",
    "path": "services/abbruch2.jpg",
    "size": 245678,
    "mime_type": "image/jpeg",
    "metadata": {
      "title": "Rückbaumanagement",
      "type": "service_image"
    },
    "created_at": "2025-08-24T15:00:00Z"
  }
}
```

### Delete Media File
Delete a media file from storage and database.

**Endpoint:** `DELETE /api/media/{id}`

### Bulk Delete Media
Delete multiple media files at once.

**Endpoint:** `POST /api/media/bulk-delete`

**Request Body:**
```json
{
  "ids": [1, 2, 3]
}
```

### Migrate Existing Images
Migrate existing service images to the media library.

**Endpoint:** `POST /api/media/migrate`

**Response:**
```json
{
  "success": true,
  "message": "Migrated 6 images to media table",
  "total_media": 6
}
```

## Example Usage

### Using cURL

#### Get all pages:
```bash
curl http://127.0.0.1:8003/api/content/pages
```

#### Upload an image:
```bash
curl -X POST http://127.0.0.1:8003/api/media/upload \
  -F "file=@/path/to/image.jpg" \
  -F "path=services"
```

#### Update page blocks:
```bash
curl -X PATCH http://127.0.0.1:8003/api/content/pages/home/blocks \
  -H "Content-Type: application/json" \
  -d '{"blocks": [{"type": "cholot_hero", "data": {"title": "New Title"}}]}'
```

### Using JavaScript (Fetch API)

```javascript
// Upload image
const formData = new FormData();
formData.append('file', fileInput.files[0]);
formData.append('path', 'services');

fetch('http://127.0.0.1:8003/api/media/upload', {
  method: 'POST',
  body: formData
})
.then(response => response.json())
.then(data => {
  console.log('Uploaded:', data);
  // Use data.data.id for the media ID
});

// Update page content
fetch('http://127.0.0.1:8003/api/content/pages/home', {
  method: 'PUT',
  headers: {
    'Content-Type': 'application/json'
  },
  body: JSON.stringify({
    title: 'Updated Homepage',
    blocks: [
      {
        type: 'cholot_services',
        data: {
          section_title: 'Our Services',
          services: [
            {
              title: 'Service 1',
              description: 'Description',
              image: 1, // Media ID
              link: '/service-1'
            }
          ]
        }
      }
    ]
  })
})
.then(response => response.json())
.then(data => console.log('Updated:', data));
```

### Using PHP

```php
// Upload image from URL
$client = new \GuzzleHttp\Client();
$response = $client->post('http://127.0.0.1:8003/api/media/upload-from-url', [
    'json' => [
        'url' => 'https://example.com/image.jpg',
        'filename' => 'imported-image.jpg',
        'path' => 'imports'
    ]
]);

$data = json_decode($response->getBody(), true);
$mediaId = $data['data']['id'];

// Update page with new image
$response = $client->patch('http://127.0.0.1:8003/api/content/pages/home/blocks', [
    'json' => [
        'blocks' => [
            [
                'type' => 'cholot_services',
                'data' => [
                    'services' => [
                        [
                            'title' => 'New Service',
                            'image' => $mediaId,
                            'link' => '/new-service'
                        ]
                    ]
                ]
            ]
        ]
    ]
]);
```

## Error Responses

All endpoints return consistent error responses:

```json
{
  "success": false,
  "message": "Error description"
}
```

Common HTTP status codes:
- `200` - Success
- `201` - Created
- `400` - Bad Request
- `404` - Not Found
- `422` - Validation Error
- `500` - Server Error

## Rate Limiting
Currently no rate limiting is implemented. For production, implement Laravel's built-in rate limiting.

## CORS
CORS is not configured. For production, configure CORS in `config/cors.php`.

## Notes
- Media IDs are used in content blocks instead of direct paths
- The MediaService automatically resolves IDs to URLs
- Images are served through custom routes to handle Laravel's serve limitations
- All timestamps are in ISO 8601 format
- File uploads are limited to 10MB by default