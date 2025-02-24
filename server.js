const express = require('express');
const axios = require('axios');
const app = express();
const PORT = process.env.PORT || 3000;

app.get('/ping', async (req, res) => {
  try {
    const response = await axios.get('https://your-website-url.com');
    if (response.status === 200) {
      res.json({ success: true, message: 'Website is up.' });
    } else {
      res.json({ success: false, message: 'Website is down.' });
    }
  } catch (error) {
    res.json({ success: false, message: 'Error connecting to website.' });
  }
});

app.listen(PORT, () => console.log(`Server running on port ${PORT}`));
