const express = require("express");
const mysql = require("mysql2");
const cors = require("cors");

const app = express();

app.use(cors());
app.use(express.json());
app.use(express.urlencoded({ extended: true }));

// ================= MYSQL =================
const db = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "",
  database: "gym_ems"
});

db.connect(err => {
  if (err) console.log("DB ERROR:", err);
  else console.log("MySQL Connected");
});

// ================= PROFILE SAVE =================
app.post("/save-profile", (req, res) => {
  console.log("REQ BODY:", req.body);

  const { name, email, role } = req.body;

  const sql = "INSERT INTO profile (id, name, email, role) VALUES (1, ?, ?, ?)";

  db.query(sql, [name, email, role], (err, result) => {
    if (err) {
      console.log("ERROR:", err);
      return res.status(500).send(err.message);
    }

    console.log("INSERT OK");
    res.send("Saved!");
  });
});

// ================= SYSTEM SAVE =================
app.post("/save-system", (req, res) => {
  const { refresh, sensitivity, speed, temp, load } = req.body;

  const sql = `
    INSERT INTO settings (id, refresh_rate, sensitivity, speed, temp, load_capacity)
    VALUES (1, ?, ?, ?, ?, ?)
    ON DUPLICATE KEY UPDATE
    refresh_rate = VALUES(refresh_rate),
    sensitivity = VALUES(sensitivity),
    speed = VALUES(speed),
    temp = VALUES(temp),
    load_capacity = VALUES(load_capacity)
  `;

  db.query(sql, [refresh, sensitivity, speed, temp, load], (err) => {
    if (err) {
      console.log("MYSQL ERROR:", err);
      return res.status(500).send(err.message);
    }
    res.send("System saved!");
  });
});

// ================= LOAD PROFILE =================
app.get("/profile", (req, res) => {
  db.query("SELECT * FROM profile WHERE id=1", (err, result) => {
    if (err) return res.json({});
    res.json(result[0] || {});
  });
});

// ================= LOAD SETTINGS =================
app.get("/settings", (req, res) => {
  db.query("SELECT * FROM settings WHERE id=1", (err, result) => {
    if (err) return res.json({});
    res.json(result[0] || {});
  });
});

// ================= SERVER =================
app.listen(3000, () => {
  console.log("Server running on http://localhost:3000");
});