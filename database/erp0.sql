-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2024 at 09:16 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `erp0`
--

-- --------------------------------------------------------

--
-- Table structure for table `appraisal`
--

CREATE TABLE `appraisal` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(255) NOT NULL,
  `employee_name` varchar(255) NOT NULL,
  `appraisal_date` date NOT NULL,
  `performance_score` int(11) NOT NULL,
  `comments` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appraisal`
--

INSERT INTO `appraisal` (`id`, `employee_id`, `employee_name`, `appraisal_date`, `performance_score`, `comments`) VALUES
(1, 'EMP001', 'Amit Sharma', '2024-06-01', 4, 'Updated comments.'),
(3, 'EMP003', 'Vivek Singh', '2024-06-03', 5, 'Outstanding technical skills and problem-solving abilities.'),
(4, 'EMP004', 'Sneha Desai', '2024-06-04', 4, 'Accurate financial reporting and attention to detail.'),
(5, 'EMP005', 'Arjun Kapoor', '2024-06-05', 3, 'Efficient operations management, but needs to work on communication.'),
(6, 'EMP006', 'Neha Malhotra', '2024-06-06', 4, 'Effective HR policies and employee engagement initiatives.'),
(7, 'EMP007', 'Rohan Gupta', '2024-06-07', 3, 'Good sales performance, but needs to improve client relationships.'),
(8, 'EMP008', 'Riya Chopra', '2024-06-08', 4, 'Innovative digital marketing strategies and social media campaigns.'),
(9, 'EMP009', 'Aditya Verma', '2024-06-09', 5, 'Exceptional network administration and cybersecurity expertise.'),
(10, 'EMP010', 'Nisha Reddy', '2024-06-10', 4, 'Thorough financial analysis and forecasting skills.');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `zip_code` varchar(20) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `purchase_history` text DEFAULT NULL,
  `communication_preferences` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `first_name`, `last_name`, `email`, `phone`, `address`, `city`, `state`, `zip_code`, `country`, `purchase_history`, `communication_preferences`) VALUES
(1, 'adsadf', 'abd', 'admin@admin.com', '2135678000', 'asdfas', 'adf', 'ads', '131356', 'India', 'adfasdf', 'asdfasdf'),
(3, 'arshan', 'shariff', 'admin@admin.com', '2135678000', 'asdf', 'Nagar', 'ad', '131343', 'India', 'asdf', 'asdf'),
(4, 'Rahul', 'Sharma', 'rahul.sharma@example.com', '9876543210', '12, Saket Apartments, Patel Nagar', 'New Delhi', 'Delhi', '110008', 'India', 'Product A, Product C', 'email'),
(5, 'Isha', 'Patel', 'isha.patel@example.com', '8765432109', '23/7, Kanchanjunga Apartments, Bandra', 'Mumbai', 'Maharashtra', '400050', 'India', 'Product B, Product D', 'phone'),
(6, 'Vikram', 'Singh', 'vikram.singh@example.com', '7654321098', '15/3, Rajiv Chowk, Gandhinagar', 'Gandhinagar', 'Gujarat', '382010', 'India', 'Product E, Product F', 'email'),
(7, 'Priya', 'Desai', 'priya.desai@example.com', '6543210987', '7A, Suncity Apartments, Velachery', 'Chennai', 'Tamil Nadu', '600042', 'India', 'Product G, Product H', 'phone'),
(8, 'Arjun', 'Kapoor', 'arjun.kapoor@example.com', '5432109876', '12/2, Park Street, Park Circus', 'Kolkata', 'West Bengal', '700016', 'India', 'Product I, Product J', 'email'),
(9, 'Neha', 'Malhotra', 'neha.malhotra@example.com', '4321098765', '8B, Hiranandani Gardens, Powai', 'Mumbai', 'Maharashtra', '400076', 'India', 'Product A, Product B', 'phone'),
(10, 'Rohan', 'Gupta', 'rohan.gupta@example.com', '3210987654', '3/4, Defence Colony, Indiranagar', 'Bangalore', 'Karnataka', '560038', 'India', 'Product C, Product D', 'email'),
(11, 'Riya', 'Chopra', 'riya.chopra@example.com', '2109876543', '16/7, Sector 17, Chandigarh', 'Chandigarh', 'Punjab', '160017', 'India', 'Product E, Product F', 'phone'),
(12, 'Aditya', 'Verma', 'aditya.verma@example.com', '1098765432', '25, Lakshmi Nagar, Hyderabad', 'Hyderabad', 'Telangana', '500004', 'India', 'Product G, Product H', 'email'),
(13, 'Nisha', 'Reddy', 'nisha.reddy@example.com', '9012345678', '5/6, Aundh, Pune', 'Pune', 'Maharashtra', '411007', 'India', 'Product I, Product J', 'phone');

-- --------------------------------------------------------

--
-- Table structure for table `employee_info`
--

CREATE TABLE `employee_info` (
  `id` int(11) NOT NULL,
  `employee_name` varchar(100) NOT NULL,
  `employee_id` varchar(50) NOT NULL,
  `contact_information` varchar(200) NOT NULL,
  `department` varchar(100) NOT NULL,
  `job_title` varchar(100) NOT NULL,
  `date_of_joining` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_info`
