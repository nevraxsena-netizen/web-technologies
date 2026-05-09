import express from "express";
import dotenv from "dotenv";
import cors from "cors";
import { db_initialize_create } from "./db.js";
import itemRoutes from "./routes/items.js";
import authRoutes from "./routes/auth.js";

dotenv.config();

const app = express();
app.use(cors());
app.use(express.json());

const port = process.env.PORT || 3000;
// const jwtSecret = process.env.JWT_SECRET;

app.use("/items", itemRoutes);
app.use("/auth", authRoutes);

app.get("/health", (req, res) => res.json({ status: "ok" }));

app.listen(port, () => {
  console.log(`Server running on port ${port}`);
  // console.log(`JWT secret: ${jwtSecret}`);
});

db_initialize_create().then(() => {
  console.log("DB initialized and tables created");
});