# 🌟 Modern Blog Website

A dynamic, full-stack blog website built with Node.js, Express, and MongoDB.

![GitHub last commit](https://img.shields.io/github/last-commit/yourusername/blog-website)
![GitHub issues](https://img.shields.io/github/issues/yourusername/blog-website)
![GitHub stars](https://img.shields.io/github/stars/yourusername/blog-website)
![GitHub forks](https://img.shields.io/github/forks/yourusername/blog-website)
![GitHub license](https://img.shields.io/github/license/yourusername/blog-website)

## 📋 Table of Contents
- [Key Features](#key-features)
- [Tech Stack](#tech-stack)
- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Project Structure](#project-structure)
- [API Endpoints](#api-endpoints)
- [Screenshots](#screenshots)
- [Contributing](#contributing)
- [License](#license)
- [Contact](#contact)

## 🚀 Key Features

- 🔐 User authentication (register/login)
- ✏️ Create, read, update, and delete blog posts
- 🖼️ Image upload for blog posts
- 📱 Responsive design for mobile and desktop
- 🖥️ Server-side rendering with EJS templates
- 🔄 RESTful API architecture
- 👑 Admin dashboard for managing users and posts

## 🛠️ Tech Stack

![Node.js](https://img.shields.io/badge/Node.js-339933?style=for-the-badge&logo=nodedotjs&logoColor=white)
![Express.js](https://img.shields.io/badge/Express.js-000000?style=for-the-badge&logo=express&logoColor=white)
![MongoDB](https://img.shields.io/badge/MongoDB-4EA94B?style=for-the-badge&logo=mongodb&logoColor=white)
![Passport](https://img.shields.io/badge/Passport-34E27A?style=for-the-badge&logo=passport&logoColor=white)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-323330?style=for-the-badge&logo=javascript&logoColor=F7DF1E)

## 📚 Prerequisites

Before you begin, ensure you have met the following requirements:
* [Node.js](https://nodejs.org/) (v14.0.0 or later)
* [npm](https://www.npmjs.com/) (v6.0.0 or later)
* [MongoDB](https://www.mongodb.com/) (v4.0 or later)
* A text editor like [VS Code](https://code.visualstudio.com/) or [Atom](https://atom.io/)

## 💻 Installation

To set up and run this project locally, follow these steps:

1. Clone the repository:
   ```sh
   git clone https://github.com/yourusername/blog-website.git
   ```

2. Navigate to the project directory:
   ```sh
   cd blog-website
   ```

3. Install dependencies:
   ```sh
   npm install
   ```

4. Set up environment variables:
   Create a `.env` file in the root directory and add the following:
   ```
   MONGODB_URI=your_mongodb_connection_string
   SESSION_SECRET=your_session_secret
   ```

5. Start the server:
   ```sh
   npm start
   ```

6. Open your browser and navigate to `http://localhost:3000`

## 📁 Project Structure

```
│
├── config/
│   └── db.js
│
├── models/
│   ├── Post.js
│   └── User.js
│
├── public/
│   ├── css/
│   ├── js/
│   └── uploads/
│
├── routes/
│   ├── auth.js
│   └── postRoutes.js
│
├── views/
│   ├── partials/
│   │   ├── header.ejs
│   │   └── footer.ejs
│   ├── about.ejs
│   ├── contact.ejs
│   ├── create-edit-post.ejs
│   ├── dashboard.ejs
│   ├── index.ejs
│   ├── layout.ejs
│   ├── login.ejs
│   ├── posts.ejs
│   ├── register.ejs
│   └── show.ejs
│
├── .gitignore
├── app.js
├── package.json
└── README.md
```

## 🔗 API Endpoints

- `GET /`: Home page
- `GET /posts`: View all posts
- `GET /posts/:id`: View a specific post
- `POST /posts`: Create a new post (authentication required)
- `PUT /posts/:id`: Update a post (authentication required)
- `DELETE /posts/:id`: Delete a post (authentication required)
- `GET /dashboard`: Admin dashboard (admin authentication required)

## 📸 Screenshots

<details>
<summary>Click to view screenshots</summary>

![Screenshot 1](https://github.com/user-attachments/assets/b0516a13-937a-488d-a97c-0b8358cd3a03)
![Screenshot 2](https://github.com/user-attachments/assets/b0c26401-5a09-42c3-b4e8-f5165f3e641c)
![Screenshot 3](https://github.com/user-attachments/assets/6a711cd9-5be7-4f03-92c5-0342923936be)
![Screenshot 4](https://github.com/user-attachments/assets/b5a464ff-6417-4628-b8d5-2e4a45174552)
![Screenshot 5](https://github.com/user-attachments/assets/086d9c0a-e763-4382-8688-9d456d00e57f)
![Screenshot 6](https://github.com/user-attachments/assets/f0ac6a2d-021e-4f1e-87ce-e224d9f1cb13)
![Screenshot 7](https://github.com/user-attachments/assets/642b4868-f3d6-4d3c-b2a5-7de8b36444a8)
![Screenshot 8](https://github.com/user-attachments/assets/e6a1d128-589f-4163-8f51-993b8339e88b)
![Screenshot 9](https://github.com/user-attachments/assets/3af8f3b4-b2b9-4c88-8f28-5ecc7eef90c3)

</details>

## 🤝 Contributing

Contributions are what make the open-source community such an amazing place to learn, inspire, and create. Any contributions you make are **greatly appreciated**.

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📄 License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details.

## 📞 Contact

Mumtaz Ali - [engrmumtazali01@gmail.com](mailto:engrmumtazali01@gmail.com)

Project Link: [https://github.com/yourusername/blog-website](https://github.com/yourusername/blog-website)

<p align="center">
  <a href="mailto:engrmumtazali01@gmail.com"><img src="https://img.shields.io/badge/Email-D14836?style=for-the-badge&logo=gmail&logoColor=white"/></a>
  <a href="https://www.linkedin.com/in/mumtazali12/"><img src="https://img.shields.io/badge/LinkedIn-0077B5?style=for-the-badge&logo=linkedin&logoColor=white"/></a>
  <a href="https://www.instagram.com/its_maliyzi?igsh=MWR1Y2x1a2xpazBpOA=="><img src="https://img.shields.io/badge/Instagram-E4405F?style=for-the-badge&logo=instagram&logoColor=white"/></a>
  <a href="https://www.hackerrank.com/profile/engrmumtazali01"><img src="https://img.shields.io/badge/-Hackerrank-2EC866?style=for-the-badge&logo=HackerRank&logoColor=white"/></a>
  <a href="https://github.com/engrmumtazali0112"><img src="https://img.shields.io/badge/GitHub-100000?style=for-the-badge&logo=github&logoColor=white"/></a>
</p>

---

<p align="center">Made with ❤️ by Mumtaz Ali</p>
