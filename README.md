# 🚗 Rental Service API

A **Laravel-based Rental Service API** that allows **Customers** to request rentals, **Partners** to place bids, and enables a streamlined process for booking and managing rides with real-time status updates.

## 🛠 Features

- Customers can create **rental requests**.
- Partners can **place bids** on active requests.
- Customers can **accept a bid**, finalizing the booking.
- Ride status updates dynamically based on actions.
- **Authentication & Authorization** for secure access.
- **RESTful API** for seamless integration with frontend applications.
- **MySQL Database** for efficient data storage.

## 🚀 Installation & Setup

### Prerequisites
- PHP 8.0+
- Composer
- MySQL
- Laravel 10+
- Node.js & npm (for frontend integration, if needed)

### Step 1: Clone the Repository
```bash
 git clone https://github.com/your-username/rental-service-api.git
 cd rental-service-api
```

### Step 2: Install Dependencies
```bash
composer install
npm install  # (if frontend assets exist)
```

### Step 3: Configure Environment Variables
- Copy `.env.example` to `.env`
```bash
cp .env.example .env
```
- Update database credentials in `.env`:
```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rental_service
DB_USERNAME=root
DB_PASSWORD=yourpassword
```

### Step 4: Generate Application Key
```bash
php artisan key:generate
```

### Step 5: Run Migrations & Seed Data
```bash
php artisan migrate --seed
```

### Step 6: Start the Development Server
```bash
php artisan serve
```
Your API will now be running at: **http://127.0.0.1:8000**

## 📖 API Endpoints

### Customer Actions
- `POST /api/bookings` → Create a rental request
- `GET /api/bookings` → List all rental requests

### Partner Actions
- `POST /api/bids` → Place a bid on a request
- `GET /api/bids` → View all placed bids

### Booking Management
- `PATCH /api/bookings/{id}/accept-bid` → Customer accepts a bid
- `GET /api/bookings/{id}/status` → Get current ride status

## 🛡 Authentication
- Uses **Laravel Sanctum** for API authentication.
- Users must authenticate before accessing **protected routes**.

## 🤝 Contributing
1. Fork the repository
2. Create a new branch (`feature/your-feature`)
3. Commit your changes (`git commit -m 'Add some feature'`)
4. Push to the branch (`git push origin feature/your-feature`)
5. Create a new Pull Request

## 📄 License
This project is open-source and available under the [MIT License](LICENSE).