--

INSERT INTO `employee_info` (`id`, `employee_name`, `employee_id`, `contact_information`, `department`, `job_title`, `date_of_joining`, `created_at`) VALUES
(2, 'Sanjay Sharma', 'EMP002', '7799124125', 'Finance', 'Senior Financial Analyst', '2022-11-15', '2024-06-03 21:50:44'),
(3, 'Naveen Kumar', 'EMP003', '7799124126', 'Marketing', 'Senior Marketing Manager', '2022-03-01', '2024-06-03 21:50:44'),
(4, 'Asha Yadav', 'EMP004', '7799124127', 'Human Resources', 'Director of Human Resources', '2021-04-01', '2024-06-03 21:50:44'),
(5, 'Rajesh Gupta', 'EMP005', '7799124128', 'Operations', 'Operations Manager', '2020-10-01', '2024-06-03 21:50:44'),
(6, 'Mukesh Jain', 'EMP006', '7799124129', 'Information Technology', 'IT Manager', '2020-11-01', '2024-06-03 21:50:44'),
(7, 'Kavita Devi', 'EMP007', '7799124130', 'Administration', 'Administrative Assistant', '2021-01-01', '2024-06-03 21:50:44'),
(8, 'Raman Singh', 'EMP008', '7799124131', 'Accounting', 'Senior Accountant', '2022-02-01', '2024-06-03 21:50:44'),
(9, 'Meena Kumar', 'EMP009', '7799124132', 'Marketing', 'Marketing Coordinator', '2019-12-01', '2024-06-03 21:50:44');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date` date NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `name`, `amount`, `date`, `category`) VALUES
(11, 'Rent Payment', 15000.00, '2024-05-05', 'Facilities'),
(12, 'Marketing Campaign', 8000.00, '2024-05-10', 'Marketing'),
(13, 'Software Licenses', 10000.00, '2024-05-15', 'IT'),
(14, 'Travel Expenses', 3000.00, '2024-05-20', 'Business Travel'),
(15, 'Employee Training', 5000.00, '2024-05-25', 'Human Resources'),
(16, 'Raw Materials Purchase', 20000.00, '2024-05-28', 'Manufacturing'),
(17, 'Utility Bills', 4000.00, '2024-05-31', 'Facilities'),
(18, 'Professional Services', 7500.00, '2024-06-05', 'Consulting'),
(19, 'Equipment Maintenance', 3000.00, '2024-06-10', 'Operations');

-- --------------------------------------------------------

--
-- Table structure for table `payroll`
--

CREATE TABLE `payroll` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(255) NOT NULL,
  `employee_name` varchar(255) NOT NULL,
  `basic_salary` decimal(10,2) NOT NULL,
  `allowances` decimal(10,2) NOT NULL,
  `deductions` decimal(10,2) NOT NULL,
  `net_salary` decimal(10,2) NOT NULL,
  `pay_period` varchar(255) NOT NULL,
  `payment_date` date NOT NULL,
  `total_working_days` int(11) NOT NULL,
  `days_worked` int(11) NOT NULL,
  `leave_taken` int(11) NOT NULL,
  `overtime` decimal(10,2) NOT NULL,
  `performance_bonus` decimal(10,2) NOT NULL,
  `other_incentives` decimal(10,2) NOT NULL,
  `taxable_income` decimal(10,2) NOT NULL,
  `tax_deductions` decimal(10,2) NOT NULL,
  `provident_fund` decimal(10,2) NOT NULL,
  `insurance_contributions` decimal(10,2) NOT NULL,
  `bank_account_number` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `bank_branch` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payroll`
