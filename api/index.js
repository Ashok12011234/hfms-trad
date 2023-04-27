const express=require('express')
const bodyParser =require('body-parser');
const cors=require('cors')
const app=express()
const mysql=require('mysql2')
const axios = require("axios");
const path = require('path');

const db=mysql.createConnection({
    host: 'db',
    user: 'user',
    password: 'pass',
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





app.get('/requests', (req, res) => {
  if (req.headers.hasOwnProperty('x-forwarded-access-token')) {
    //can use this token to validate with Idp using introception end-point
    //const token = req.headers['forwarded-access-token'];
    const sqlSelect = "SELECT * FROM hhrequest WHERE HospitalId=1";
    db.query(sqlSelect, (err, result) => {
      if (err) {
        console.log(err);
        res.status(500).send(err);
      } else {
        res.send(result);
        console.log(req.headers);
      }
    });
  } else {
    res.status(401).send("Unauthorized");
  }
});




app.listen(3002,()=>{

    console.log('running on port 3002');
})