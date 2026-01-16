-- Active: 1768468455063@@127.0.0.1@5432@smart_wallet_02
CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE categories (
    id SERIAL PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    type VARCHAR(20) CHECK (type IN ('income', 'expense')),
    user_id INTEGER REFERENCES users(id) ON DELETE CASCADE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE incomes (
    id SERIAL PRIMARY KEY,
    amount DECIMAL(10,2) NOT NULL,
    description TEXT,
    category_id INTEGER REFERENCES categories(id),
    user_id INTEGER REFERENCES users(id) ON DELETE CASCADE,
    income_date DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE expenses (
    id SERIAL PRIMARY KEY,
    amount DECIMAL(10,2) NOT NULL,
    description TEXT,
    category_id INTEGER REFERENCES categories(id),
    user_id INTEGER REFERENCES users(id) ON DELETE CASCADE,
    expense_date DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
ALTER TABLE categories
ADD COLUMN monthly_limit DECIMAL(10,2);
