import ratelimiter from "../config/upstash.js";

const rateLimiterMiddleware = async (req, res, next) => {
    try {
        // Using a fixed key for demonstration; in production, consider using user-specific keys
        // e.g., based on IP address or user ID
        const { success } = await ratelimiter.limit("Limiter-saya")
        if (!success) {
            return res.status(429).json({ 
                message: "Too many requests, please try again later." })
        }
        next()
    } catch (error) {
        console.log("Rate limite error", errpr)
        next(error)
    }
}
export default rateLimiterMiddleware;