--

INSERT INTO `payroll` (`id`, `employee_id`, `employee_name`, `basic_salary`, `allowances`, `deductions`, `net_salary`, `pay_period`, `payment_date`, `total_working_days`, `days_worked`, `leave_taken`, `overtime`, `performance_bonus`, `other_incentives`, `taxable_income`, `tax_deductions`, `provident_fund`, `insurance_contributions`, `bank_account_number`, `bank_name`, `bank_branch`) VALUES
(1, 'EMP001', 'Rahul Sharma', 50000.00, 5000.00, 2000.00, 53000.00, 'June 2024', '2024-06-30', 22, 20, 2, 10.00, 2000.00, 1000.00, 55000.00, 5500.00, 2500.00, 1000.00, '1234567890', 'HDFC Bank', 'Mumbai Main'),
(2, 'EMP002', 'Fatima Khan', 45000.00, 4500.00, 1800.00, 47700.00, 'June 2024', '2024-06-30', 22, 22, 0, 5.00, 1500.00, 800.00, 49500.00, 4950.00, 2250.00, 900.00, '2345678901', 'ICICI Bank', 'Delhi Central'),
(3, 'EMP003', 'Aditya Patel', 55000.00, 5500.00, 2200.00, 58300.00, 'June 2024', '2024-06-30', 22, 21, 1, 8.00, 2500.00, 1200.00, 60500.00, 6050.00, 2750.00, 1100.00, '3456789012', 'State Bank of India', 'Bangalore East'),
(4, 'EMP004', 'Zainab Ahmed', 48000.00, 4800.00, 1920.00, 50880.00, 'June 2024', '2024-06-30', 22, 19, 3, 12.00, 1800.00, 900.00, 52800.00, 5280.00, 2400.00, 960.00, '4567890123', 'Axis Bank', 'Hyderabad West'),
(5, 'EMP005', 'Vikram Singh', 52000.00, 5200.00, 2080.00, 55120.00, 'June 2024', '2024-06-30', 22, 22, 0, 15.00, 2200.00, 1100.00, 57200.00, 5720.00, 2600.00, 1040.00, '5678901234', 'Punjab National Bank', 'Chennai North'),
(6, 'EMP006', 'Ayesha Malik', 47000.00, 4700.00, 1880.00, 49820.00, 'June 2024', '2024-06-30', 22, 20, 2, 7.00, 1700.00, 850.00, 51700.00, 5170.00, 2350.00, 940.00, '6789012345', 'Kotak Mahindra Bank', 'Kolkata South'),
(7, 'EMP007', 'Arjun Nair', 51000.00, 5100.00, 2040.00, 54060.00, 'June 2024', '2024-06-30', 22, 21, 1, 9.00, 2100.00, 1050.00, 56100.00, 5610.00, 2550.00, 1020.00, '7890123456', 'Yes Bank', 'Pune Central'),
(8, 'EMP008', 'Sana Qureshi', 46000.00, 4600.00, 1840.00, 48760.00, 'June 2024', '2024-06-30', 22, 22, 0, 6.00, 1600.00, 800.00, 50600.00, 5060.00, 2300.00, 920.00, '8901234567', 'IndusInd Bank', 'Ahmedabad East'),
(9, 'EMP009', 'Ravi Gupta', 53000.00, 5300.00, 2120.00, 56180.00, 'June 2024', '2024-06-30', 22, 18, 4, 14.00, 2300.00, 1150.00, 58300.00, 5830.00, 2650.00, 1060.00, '9012345678', 'Canara Bank', 'Jaipur West'),
(10, 'EMP010', 'Aamira Hassan', 49000.00, 4900.00, 1960.00, 51940.00, 'June 2024', '2024-06-30', 22, 21, 1, 11.00, 1900.00, 950.00, 53900.00, 5390.00, 2450.00, 980.00, '0123456789', 'Union Bank of India', 'Lucknow North');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `sku`, `category`, `description`, `price`, `stock`) VALUES
(4, 'Spice Mix...', 'SPMI001', 'Food &amp; Beverages', 'Authentic Indian spice blend', 4.99, 500),
(5, 'Silk Saree', 'SLSR002', 'Clothing & Accessories', 'Elegant handwoven silk saree', 149.99, 75),
(6, 'Copper Utensils', 'CPPU003', 'Home & Kitchen', 'Traditional Indian copper utensils set', 79.99, 200),
(7, 'Yoga Mat', 'YGMT004', 'Sports & Fitness', 'Premium quality yoga mat', 29.99, 300),
(8, 'Tea Set', 'TEST005', 'Home & Kitchen', 'Handcrafted ceramic tea set', 39.99, 120),
(9, 'Jute Bag', 'JTBG006', 'Clothing & Accessories', 'Eco-friendly jute tote bag', 12.99, 450),
(10, 'Incense Sticks', 'INSK007', 'Home & Decor', 'Fragrant incense sticks assortment', 6.99, 800),
(11, 'Cricket Bat', 'CRBT008', 'Sports & Fitness', 'Professional-grade cricket bat', 99.99, 150),
(12, 'Spice Box', 'SPBX009', 'Home & Kitchen', 'Intricately carved spice box', 24.99, 250),
(13, 'Kurta Pajama', 'KRPJ010', 'Clothing & Accessories', 'Traditional Indian kurta pajama set', 59.99, 175),
(14, 'Spice Mix', 'SPMI001', 'Food & Beverages', 'Authentic Indian spice blend', 4.99, 500),
(15, 'Silk Saree', 'SLSR002', 'Clothing & Accessories', 'Elegant handwoven silk saree', 149.99, 75),
(16, 'Copper Utensils', 'CPPU003', 'Home & Kitchen', 'Traditional Indian copper utensils set', 79.99, 200),
(17, 'Yoga Mat', 'YGMT004', 'Sports & Fitness', 'Premium quality yoga mat', 29.99, 300),
(18, 'Tea Set', 'TEST005', 'Home & Kitchen', 'Handcrafted ceramic tea set', 39.99, 120),
(19, 'Jute Bag', 'JTBG006', 'Clothing & Accessories', 'Eco-friendly jute tote bag', 12.99, 450),
(20, 'Incense Sticks', 'INSK007', 'Home & Decor', 'Fragrant incense sticks assortment', 6.99, 800),
(21, 'Cricket Bat', 'CRBT008', 'Sports & Fitness', 'Professional-grade cricket bat', 99.99, 150),
(22, 'Spice Box', 'SPBX009', 'Home & Kitchen', 'Intricately carved spice box', 24.99, 250),
(23, 'Kurta Pajama', 'KRPJ010', 'Clothing & Accessories', 'Traditional Indian kurta pajama set', 59.99, 175);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `project_id` varchar(50) NOT NULL,
  `project_name` varchar(100) NOT NULL,
  `budget` decimal(10,2) DEFAULT NULL,
  `assigned` varchar(100) DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `resources` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `project_id`, `project_name`, `budget`, `assigned`, `deadline`, `resources`) VALUES
