// routes/adminRoutes.js
const express = require('express');
const router = express.Router();
const User = require('../models/User');
const Post = require('../models/Post');

// Admin Dashboard Route
router.get('/dashboard', async (req, res) => {
  try {
    // Fetch all users and populate their posts
    const users = await User.find().populate('posts');
    // Fetch all posts
    const posts = await Post.find().populate('author');
    
    // Count active users (example: users with posts or any other condition)
    const activeUsers = users.filter(user => user.posts.length > 0).length;

    // Render the dashboard view with the fetched data
    res.render('dashboard', { users, posts, activeUsers, user: req.session.user });
  } catch (err) {
    console.error(err);
    res.status(500).send('Server Error');
  }
});

module.exports = router;
