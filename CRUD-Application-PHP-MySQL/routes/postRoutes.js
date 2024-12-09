const express = require('express');
const router = express.Router();
const Post = require('../models/Post');
const User = require('../models/User');
const fs = require('fs');
const path = require('path');
const multer = require('multer');
const methodOverride = require('method-override');

// Multer setup for file uploads
const storage = multer.diskStorage({
  destination: (req, file, cb) => {
    cb(null, path.join(__dirname, '../public/uploads/'));
  },
  filename: (req, file, cb) => {
    cb(null, Date.now() + path.extname(file.originalname));
  }
});
const upload = multer({ storage: storage });

// Use method override middleware
router.use(methodOverride('_method'));

// Get all posts
router.get('/', async (req, res) => {
  try {
    const posts = await Post.find().sort({ createdAt: 'desc' }).populate('author');
    res.render('posts', { posts, user: req.session.user });
  } catch (err) {
    console.error(err);
    res.status(500).send('Server Error');
  }
});

// Create new post form
router.get('/new', (req, res) => {
  res.render('create-edit-post', { action: 'Create', post: null, formAction: '/posts', user: req.session.user });
});

// Create new post
router.post('/', upload.single('image'), async (req, res) => {
  try {
    const { title, content } = req.body;
    const newPost = new Post({
      title,
      content,
      author: req.session.user._id,
      image: req.file ? req.file.filename : null
    });
    await newPost.save();
    res.redirect('/posts');
  } catch (err) {
    console.error(err);
    res.status(500).send('Server Error');
  }
});

// View single post
router.get('/:id', async (req, res) => {
  try {
    const post = await Post.findById(req.params.id).populate('author');
    if (!post) {
      return res.status(404).send('Post not found');
    }
    res.render('show', { post, user: req.session.user });
  } catch (err) {
    console.error(err);
    res.status(500).send('Server Error');
  }
});

// Edit post form
router.get('/:id/edit', async (req, res) => {
  try {
    const post = await Post.findById(req.params.id);
    if (!post) {
      return res.status(404).send('Post not found');
    }
    res.render('create-edit-post', { action: 'Edit', post, formAction: `/posts/${post._id}?_method=PUT`, user: req.session.user });
  } catch (err) {
    console.error(err);
    res.status(500).send('Server Error');
  }
});

// Update post
router.put('/:id', upload.single('image'), async (req, res) => {
  try {
    const { title, content, deleteImage } = req.body;
    const post = await Post.findById(req.params.id);
    if (!post) {
      return res.status(404).send('Post not found');
    }
    post.title = title;
    post.content = content;

    if (req.file) {
      if (post.image) {
        fs.unlink(path.join(__dirname, '../public/uploads/', post.image), (err) => {
          if (err) console.error(err);
        });
      }
      post.image = req.file.filename;
    } else if (deleteImage === 'true') {
      if (post.image) {
        fs.unlink(path.join(__dirname, '../public/uploads/', post.image), (err) => {
          if (err) console.error(err);
        });
      }
      post.image = null;
    }

    await post.save();
    res.redirect(`/posts/${post._id}`);
  } catch (err) {
    console.error(err);
    res.status(500).send('Server Error');
  }
});

// Admin Dashboard Route
router.get('/dashboard', async (req, res) => {
  try {
    // Fetch all users
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


// Delete post
router.delete('/:id', async (req, res) => {
  try {
    const post = await Post.findById(req.params.id);
    if (!post) {
      return res.status(404).send('Post not found');
    }
    if (post.image) {
      fs.unlink(path.join(__dirname, '../public/uploads/', post.image), (err) => {
        if (err) console.error(err);
      });
    }
    await Post.findByIdAndDelete(req.params.id);
    res.redirect('/posts');
  } catch (err) {
    console.error(err);
    res.status(500).send('Server Error');
  }
});

module.exports = router;