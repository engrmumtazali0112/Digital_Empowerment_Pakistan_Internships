const express = require('express');
const bodyParser = require('body-parser');
const methodOverride = require('method-override');
const path = require('path');
const multer = require('multer');
const session = require('express-session');
const connectDB = require('./config/db');
const postRoutes = require('./routes/postRoutes');
const authRoutes = require('./routes/auth');
const Post = require('./models/Post');
const User = require('./models/User');

const app = express();

// Connect to MongoDB
connectDB();

// Multer setup for file uploads
const storage = multer.diskStorage({
  destination: (req, file, cb) => {
    cb(null, 'public/uploads/');
  },
  filename: (req, file, cb) => {
    cb(null, Date.now() + path.extname(file.originalname));
  }
});
const upload = multer({ storage: storage });

// Middleware
app.use(bodyParser.urlencoded({ extended: false }));
app.use(bodyParser.json());
app.use(methodOverride('_method'));
app.use(express.static(path.join(__dirname, 'public')));
app.use(session({
  secret: 'your_session_secret',
  resave: false,
  saveUninitialized: true
}));

// Set EJS as the view engine
app.set('views', path.join(__dirname, 'views'));
app.set('view engine', 'ejs');

// Authentication middleware
const authMiddleware = (req, res, next) => {
  if (!req.session.user) {
    return res.redirect('/auth/login');
  }
  next();
};

// Admin middleware
const adminMiddleware = (req, res, next) => {
  if (!req.session.user) {
    console.log('No user in session');
    return res.status(403).send('Access denied: Not logged in');
  }
  if (!req.session.user.isAdmin) {
    console.log('User is not an admin:', req.session.user);
    return res.status(403).send('Access denied: Not an admin');
  }
  next();
};

// Update user activity
const updateUserActivity = async (req, res, next) => {
  if (req.session && req.session.user) {
    try {
      await User.findByIdAndUpdate(req.session.user._id, { lastActive: new Date() });
    } catch (err) {
      console.error('Error updating user activity:', err);
    }
  }
  next();
};

// Add this middleware to your app
app.use(updateUserActivity);

// Routes
app.use('/auth', authRoutes);
app.use('/posts', authMiddleware, postRoutes);

// Root route
app.get('/', async (req, res) => {
  try {
    const posts = await Post.find().sort({ createdAt: 'desc' }).populate('author');
    res.render('index', { posts: posts, user: req.session.user });
  } catch (err) {
    console.error(err);
    res.status(500).send('Server Error');
  }
});

// About and Contact pages
app.get('/about', (req, res) => res.render('about', { user: req.session.user }));
app.get('/contact', (req, res) => res.render('contact', { user: req.session.user }));

// Dashboard route
app.get('/dashboard', authMiddleware, adminMiddleware, async (req, res) => {
  try {
    // Fetch all users and populate their posts
    const users = await User.find().populate('posts');
    // Fetch all posts
    const posts = await Post.find().sort({ createdAt: 'desc' }).populate('author');
    
    // Get active users (active in the last 15 minutes)
    const fifteenMinutesAgo = new Date(Date.now() - 15 * 60 * 1000);
    const activeUsers = users.filter(user => user.lastActive >= fifteenMinutesAgo);

    // Count users active in the last 30 days
    const thirtyDaysAgo = new Date(Date.now() - 30 * 24 * 60 * 60 * 1000);
    const activeUsersCount = await User.countDocuments({ lastActive: { $gte: thirtyDaysAgo } });

    // Render the dashboard view with the fetched data
    res.render('dashboard', { 
      users, 
      posts, 
      activeUsers, 
      activeUsersCount,
      user: req.session.user 
    });
  } catch (err) {
    console.error('Error fetching dashboard data:', err);
    res.status(500).send('Server Error');
  }
});

// Start the server
const PORT = process.env.PORT || 3000;
app.listen(PORT, () => console.log(`Server running on port ${PORT}`));
