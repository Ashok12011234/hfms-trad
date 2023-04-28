const express=require('express')
const bodyParser =require('body-parser');
const cors=require('cors')
const app=express()
const mysql=require('mysql2')
const axios = require("axios");
const path = require('path');
const retry = require('retry');


app.use(cors());
app.use(express.json());
app.use(bodyParser.urlencoded({extended:true}));





app.get('/requests', (req, res) => {
  if (req.headers.hasOwnProperty('x-forwarded-access-token')) {
    //can use this token to validate with Idp using introception end-point
    //const token = req.headers['forwarded-access-token'];

    // Set up database connection options
    const connectionOptions = {
      host: 'db',
      user: 'user',
      password: 'pass',
      database: 'hfms',
      port: '3306'
    };

    // Create a function to connect to the database
    const connectToDatabase = (callback) => {
      const db = mysql.createConnection(connectionOptions);
      db.connect((err) => {
        if (err) {
          console.log('Error connecting to database:', err);
          db.end();
          callback(err);
        } else {
          console.log('Database connection successful');
          callback(null, db);
        }
      });
    };

    // Set up retry options
    const operation = retry.operation({
      retries: 10, // Number of times to retry
      factor: 1, // Factor to multiply the retry delay by (exponential backoff)
      minTimeout: 1000, // Minimum delay between retries in milliseconds
      maxTimeout: 3000 // Maximum delay between retries in milliseconds
    });
  
    // Call the connectToDatabase function with retry
    operation.attempt((currentAttempt) => {
      console.log(`Attempt ${currentAttempt} to connect to database...`);
      connectToDatabase((err, db) => {
        
        if (operation.retry(err)) {
          console.log(`Error connecting to database on attempt ${currentAttempt}. Retrying...`);
          return;
        }
        if (err) {
          console.log(`Failed to connect to database after ${currentAttempt} attempts. Error: ${err}`);
          return;
        }
        console.log(`Connected to database on attempt ${currentAttempt}`);
        const sqlSelect = "SELECT * FROM hhrequest WHERE HospitalId=1";
        db.query(sqlSelect, (err, result) => {
          if (err) {
            console.log(err);
            res.status(500).send(err);
          } else {
            res.send(result);
          }
          });
    });

    
    });
  } else {
    res.status(401).send("Unauthorized");
  }
});




app.listen(3002,()=>{

    console.log('running on port 3002');
})