# Invosa Systems Online Test Solutions - by Jabbar Ali Panggabean

Welcome to the solution repository for the Invosa Systems Online Test. This project was developed by **Jabbar Ali Panggabean** to demonstrate problem-solving abilities and full-stack web development skills using Laravel, Vite, and Tailwind CSS.

**➡️ Live Demo: [https://invosa.jabbar.id/](https://invosa.jabbar.id/)**

## Introduction

This project contains implementations of solutions for a series of programming challenges presented in the Invosa Systems Online Test (2017 version). Each solution is designed to be functional, efficient, and presented through a clean, responsive user interface.

The primary objectives of this project are to showcase:
- Analytical skills in understanding and solving diverse problem types.
- Proficiency in backend development with PHP and the Laravel framework.
- Competence in modern frontend development using Vite and Tailwind CSS.
- Application of good coding practices and an organized project structure.
- Attention to detail and user experience (UX).

## Key Features (Solved Problems)

This project includes interactive web-based solutions for the following problems:

### 🏠 Landing Page
An engaging and informative introductory page that provides an overview of the project, highlights the developer's (Jabbar Ali Panggabean) profile, and relevant skills.

### 📋 Problems Index
A central navigation page to access all implemented solutions, categorized by difficulty level.

### BASIC LEVEL
1.  **Bank Interest (Problem 1)**
    * 1.1 Calculates savings account balance with monthly compound interest using a loop/recursion.
    * 1.2 Calculates savings account balance using a direct formula (without loop/recursion).
2.  **Tiered Discount (Problem 2)**
    * Calculates the final price after a series of tiered discounts input by the user.
3.  **Encoding/Decoding (Problem 3)**
    * Implements a specific ASCII character encoding algorithm based on a defined mapping rule, without using conditional structures (`if`, `switch`).

### INTERMEDIATE LEVEL
4.  **Roman to Arabic Numeral Conversion (Problem 4)**
    * Converts Roman numerals (case-insensitive, max 3999) to their Arabic numeral representation.
5.  **Shortest Path Problem (Problem 5)**
    * Finds the shortest path (minimum sum) from the top to the base of a number triangle with flexible dimensions and user-input values. Implemented using an Object-Oriented approach and Dynamic Programming.
6.  **Area Under Sin Curve (Problem 6)**
    * Calculates the area under a sine curve between two angles (input in degrees) using numerical integration (Trapezoidal Rule) with a user-defined number of segments for precision.
        The results are scaled by $180/\pi$ to match the PDF's example outputs.

### ADVANCED LEVEL
7.  **Marble Count Prediction (Problem 7)**
    * Predicts the final count of yellow and blue marbles in a box as they are drawn one by one. The user inputs the total number of marbles and the color of each drawn marble sequentially. The prediction updates after each draw.
8.  **Lift Control Optimization (Problem 8)**
    * Optimizes the assignment of 4 people (with specific start floors and directions) to 3 lifts (with initial positions) to minimize the total accumulated waiting time. This is solved by evaluating all possible valid assignments and calculating time for each.

## Technology Stack

This project is built using a modern web development stack:

* **Backend:** PHP 8.x, Laravel 10.x
* **Frontend:**
    * HTML5, CSS3, JavaScript (ES6+)
    * Vite (Next-generation frontend tooling)
    * Tailwind CSS (Utility-first CSS framework)
    * Blade (Laravel's templating engine)
* **Development Environment:**
    * Composer (PHP dependency manager)
    * NPM/Yarn (JavaScript package manager)
* **Key Concepts Demonstrated:**
    * MVC (Model-View-Controller) architecture
    * RESTful routing
    * Object-Oriented Programming (OOP)
    * Dynamic Programming (Problem 5)
    * Numerical Integration (Problem 6)
    * Combinatorial Optimization (Problem 8)
    * Session Management (Problem 7)
    * Responsive Web Design
    * Clean Code principles

## Setup and Installation

To run this project locally, follow these steps:

1.  **Clone the Repository:**
    ```bash
    git clone [https://github.com/jabbar-app/invosa.git](https://github.com/jabbar-app/invosa.git)
    cd invosa
    ```

2.  **Install PHP Dependencies:**
    ```bash
    composer install
    ```

3.  **Install JavaScript Dependencies:**
    ```bash
    npm install
    # or
    yarn install
    ```

4.  **Environment Configuration:**
    * Copy the `.env.example` file to `.env`:
        ```bash
        cp .env.example .env
        ```
    * Generate an application key:
        ```bash
        php artisan key:generate
        ```
    * Configure your database connection in the `.env` file if needed (though most problems here don't require a database).

5.  **Build Frontend Assets:**
    * For development (with hot-reloading):
        ```bash
        npm run dev
        # or
        yarn dev
        ```
    * For production:
        ```bash
        npm run build
        # or
        yarn build
        ```

6.  **Run the Development Server:**
    * In one terminal, keep the Vite dev server running (if in development):
        ```bash
        npm run dev
        ```
    * In another terminal, start the Laravel development server:
        ```bash
        php artisan serve
        ```
    The application will typically be available at `http://127.0.0.1:8000`.

## How to Use

1.  **Access the Live Demo:** [https://invosa.jabbar.id/](https://invosa.jabbar.id/)
2.  Alternatively, to run locally, navigate to the application's root URL (e.g., `http://127.0.0.1:8000`) after setup.
3.  You will be greeted by a landing page introducing the project and the developer.
4.  Click on the "Explore Solutions" or "View All Problem Solutions" button to navigate to the Problems Index page.
5.  From the Problems Index, select any solved problem to view its interactive solution.
6.  Follow the on-screen instructions for each problem to input data and see the results.

## Developer

This project was developed by:

**Jabbar Ali Panggabean**
* Senior Software Engineer with 7+ years of experience in full-stack product development.
* Specializing in TypeScript, React.js, Node.js, PHP, and Laravel.
* Proven track record in building scalable, production-grade applications.
* Experienced with modern web architecture, clean code, performance optimization, CI/CD, Docker, and cloud platforms (GCP/AWS).
* Portfolio: [link.jabbar.id](http://link.jabbar.id/)
* Email: [box@jabbar.id](mailto:box@jabbar.id)

## Purpose

This application serves as a comprehensive response to the Invosa Systems Online Test. It aims to demonstrate not only the ability to arrive at correct solutions but also to implement them within a well-structured, maintainable, and user-friendly web application.

Thank you for reviewing this project.
