const mongoose = require('mongoose');

// MongoDB Connection
const connectDB = async () => {
  try {
    await mongoose.connect('mongodb://localhost/blog_website');  // No need for deprecated options
    console.log('MongoDB connected');
  } catch (err) {
    console.error('MongoDB connection error:', err);
    process.exit(1); // Exit process with failure
  }
};

module.exports = connectDB;
