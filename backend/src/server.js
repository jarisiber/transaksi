import express from "express";
import dotenv from "dotenv";
import { initDB } from "./config/db.js";
import rateLimiter from "./middleware/rateLimiter.js";

import transactionsRoute from "./routes/transactionsRoute.js";
import swaggerUi from "swagger-ui-express"
import swaggerJSDoc from "swagger-jsdoc";

dotenv.config();

const app = express();
const PORT = process.env.PORT;

// START SWAGGER AND SWAGGER DEFINITION

  const swaggerOptions = {
      swaggerDefinition: {
          openapi: '3.0.0',
          info: {
              title: 'TRANSAKSI-RP',
              version: '1.0.0',
              description: 'REST API for test and doc API "Transaksi Rp" Application',
          },
          servers: [
              {
                  url: `http://localhost:${PORT}`,
                  description: 'Development server',
              },
          ],
     components: {
       securitySchemes: {
           bearerAuth: {
               type: 'http',
               scheme: 'bearer',
               bearerFormat: 'JWT', 
           },
       },
   },
      },
      apis: ['./src/routes/*.js'], // Path to your API docs
  };

  const swaggerDocs = swaggerJSDoc(swaggerOptions);
  app.use('/api-docs', swaggerUi.serve, swaggerUi.setup(swaggerDocs));

// END SWAGGER

if (process.env.NODE_ENV === "production") job.start();

// MIDDLEWARE
app.use(rateLimiter);
app.use(express.json());

// our custom simple middleware
// app.use((req, res, next) => {
//   console.log("Hey we hit a req, the method is", req.method);
//   next();
// });

app.get("/api/health", (req, res) => {
  res.status(200).json({ status: "ok" });
});

app.use("/api/transactions", transactionsRoute);

initDB().then(() => {
  app.listen(PORT, () => {
    console.log("Server is up and running on PORT:", PORT);
  });
});