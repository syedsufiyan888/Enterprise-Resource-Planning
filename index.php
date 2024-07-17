<?php
session_start();
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enterprise Resource Planning</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
        }

        header {
            background: linear-gradient(135deg, #3498db, #2c3e50);
            color: white;
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            width: 100%;
            z-index: 1000;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
        }

        nav ul {
            display: flex;
            list-style: none;
        }

        nav ul li {
            margin-left: 1rem;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
        }

        .cta-buttons {
            display: flex;
            gap: 1rem;
        }

        .btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .login-btn {
            background-color: #e74c3c;
            color: white;
        }

        .login-btn:hover {
            background-color: #c0392b;
        }

        .demo-btn {
            background-color: #2ecc71;
            color: white;
        }

        .demo-btn:hover {
            background-color: #27ae60;
        }

        .hero {
            position: relative;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            overflow: hidden;
        }

        .hero::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('res/dash.png');
            background-size: cover;
            background-position: center;
            filter: blur(3px);
            opacity: 0.7;
            z-index: -1;
        }

        .hero-content {
    background-color: rgba(0, 0, 0, 0.75);
    padding: 2rem;
    border-radius: 10px;
    z-index: 1;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
}

        .hero h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
        }

        .detailed-features {
            padding: 4rem 2rem;
        }

        .feature-detail {
            display: flex;
            align-items: center;
            margin-bottom: 4rem;
        }

        .feature-detail:nth-child(even) {
            flex-direction: row-reverse;
        }

        .feature-text {
            flex: 1;
            padding: 2rem;
        }

        .feature-text h3 {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: #3498db;
        }

        .feature-text p {
            font-size: 1.1rem;
            line-height: 1.6;
        }

        .feature-image {
            flex: 1;
            padding: 2rem;
        }

        .feature-image img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .testimonials {
            background-color: #f9f9f9;
            padding: 4rem 2rem;
            text-align: center;
        }

        .testimonial-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .testimonial {
            background-color: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .about {
            padding: 4rem 2rem;
            background-color: #34495e;
            color: white;
            text-align: center;
        }

        .about h2 {
            margin-bottom: 2rem;
        }

        footer {
            background-color: #2c3e50;
            color: white;
            text-align: center;
            padding: 1rem;
        }

        @media (max-width: 768px) {
            .feature-detail {
                flex-direction: column;
            }

            .feature-detail:nth-child(even) {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">Enterprise Resource Planning</div>
        <nav>
            <ul>
                <li><a href="#features">Features</a></li>
                <li><a href="#testimonials">Testimonials</a></li>
                <li><a href="#about">About</a></li>
            </ul>
        </nav>
        <div class="cta-buttons">
            <a href="dash.php"><button class="btn login-btn">Login</button></a>
            
        </div>
    </header>

    <section class="hero">
        <div class="hero-content">
            <h1>Streamline Your Business with Our ERP Solution</h1>
            <p>Integrate, automate, and optimize your business processes with our comprehensive ERP system.</p>
            <a href="#features"><button class="btn demo-btn">Explore Features</button></a>
        </div>
    </section>

    <section id="features" class="detailed-features">
        <div class="feature-detail">
            <div class="feature-text">
                <h3>Planning</h3>
                <p>Our advanced Planning module is designed to help you strategize and execute your business goals with precision. This module is further divided into Task and Project sub-modules to provide detailed management capabilities. Features include:</p>
                <ul>
                    <li>Task assignment and tracking for efficient workload management</li>
                    <li>Project scheduling with milestones and deadlines</li>
                    <li>Resource allocation and optimization tools</li>
                    <li>Scenario planning and forecasting capabilities</li>
                    <li>Real-time collaboration and communication tools</li>
                    <li>Progress monitoring </li>
                </ul>
            </div>
            <div class="feature-image">
                <img src="res/plan.jpg" alt="Planning Module Interface">
            </div>
        </div>

        <div class="feature-detail">
            <div class="feature-text">
                <h3>Finance & Accounting</h3>
               <p>The Finance & Accounting module offers a comprehensive suite for managing your financial operations, including:</p>
                <ul>
                    <li>Sales tracking and revenue management</li>
                    <li>Purchase order processing and vendor management</li>
                    <li>Expense tracking and cost management</li>
                    <li>Financial reporting and analysis</li>
                </ul>
            </div>
            <div class="feature-image">
                <img src="res/fin.jpg" alt="Finance Dashboard">
            </div>
        </div>

        <div class="feature-detail">
            <div class="feature-text">
                <h3>Human Resource</h3>
                <p>Our Human Resource module streamlines employee management with sub-modules for:</p>
                <ul>
                    <li>Employee information and records management</li>
                    <li>Payroll processing and compensation management</li>
                    <li>Performance appraisal and career development tracking</li>
                </ul>
            </div>
            <div class="feature-image">
                <img src="res/hr.jpg" alt="HR Management Interface">
            </div>
        </div>

        <div class="feature-detail">
            <div class="feature-text">
                <h3>Product & Inventory</h3>
                <p>The Product & Inventory module ensures effective management of your products and stock levels, featuring:</p>
                <ul>
                    <li>Detailed product information management</li>
                    <li>Real-time stock level tracking and alerts</li>
                    <li>Inventory control and replenishment planning</li>
                </ul>
            </div>
            <div class="feature-image">
                <img src="res/inven.jpg" alt="Inventory Management System">
            </div>
        </div>

        <div class="feature-detail">
            <div class="feature-text">
                <h3>CRM</h3>
                <p>Customer Relationship Management (CRM) module helps you manage and enhance your customer interactions, offering:</p>
                <ul>
                    <li>Customer data and relationship management</li>
                    <li>Sales pipeline tracking and lead management</li>
                    <li>Customer service and support management</li>
                </ul>
            </div>
            <div class="feature-image">
                <img src="res/crm.jpg" alt="CRM Dashboard">
            </div>
        </div>

        <div class="feature-detail">
            <div class="feature-text">
                <h3>Sales Invoicing</h3>
                <p>The Sales Invoicing module facilitates seamless invoicing processes, including:</p>
                <ul>
                    <li>Automated sales invoice generation</li>
                    <li>Invoice tracking and payment management</li>
                    <li>Integration with sales and finance data</li>
                </ul>
            </div>
            <div class="feature-image">
                <img src="res/sale.jpg" alt="Sales Invoicing Interface">
            </div>
        </div>

        <div class="feature-detail">
            <div class="feature-text">
                <h3>Reports</h3>
                <p>The Reports module provides comprehensive insights through:</p>
                <ul>
                    <li>Detailed sales reports with performance metrics</li>
                    <li>Inventory reports highlighting stock status and turnover</li>
                    <li>Customizable reports for various business needs</li>
                </ul>
            </div>
            <div class="feature-image">
                <img src="res/report.png" alt="Reports Dashboard">
            </div>
        </div>
    </section>

    <section id="testimonials" class="testimonials">
        <h2>What Our Clients Say</h2>
        <div class="testimonial-grid">
            <div class="testimonial">
                <p>"This ERP system has transformed our business operations. We've seen a 30% increase in efficiency since implementation."</p>
                <p><strong>- John Doe, CEO of TechCorp</strong></p>
            </div>
            <div class="testimonial">
                <p>"The customer support team is exceptional. They've been incredibly helpful throughout our onboarding process."</p>
                <p><strong>- Jane Smith, COO of InnovateNow</strong></p>
            </div>
            <div class="testimonial">
                <p>"We've cut our inventory costs by 25% thanks to the real-time tracking and analytics provided by this ERP solution."</p>
                <p><strong>- Mike Johnson, Supply Chain Manager at GlobalTrade</strong></p>
            </div>
        </div>
    </section>

    <section id="about" class="about">
        <h2>About Us</h2>
        <p>We are dedicated to providing top-notch ERP solutions to businesses of all sizes. Our comprehensive system helps you manage all aspects of your operation, from planning to reporting, in one integrated platform. With years of experience and a commitment to innovation, we strive to empower businesses to reach their full potential through efficient resource management and data-driven decision-making.</p>
    </section>

    <footer>
        <p>&copy; 2024 Enterprise Resource Planning. All rights reserved.</p>
    </footer>
</body>
</html>