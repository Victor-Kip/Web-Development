 
const express = require('express');
const mysql = require('mysql2');
const bodyParser = require('body-parser');
 
const app = express();
const con = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: 'MyOscVic2@',
  database: 'HospitalDB',
    
});

con.connect((err) => {
  if (err) {
    console.error('MySQL connection error:', err);
  } else {
    console.log('Connected to MySQL database');
  }
});

app.use(express.static(__dirname + '/public'));
app.use(express.urlencoded());
app.use(bodyParser.json());

app.get('/drugs/:type/:value', (req, res) => {
  const type = req.params.type;
  const value = req.params.value;

   
  if ( type == "id") {
    con.query("SELECT * FROM drug WHERE DrugID = ?", [value], (err, result) => {
      handleQueryResponse(err, result, res);
    });
  } else if(type == "company"){
    con.query("SELECT * FROM drug WHERE Company = ?", [value], (err, result) => {
      handleQueryResponse(err, result, res);
    });
  }
 else if(type == "category"){
  con.query("SELECT * FROM drug WHERE Formula = ?", [value], (err, result) => {
    handleQueryResponse(err, result, res);
  });
}
 else {
  console.log("Query result:", result);
  res.send(result);
}

});
 

function handleQueryResponse(err, result, res) {
  if (err) {
    console.error("Query error:", err);
    res.status(500).send("Internal Server Error");
  } else {
    console.log("Query result:", result);
    res.send(result);
  }
}

  app.get('/drugs',(req,res)=>{
    console.log(req);
    con.connect(function(err) {
      if (err) throw err;
      con.query("SELECT * FROM drug", function (err, result, fields) {
        if (err) throw err;
        res.send(result);
      });
    });
    
  });
  app.post('/drugs',(req,res)=>{
    const drugs = {
      TradeName:req.body.TradeName,Formula:req.body.Formula,Size:req.body.Size,
      Company:req.body.Company,ManufacturingDate:req.body.ManufacturingDate,
      ExpiryDate:req.body.ExpiryDate,Cost:req.body.Cost,Image:req.body.Image};
    con.connect(function(err) {
      if (err) throw err;
      console.log("Connected!");
      con.query('INSERT INTO drug SET ?',drugs,(err,result)=>{
        if (err) {
            console.error('MySQL insertion error:', err);
            res.status(500).send('Internal Server Error');
          } else {
            console.log('New drug added to the database');
            res.status(200).send('New drug added to the database');
          }
    });
    });
  })
  app.post('/register',(req,res)=>{
    const users = {
      Name:req.body.Name ,Gender:req.body.Gender,
      Email:req.body.Email,Password:req.body.Password,};
    con.connect(function(err) {
      if (err) throw err;
      console.log("Connected!");
      con.query('INSERT INTO apiuser SET ?',users,(err,result)=>{
        if (err) {
            console.error('MySQL insertion error:', err);
            res.status(500).send('Internal Server Error');
          } else {
            console.log('User added to the database');
            res.status(200).send('User added to the database');
          }
    });
    });
  })
 
  app.listen(3000,()=>{
    console.log("Server is up and running");
  });
  
  