(1, 'P001', 'Project A', 5000.00, 'John Doe', '2024-07-15', 'uploads/projectA.pdf'),
(2, 'P002', 'Project B', 8000.00, 'Jane Smith', '2024-08-20', 'uploads/projectB.pdf'),
(3, 'P003', 'Project C', 10000.00, 'Michael Brown', '2024-09-10', 'uploads/projectC.pdf'),
(4, 'P004', 'Project D', 6000.00, 'Emily Davis', '2024-07-31', 'uploads/projectD.pdf'),
(5, 'P005', 'Project E', 12000.00, 'Andrew Wilson', '2024-08-15', 'uploads/projectE.pdf'),
(6, 'P006', 'Project F', 7500.00, 'Sarah Johnson', '2024-09-25', 'uploads/projectF.pdf'),
(7, 'P007', 'Project G', 9000.00, 'David Martinez', '2024-08-05', 'uploads/projectG.pdf'),
(8, 'P008', 'Project H', 8500.00, 'Olivia Garcia', '2024-09-01', 'uploads/projectH.pdf'),
(9, 'P009', 'Project I', 11000.00, 'James Robinson', '2024-07-30', 'uploads/projectI.pdf'),
(10, 'P020', 'Project J', 7000.00, 'Emma Lopez', '2024-08-10', 'uploads/projectJ.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orders`
--

CREATE TABLE `purchase_orders` (
  `id` int(11) NOT NULL,
  `po_number` varchar(50) NOT NULL,
  `po_date` date NOT NULL,
  `vendor_name` varchar(100) NOT NULL,
  `vendor_contact` varchar(100) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `item_code` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `delivery_date` date NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `payment_terms` varchar(100) NOT NULL,
  `shipping_address` varchar(200) NOT NULL,
  `shipping_method` varchar(50) NOT NULL,
  `freight_charges` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase_orders`
--

INSERT INTO `purchase_orders` (`id`, `po_number`, `po_date`, `vendor_name`, `vendor_contact`, `item_name`, `item_code`, `quantity`, `unit_price`, `total_price`, `delivery_date`, `payment_method`, `payment_terms`, `shipping_address`, `shipping_method`, `freight_charges`, `created_at`) VALUES
(1, 'PO-001', '2024-05-01', 'Acme Suppliers', 'contact@acme.com', 'Office Chairs', 'OFC-001', 50, 75.00, 3750.00, '2024-05-15', 'Net 30', '30 days', '123 Main St, New Delhi 110001', 'Ground', 500.00, '2024-06-03 21:48:42'),
(2, 'PO-002', '2024-05-05', 'TechWorld Distributors', 'sales@techworld.com', 'Laptops', 'LT-001', 20, 1000.00, 20000.00, '2024-05-20', 'Credit Card', 'Immediate', '456 Commercial Rd, Mumbai 400001', 'Air', 1000.00, '2024-06-03 21:48:42'),
(3, 'PO-003', '2024-05-10', 'Global Textiles', 'orders@globaltextiles.com', 'Cotton Fabric', 'CF-001', 1000, 5.00, 5000.00, '2024-05-25', 'Bank Transfer', '14 days', '789 Industrial Estate, Ahmedabad 380001', 'Ground', 750.00, '2024-06-03 21:48:42');

-- --------------------------------------------------------

--
-- Table structure for table `sales_orders`
--

CREATE TABLE `sales_orders` (
  `id` int(11) NOT NULL,
  `so_number` varchar(50) NOT NULL,
  `so_date` date NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_contact` varchar(100) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `item_code` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `shipping_address` varchar(200) NOT NULL,
  `sales_tax` decimal(10,2) NOT NULL,
  `discounts` decimal(10,2) NOT NULL,
  `final_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales_orders`
--

INSERT INTO `sales_orders` (`id`, `so_number`, `so_date`, `customer_name`, `customer_contact`, `item_name`, `item_code`, `quantity`, `total_price`, `payment_method`, `shipping_address`, `sales_tax`, `discounts`, `final_price`, `created_at`) VALUES
(3, 'SO-001', '2024-05-02', 'Rahul Sharma', 'rahul.sharma@example.com', 'Spice Mix', 'SPMI001', 100, 499.00, 'Cash on Delivery', '12, Saket Apartments, Patel Nagar, New Delhi 110008', 24.95, 0.00, 573.95, '2024-06-03 21:48:42'),
(4, 'SO-002', '2024-05-07', 'Isha Patel', 'isha.patel@example.com', 'Silk Saree', 'SLSR002', 10, 1499.90, 'Credit Card', '23/7, Kanchanjunga Apartments, Bandra, Mumbai 400050', 74.99, 100.00, 1674.89, '2024-06-03 21:48:42'),
(5, 'SO-003', '2024-05-12', 'Vikram Singh', 'vikram.singh@example.com', 'Copper Utensils', 'CPPU003', 25, 1999.75, 'Bank Transfer', '15/3, Rajiv Chowk, Gandhinagar 382010', 99.99, 50.00, 2149.74, '2024-06-03 21:48:42'),
(6, 'SO-004', '2024-05-17', 'Priya Desai', 'priya.desai@example.com', 'Yoga Mat', 'YGMT004', 50, 1499.50, 'Cash on Delivery', '7A, Suncity Apartments, Velachery, Chennai 600042', 74.98, 0.00, 1649.48, '2024-06-03 21:48:42'),
(7, 'SO-006', '2024-05-27', 'Neha Malhotra', 'neha.malhotra@example.com', 'Jute Bag', 'JTBG006', 100, 1299.00, 'Cash on Delivery', '8B, Hiranandani Gardens, Powai, Mumbai 400076', 64.95, 50.00, 1388.95, '2024-06-03 21:48:42'),
(8, 'SO-007', '2024-06-01', 'Rohan Gupta', 'rohan.gupta@example.com', 'Incense Sticks', 'INSK007', 200, 1398.00, 'Bank Transfer', '3/4, Defence Colony, Indiranagar, Bangalore 560038', 69.90, 0.00, 1567.90, '2024-06-03 21:48:42'),
(9, 'SO-008', '2024-06-06', 'Riya Chopra', 'riya.chopra@example.com', 'Cricket Bat', 'CRBT008', 25, 2499.75, 'Credit Card', '16/7, Sector 17, Chandigarh 160017', 124.99, 100.00, 2774.74, '2024-06-03 21:48:42'),
(10, 'SO-009', '2024-06-11', 'Aditya Verma', 'aditya.verma@example.com', 'Spice Box', 'SPBX009', 50, 1249.50, 'Cash on Delivery', '25, Lakshmi Nagar, Hyderabad 500004', 62.48, 0.00, 1386.98, '2024-06-03 21:48:42'),
(11, 'SO-010', '2024-06-16', 'Nisha Reddy', 'nisha.reddy@example.com', 'Kurta Pajama', 'KRPJ010', 30, 1799.70, 'Credit Card', '5/6, Aundh, Pune 411007', 89.99, 50.00, 1989.69, '2024-06-03 21:48:42'),
(12, 'ioioioioio', '2024-06-14', 'df', '231213456', 'home', 'asdf', 534, 278214.00, 'sdf', 'asdf', 0.02, 5.00, 278214.02, '2024-06-12 09:37:42'),
(13, 'asdfasdfasdf', '2024-06-13', 'df', '456465', 'home', 'asdf', 32, 2334.00, 'card', 'sdfg', 43.00, 3.00, 2374.00, '2024-06-12 10:11:16');

-- --------------------------------------------------------

--
-- Table structure for table `stock_movement`
--

CREATE TABLE `stock_movement` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `movement_type` enum('inbound','outbound') NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock_movement`
--

INSERT INTO `stock_movement` (`id`, `product_id`, `quantity`, `movement_type`, `notes`, `created_at`) VALUES
(3, 1, 500, 'inbound', 'Initial stock for Spice Mix', '2024-06-03 21:48:42'),
(4, 2, 75, 'inbound', 'Initial stock for Silk Saree', '2024-06-03 21:48:42'),
(5, 3, 200, 'inbound', 'Initial stock for Copper Utensils', '2024-06-03 21:48:42'),
(6, 4, 300, 'inbound', 'Initial stock for Yoga Mat', '2024-06-03 21:48:42'),
(7, 5, 120, 'inbound', 'Initial stock for Tea Set', '2024-06-03 21:48:42'),
(8, 6, 450, 'inbound', 'Initial stock for Jute Bag', '2024-06-03 21:48:42'),
(9, 7, 800, 'inbound', 'Initial stock for Incense Sticks', '2024-06-03 21:48:42'),
(10, 8, 150, 'inbound', 'Initial stock for Cricket Bat', '2024-06-03 21:48:42'),
(11, 9, 250, 'inbound', 'Initial stock for Spice Box', '2024-06-03 21:48:42'),
(12, 10, 175, 'inbound', 'Initial stock for Kurta Pajama', '2024-06-03 21:48:42'),
(13, 1, -100, 'outbound', 'Sales order SO-001', '2024-06-03 21:48:42'),
(14, 2, -10, 'outbound', 'Sales order SO-002', '2024-06-03 21:48:42'),
(15, 3, -25, 'outbound', 'Sales order SO-003', '2024-06-03 21:48:42'),
(16, 4, -50, 'outbound', 'Sales order SO-004', '2024-06-03 21:48:42'),
(17, 5, -20, 'outbound', 'Sales order SO-005', '2024-06-03 21:48:42'),
(18, 6, -100, 'outbound', 'Sales order SO-006', '2024-06-03 21:48:42'),
(19, 7, -200, 'outbound', 'Sales order SO-007', '2024-06-03 21:48:42'),
(20, 8, -25, 'outbound', 'Sales order SO-008', '2024-06-03 21:48:42'),
(21, 9, -50, 'outbound', 'Sales order SO-009', '2024-06-03 21:48:42');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `task_number` varchar(50) NOT NULL,
  `task_name` varchar(100) NOT NULL,
  `duration` int(11) DEFAULT NULL,
  `plan_start` date DEFAULT NULL,
  `plan_end` date DEFAULT NULL,
  `assigned` varchar(100) DEFAULT NULL,
  `percent_complete` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `task_number`, `task_name`, `duration`, `plan_start`, `plan_end`, `assigned`, `percent_complete`) VALUES
(1, 'T001', 'Develop Website', 5, '2024-06-25', '2024-07-01', 'Ramesh Kumar', 20),
(2, 'T002', 'Design Logo', 3, '2024-06-26', '2024-06-29', 'Priya Sharma', 50),
(3, 'T003', 'Write Content', 7, '2024-06-28', '2024-07-05', 'Amit Patel', 30),
(4, 'T004', 'Marketing Campaign', 4, '2024-06-27', '2024-07-01', 'Deepak Singh', 10),
(5, 'T005', 'Create Prototype', 6, '2024-06-30', '2024-07-05', 'Neha Gupta', 60),
(6, 'T006', 'SEO Optimization', 3, '2024-07-01', '2024-07-04', 'Anjali Reddy', 80),
(7, 'T007', 'Client Meetings', 2, '2024-07-02', '2024-07-03', 'Rajesh Verma', 40),
(8, 'T008', 'New Research Market Trends', 5, '2024-07-03', '2024-07-08', 'Sneha Menon', 25);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(2, 'admin', '$2y$10$iKNQXq06BsTuO8S.TVu.Vu08b1X9Hhh9SL0m1LFiKacVbwUTgLMwa'),
(3, 'user1', '$2y$10$p9NXxrPqCjwj5hVc.W1ee.k8qOAOJbGn8ABV7d6Ce//z63gpui2Gy'),
(5, 'user2', '$2y$10$zyts7bqAVUbgjELHgBcIwOQAxX34/7xw7nRAwvkjT1pJPAWK3cqSq'),
(6, 'a', '$2y$10$Y6zxBr1h.64eODwlV3rinOdElVhEwZGqlcAPcc/HdlhpCQaBoALiK');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appraisal`
--
ALTER TABLE `appraisal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_info`
--
ALTER TABLE `employee_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payroll`
--
ALTER TABLE `payroll`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_orders`
--
ALTER TABLE `sales_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_movement`
--
ALTER TABLE `stock_movement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appraisal`
--
ALTER TABLE `appraisal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `employee_info`
--
ALTER TABLE `employee_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `payroll`
--
ALTER TABLE `payroll`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sales_orders`
--
ALTER TABLE `sales_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `stock_movement`
--
ALTER TABLE `stock_movement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
