const mongoose = require('mongoose');
const Schema = mongoose.Schema;

const PostSchema = new Schema({
  title: String,
  content: String,
  image: String,
  author: {
    type: Schema.Types.ObjectId,
    ref: 'User' // Reference to the User model
  },
  createdAt: {
    type: Date,
    default: Date.now
  }
});

module.exports = mongoose.model('Post', PostSchema);
