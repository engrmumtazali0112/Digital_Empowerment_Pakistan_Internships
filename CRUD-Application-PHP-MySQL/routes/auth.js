const express = require('express');
const bcrypt = require('bcryptjs');
const User = require('../models/User');  // Assuming you have a User model set up
const router = express.Router();

// Register Route (GET)
router.get('/register', (req, res) => {
    res.render('register');
});

// Register Route (POST)
router.post('/register', async (req, res) => {
    const { username, password } = req.body;
    try {
        const existingUser = await User.findOne({ username });
        if (existingUser) {
            return res.render('register', { error: 'User already exists' });
        }

        const hashedPassword = await bcrypt.hash(password, 10);
        const newUser = new User({ username, password: hashedPassword });

        await newUser.save();
        req.session.user = newUser;
        res.redirect('/');
    } catch (err) {
        console.error(err);
        res.status(500).send('Server Error');
    }
});

// Login Route (GET)
router.get('/login', (req, res) => {
    res.render('login');
});

// auth.js (Login Route)
router.post('/login', async (req, res) => {
    const { username, password } = req.body;
    try {
      const user = await User.findOne({ username });
      if (!user) {
        return res.render('login', { error: 'Invalid credentials' });
      }
  
      const isMatch = await bcrypt.compare(password, user.password);
      if (!isMatch) {
        return res.render('login', { error: 'Invalid credentials' });
      }
  
      req.session.user = user; // Store user information in session
      res.redirect('/');
    } catch (err) {
      console.error(err);
      res.status(500).send('Server Error');
    }
  });
  
// Logout Route
router.get('/logout', (req, res) => {
    req.session.destroy();
    res.redirect('/auth/login');
});

module.exports = router;
