import express from "express";
import {
  createTransaction,
  deleteTransaction,
  getSummaryByUserId,
  getTransactionsByUserId,
} from "../controllers/transactionsController.js";

const router = express.Router();

/**
 * @swagger
 * /api/transactions/{userId}:
 *   get:
 *     summary: Get all transactions for a user
 *     tags:
 *       - Transactions
 *     parameters:
 *       - in: path
 *         name: userId
 *         schema:
 *           type: string
 *         required: true
 *         description: The user ID
 *         example: user_356Hee4twzOUq0ddFMXMxhUG0If
 *     responses:
 *       200:
 *         description: List of transactions retrieved successfully
 *       404:
 *         description: User not found
 */
router.get("/:userId", getTransactionsByUserId);

/**
 * @swagger
 * /api/transactions:
 *   post:
 *     summary: Create a new transaction
 *     tags:
 *       - Transactions
 *     requestBody:
 *       required: true
 *       content:
 *         application/json:
 *           schema:
 *             type: object
 *             properties:
 *               userId:
 *                 type: string
 *               amount:
 *                 type: number
 *               description:
 *                 type: string
 *             required:
 *               - userId
 *               - amount
 *     responses:
 *       201:
 *         description: Transaction created successfully
 *       400:
 *         description: Invalid input
 */
router.post("/", createTransaction);

/**
 * @swagger
 * /api/transactions/{id}:
 *   delete:
 *     summary: Delete a transaction
 *     tags:
 *       - Transactions
 *     parameters:
 *       - in: path
 *         name: id
 *         schema:
 *           type: string
 *         required: true
 *         description: The transaction ID
 *     responses:
 *       200:
 *         description: Transaction deleted successfully
 *       404:
 *         description: Transaction not found
 */
router.delete("/:id", deleteTransaction);

/**
 * @swagger
 * /api/transactions/summary/{userId}:
 *   get:
 *     summary: Get transaction summary for a user
 *     tags:
 *       - Transactions
 *     parameters:
 *       - in: path
 *         name: userId
 *         schema:
 *           type: string
 *         required: true
 *         description: The user ID
 *     responses:
 *       200:
 *         description: Transaction summary retrieved successfully
 *       404:
 *         description: User not found
 */
router.get("/summary/:userId", getSummaryByUserId);

export default router;