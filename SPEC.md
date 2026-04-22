# Furniture Shop eCommerce - Specification Document

## 1. Project Overview

**Project Name:** Royal Furniture Shop  
**Project Type:** Full-Stack eCommerce Web Application  
**Core Functionality:** A luxury furniture e-commerce platform with user shopping features and full admin management capabilities  
**Target Users:** Furniture shoppers (customers) and store administrators

---

## 2. Technology Stack

| Component | Technology |
|-----------|-------------|
| Backend | Laravel 12 (MVC) |
| Database | MySQL |
| Frontend | Blade Templates + Bootstrap 5 |
| Authentication | Laravel Breeze |
| Image Storage | Local disk (storage/app/public) |
| API | REST API |

---

## 3. UI/UX Specification

### 3.1 Design Theme: Royal & Classic

**Color Palette:**
- Primary: `#8B4513` (Saddle Brown - Royal Wood)
- Secondary: `#D4A574` (Golden Tan)
- Accent: `#C9A227` (Royal Gold)
- Dark Background: `#1A1A1A` (Admin Dark Theme)
- Light Background: `#FAF8F5` (Cream White)
- Text Dark: `#2C2C2C`
- Text Light: `#F5F5F5`
- Success: `#2E7D32`
- Danger: `#C62828`
- Info: `#1565C0`

**Typography:**
- Headings: 'Playfair Display', serif (classic royal feel)
- Body: 'Lato', sans-serif
- Font Sizes: H1: 2.5rem, H2: 2rem, H3: 1.5rem, Body: 1rem

**Spacing:**
- Base unit: 8px
- Section padding: 60px vertical
- Card padding: 20px

### 3.2 Responsive Breakpoints
- Mobile: < 576px
- Tablet: 576px - 991px
- Desktop: ≥ 992px

---

## 4. Database Schema

### 4.1 Tables

#### users
| Column | Type | Description |
|--------|------|-------------|
| id | BIGINT (PK) | Auto-increment |
| name | VARCHAR(255) | User full name |
| email | VARCHAR(255) | Unique email |
| password | VARCHAR(255) | Hashed password |
| is_admin | TINYINT | 0=User, 1=Admin |
| phone | VARCHAR(20) | Optional phone |
| address | TEXT | Optional address |
| email_verified_at | TIMESTAMP | Verified timestamp |
| created_at | TIMESTAMP | Created_at |
| updated_at | TIMESTAMP | Updated_at |

#### categories
| Column | Type | Description |
|--------|------|-------------|
| id | BIGINT (PK) | Auto-increment |
| name | VARCHAR(255) | Category name |
| slug | VARCHAR(255) | URL slug |
| description | TEXT | Category description |
| image | VARCHAR(255) | Category image |
| status | TINYINT | 1=Active, 0=Inactive |
| created_at | TIMESTAMP | Created_at |
| updated_at | TIMESTAMP | Updated_at |

#### products
| Column | Type | Description |
|--------|------|-------------|
| id | BIGINT (PK) | Auto-increment |
| category_id | BIGINT (FK) | References categories |
| name | VARCHAR(255) | Product name |
| slug | VARCHAR(255) | URL slug |
| description | TEXT | Product description |
| price | DECIMAL(10,2) | Product price |
| quantity | INT | Stock quantity |
| status | TINYINT | 1=Active, 0=Inactive |
| featured | TINYINT | 1=Featured |
| created_at | TIMESTAMP | Created_at |
| updated_at | TIMESTAMP | Updated_at |

#### product_images
| Column | Type | Description |
|--------|------|-------------|
| id | BIGINT (PK) | Auto-increment |
| product_id | BIGINT (FK) | References products |
| image | VARCHAR(255) | Image filename |
| created_at | TIMESTAMP | Created_at |

#### carts
| Column | Type | Description |
|--------|------|-------------|
| id | BIGINT (PK) | Auto-increment |
| user_id | BIGINT (FK) | References users |
| product_id | BIGINT (FK) | References products |
| quantity | INT | Quantity |
| created_at | TIMESTAMP | Created_at |
| updated_at | TIMESTAMP | Updated_at |

