# 🎓 StudyBud: Interactive Learning Platform

A dynamic, full-stack web application built with Django, facilitating interactive learning and collaboration.

![GitHub last commit](https://img.shields.io/github/last-commit/yourusername/studybud)
![GitHub issues](https://img.shields.io/github/issues/yourusername/studybud)
![GitHub stars](https://img.shields.io/github/stars/yourusername/studybud)
![GitHub forks](https://img.shields.io/github/forks/yourusername/studybud)
![GitHub license](https://img.shields.io/github/license/yourusername/studybud)

## 📋 Table of Contents
- [Key Features](#key-features)
- [Tech Stack](#tech-stack)
- [Project Structure](#project-structure)
- [Installation](#installation)
- [Usage](#usage)
- [API Endpoints](#api-endpoints)
- [Contributing](#contributing)
- [License](#license)
- [Contact](#contact)

## 🚀 Key Features

- 🔐 User authentication (register/login/logout)
- 🏠 Dynamic home page with room listings and activity feed
- 🚪 Create, update, and delete study rooms
- 💬 Real-time messaging in study rooms
- 👤 User profiles with activity history
- 🔍 Search functionality for rooms and topics
- 👑 Admin dashboard for managing users and content

## 🛠️ Tech Stack

![Python](https://img.shields.io/badge/Python-3776AB?style=for-the-badge&logo=python&logoColor=white)
![Django](https://img.shields.io/badge/Django-092E20?style=for-the-badge&logo=django&logoColor=white)
![SQLite](https://img.shields.io/badge/SQLite-07405E?style=for-the-badge&logo=sqlite&logoColor=white)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)

## 📸 Screenshots

<details>
<summary>Click to view screenshots</summary>

![Room](https://github.com/user-attachments/assets/bd5456d2-a277-48e2-b940-67316669de7e)
![Project Structure](https://github.com/user-attachments/assets/7651d09a-6b15-4dfd-a125-d7172194e8c5)
![Room Chat](https://github.com/user-attachments/assets/b1149ce0-d9c6-4892-b44d-0003fdd929a5)

</details>


## 📁 Project Structure

```
studybud/
│
├── base/
│   ├── migrations/
│   ├── templates/
│   │   └── base/
│   │       ├── activity.html
│   │       ├── create-room.html
│   │       ├── delete.html
│   │       ├── edit-user.html
│   │       ├── home.html
│   │       ├── login.html
│   │       ├── profile.html
│   │       ├── room.html
│   │       ├── room_form.html
│   │       └── topics.html
│   ├── admin.py
│   ├── apps.py
│   ├── forms.py
│   ├── models.py
│   ├── tests.py
│   ├── urls.py
│   └── views.py
│
├── studybud/
│   ├── __init__.py
│   ├── asgi.py
│   ├── settings.py
│   ├── urls.py
│   └── wsgi.py
│
├── static/
│   ├── images/
│   ├── styles/
│   └── js/
│
├── templates/
│   └── main.html
│
├── manage.py
├── db.sqlite3
├── requirements.txt
└── README.md
```

## 💻 Installation

1. Clone the repository:
   ```sh
   git clone  https://github.com/engrmumtazali0112/Digital_Empowerment_Pakistan_Internships/tree/main/real-time-chat

   ```

2. Navigate to the project directory:
   ```sh
   cd studybud
   ```

3. Create a virtual environment:
   ```sh
   python -m venv venv
   ```

4. Activate the virtual environment:
   - On Windows:
     ```sh
     venv\Scripts\activate
     ```
   - On macOS and Linux:
     ```sh
     source venv/bin/activate
     ```

5. Install dependencies:
   ```sh
   pip install -r requirements.txt
   ```

6. Apply migrations:
   ```sh
   python manage.py migrate
   ```

7. Create a superuser:
   ```sh
   python manage.py createsuperuser
   ```

## 🚀 Usage

1. Start the development server:
   ```sh
   python manage.py runserver
   ```

2. Open your browser and navigate to `http://localhost:8000`

3. To access the admin panel, go to `http://localhost:8000/admin` and log in with your superuser credentials.

## 🔗 API Endpoints

- `GET /`: Home page
- `GET /login/`: User login
- `GET /logout/`: User logout
- `GET /register/`: User registration
- `GET /room/<str:pk>/`: View a specific room
- `GET /profile/<str:pk>/`: View user profile
- `GET /create-room/`: Create a new room
- `GET /update-room/<str:pk>/`: Update a room
- `GET /delete-room/<str:pk>/`: Delete a room
- `GET /delete-message/<str:pk>/`: Delete a message
- `GET /update-user/`: Update user profile
- `GET /topics/`: View all topics
- `GET /activity/`: View recent activity

## 🤝 Contributing

Contributions are what make the open-source community such an amazing place to learn, inspire, and create. Any contributions you make are **greatly appreciated**.

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📄 License

Distributed under the MIT License. See `LICENSE` for more information.

## 📞 Contact

Mumtaz Ali - [engrmumtazali01@gmail.com](mailto:engrmumtazali01@gmail.com)

Project Link: https://github.com/engrmumtazali0112/Digital_Empowerment_Pakistan_Internships/tree/main/blog-website-node.js-express-mongodb
<p align="center">
  <a href="mailto:engrmumtazali01@gmail.com"><img src="https://img.shields.io/badge/Email-D14836?style=for-the-badge&logo=gmail&logoColor=white"/></a>
  <a href="https://www.linkedin.com/in/mumtazali12/"><img src="https://img.shields.io/badge/LinkedIn-0077B5?style=for-the-badge&logo=linkedin&logoColor=white"/></a>
  <a href="https://www.instagram.com/its_maliyzi?igsh=MWR1Y2x1a2xpazBpOA=="><img src="https://img.shields.io/badge/Instagram-E4405F?style=for-the-badge&logo=instagram&logoColor=white"/></a>
  <a href="https://www.hackerrank.com/profile/engrmumtazali01"><img src="https://img.shields.io/badge/-Hackerrank-2EC866?style=for-the-badge&logo=HackerRank&logoColor=white"/></a>
  <a href="https://github.com/engrmumtazali0112"><img src="https://img.shields.io/badge/GitHub-100000?style=for-the-badge&logo=github&logoColor=white"/></a>
</p>

---

<p align="center">Made with ❤️ by Mumtaz Ali</p>
