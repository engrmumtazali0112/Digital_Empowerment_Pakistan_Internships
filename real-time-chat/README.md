# Real-Time Chat Application

This project is a **real-time chat application** developed using the **Django** framework and **React.js** for the frontend. It features WebSocket-based communication with **Django Channels** and provides real-time messaging in various chat rooms. Admins can manage chat rooms and users can participate in live conversations. 

[Live Demo](#) | [Project Repository](https://github.com/engrmumtazali0112/Digital_Empowerment_Pakistan_Internships/tree/main/real-time-chat)

## Features

- Real-time communication using WebSockets (Django Channels)
- Multiple chat rooms where users can join and leave
- Online users list for each room
- Admin capabilities for room management (adding/deleting rooms)
- Scrollable message history that updates as new messages are received
- User authentication and role management (admin, normal user)
- Responsive user interface built with **React** and **Tailwind CSS**
- Notification of user activities such as joining or leaving a room

## Technologies Used

- **Backend:**
  - Django Framework
  - Django Channels for WebSocket-based real-time messaging
  - Python 3.x
  - Django REST Framework for handling API requests
  - SQLite (default) for database, but can be switched to PostgreSQL or MySQL
- **Frontend:**
  - React.js for user interface
  - Tailwind CSS for styling
  - WebSocket API for real-time interaction between clients and server
- **Deployment:**
  - Webpack for bundling React code
  - ASGI for handling WebSocket connections
  - Nginx/Gunicorn for production deployment (optional)

## Installation and Setup

### Requirements
- Python 3.x
- Node.js & npm (for React frontend)
- Django 4.x or higher
- Django Channels 3.x
- Webpack (for bundling React files)

### Backend Setup

1. Clone the repository:

   git clone https://github.com/engrmumtazali0112/Digital_Empowerment_Pakistan_Internships.git
   cd Digital_Empowerment_Pakistan_Internships/real-time-chat
Create a virtual environment:


python -m venv venv
source venv/bin/activate  # On Windows: venv\Scripts\activate
Install backend dependencies:


pip install -r requirements.txt
Set up Django Channels in your settings.py:


INSTALLED_APPS = [
    'channels',
    'your_app_name',
]

ASGI_APPLICATION = 'your_project_name.asgi.application'
CHANNEL_LAYERS = {
    'default': {
        'BACKEND': 'channels.layers.InMemoryChannelLayer',
    },
}
Run migrations to set up the database:


python manage.py migrate
Create a superuser for admin access:


python manage.py createsuperuser
Run the development server:


python manage.py runserver
Frontend Setup
Navigate to the frontend directory:


cd frontend
Install the required frontend dependencies:


npm install
Build the frontend files using Webpack:


npm run build