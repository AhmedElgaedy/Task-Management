# Laravel Task Management API

This is a Laravel-based API for managing tasks with features like task creation, updating, deleting, user assignment, and notification management. It also includes user authentication using Laravel Sanctum.

## Features
- Task Management: Create, update, delete, and retrieve tasks.
- User Assignment: Assign tasks to users by email.
- Notifications: Notify users about tasks due within the next 24 hours.
- Authentication: Use Laravel Sanctum for user authentication.
- Task Filtering: Filter tasks by status or due date range.
- Overdue Tasks: Mark tasks as overdue.
- Comprehensive API documentation.

## Installation

### 1. Clone the repository
```bash
git clone https://github.com/your-username/task-manager.git
cd task-manager
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan db:seed


API Documentation
Authentication
POST /api/login
Description: Logs in a user and returns an authentication token.
Request:

{
  "email": "user@example.com",
  "password": "your_password"
}



Response:
{
  "token": "your_generated_token"
}




POST /api/logout
Description: Logs out the authenticated user by deleting their token.
Response:
json
Copy code
{
  "message": "Logged out successfully."
}
Task Management
GET /api/tasks
Description: Fetch all tasks, with optional filtering by status or due date range.
Query Parameters:
status: Filter by task status (pending, in_progress, completed).
start_date, end_date: Filter by due date range.
Response:
{
  "data": [
    {
      "id": 1,
      "title": "Task Title",
      "due_date": "2024-12-01T00:00:00",
      "status": "pending",
      "assigned_user": {
        "id": 2,
        "name": "User Name",
        "email": "user@example.com"
      },
      "created_at": "2024-11-20T00:00:00",
      "updated_at": "2024-11-20T00:00:00"
    }
  ]
}
POST /api/tasks
Description: Create a new task.
Request:
json
Copy code
{
  "title": "Task Title",
  "description": "Task Description",
  "due_date": "2024-12-01T00:00:00",
  "status": "pending",
  "user_id": 2
}
Response:
json
Copy code
{
  "id": 1,
  "title": "Task Title",
  "due_date": "2024-12-01T00:00:00",
  "status": "pending",
  "assigned_user": {
    "id": 2,
    "name": "User Name",
    "email": "user@example.com"
  }
}
GET /api/tasks/{id}
Description: Get a specific task by its ID.
PUT /api/tasks/{id}
Description: Update an existing task.
DELETE /api/tasks/{id}
Description: Delete a task.
GET /api/user-tasks/{email}
Description: Fetch tasks assigned to a specific user by email.
Notification Management
GET /api/notifications
Description: Get all notifications for the authenticated user.
Response:
{
  "data": [
    {
      "id": 1,
      "type": "TaskDueNotification",
      "notifiable_type": "App\Models\User",
      "notifiable_id": 2,
      "data": {"message": "You have a task due soon!"},
      "read_at": null
    }
  ]
}




POST /api/notifications/{id}/mark-as-read
Description: Mark a specific notification as read.
Response:

{
  "message": "Notification marked as read."
}
POST /api/notifications/mark-all-as-read
Description: Mark all notifications as read.
Response:
json
Copy code
{
  "message": "All notifications marked as read."
}