#### orders
| Column | Type | Description |
|--------|------|-------------|
| id | BIGINT (PK) | Auto-increment |
| user_id | BIGINT (FK) | References users |
| order_number | VARCHAR(50) | Unique order number |
| total | DECIMAL(10,2) | Order total |
| status | VARCHAR(50) | pending/processing/completed/cancelled |
| name | VARCHAR(255) | Shipping name |
| email | VARCHAR(255) | Shipping email |
| phone | VARCHAR(20) | Shipping phone |
| address | TEXT | Shipping address |
| created_at | TIMESTAMP | Created_at |
| updated_at | TIMESTAMP | Updated_at |

#### order_items
| Column | Type | Description |
|--------|------|-------------|
| id | BIGINT (PK) | Auto-increment |
| order_id | BIGINT (FK) | References orders |
| product_id | BIGINT (FK) | References products |
| product_name | VARCHAR(255) | Snapshot name |
| price | DECIMAL(10,2) | Snapshot price |
| quantity | INT | Quantity |
| created_at | TIMESTAMP | Created_at |

---

## 5. Feature Specification

### 5.1 Frontend Features

#### Home Page
- Hero section with featured products carousel
- Category showcase grid
- Featured products section (6 products)
- About section with royal design
- Footer with contact info

#### Product Listing Page
- Grid layout (3 columns desktop, 2 tablet, 1 mobile)
- Category filter sidebar
- Sort by price/name
- Search functionality
- Pagination

#### Product Detail Page
- Image gallery with thumbnails
- Product name, price, description
- Quantity selector
- Add to cart button
- Related products

#### Cart Page
- Table with product details
- Quantity update buttons
- Remove item functionality
- Cart total display
- Checkout button

#### Checkout Page
- Order summary
- Shipping information form
- Place order button
- Success message

### 5.2 Admin Panel

#### Dashboard
- Total products count
- Total orders count
- Total revenue
- Recent orders table

#### Product Management
- List all products
- Create new product
- Edit product details
- Upload multiple images
- Delete product
- Manage status/featured

#### Category Management
- List all categories
- Create/Edit/Delete categories
- Category image upload
- Status toggle

#### Order Management
- List all orders
- View order details
- Update order status
- Order item details

---

## 6. API Endpoints

### Products API
| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | /api/products | List all products |
| GET | /api/products/{id} | Get single product |
| GET | /api/products/featured | Get featured products |
| GET | /api/categories | List categories |

### Cart API
| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | /api/cart | Get user cart |
| POST | /api/cart/add | Add to cart |
| PUT | /api/cart/update/{id} | Update cart item |
| DELETE | /api/cart/remove/{id} | Remove cart item |

---

## 7. Acceptance Criteria

### Must Have
- [ ] Project runs without errors
- [ ] All CRUD operations work
- [ ] Image upload works for products
- [ ] Add to cart functionality works
- [ ] Checkout creates orders
- [ ] Admin panel fully functional
- [ ] Dark theme admin UI
- [ ] Responsive design
- [ ] REST API endpoints return JSON

### Visual Checkpoints
- [ ] Royal/classic color scheme applied
- [ ] Bootstrap 5 components used
- [ ] Professional typography
- [ ] Clean spacing
- [ ] No broken links

---

## 8. Project Structure

```
Laravel_Eco/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── FrontendController.php
│   │   │   ├── AdminController.php
│   │   │   ├── CartController.php
│   │   │   ├── OrderController.php
│   │   │   └── ApiController.php
│   │   └── Requests/
│   ├── Models/
│   │   ├── User.php
│   │   ├── Product.php
│   │   ├── Category.php
│   │   ├── Cart.php
│   │   ├── Order.php
│   │   └── OrderItem.php
│   └── Providers/
��── database/
│   └── migrations/
├── public/
│   ├── css/
│   ├── js/
│   └── images/
├── resources/
│   ├── views/
│   │   ├── frontend/
│   │   ├── admin/
│   │   ├── components/
│   │   └── layouts/
├── routes/
│   ├── web.php
│   └── api.php
├── storage/
│   └── app/
│       └── public/
└── tests/
```