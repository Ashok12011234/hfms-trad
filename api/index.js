const express=require('express')
const bodyParser =require('body-parser');
const cors=require('cors')
const app=express()
const mysql=require('mysql')
const axios = require("axios");
const path = require('path');

const db=mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: 'password',
    database: 'hfms',
    port:'3306'
  })

  // Connect to the database
db.connect((err) => {
  if (err) {
      console.log('Error connecting to database:', err);
      return;
  }
  console.log('Database connection successful');
});

app.use(cors());
app.use(express.json());
app.use(bodyParser.urlencoded({extended:true}));





app.get('/api/requests', (req, res) => {
  if (req.headers.authorization) {
    const sqlSelect = "SELECT * FROM HHrequest WHERE HospitalId=1";
    db.query(sqlSelect, (err, result) => {
      if (err) {
        console.log(err);
        res.status(500).send("An error occurred while fetching product details.");
      } else {
        res.send(result);
      }
    });
  } else {
    res.status(401).send("Unauthorized");
  }
});




app.listen(3002,()=>{

    console.log('running on port 3002');
})