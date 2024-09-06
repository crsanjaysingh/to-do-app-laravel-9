# To-Do App This is a simple To-Do application built using Laravel, Vue.js, and Inertia.js. It allows users to create, manage, and mark tasks as completed. 

## Table of Contents 
- [Installation](#installation) 
- [Environment Setup](#environment-setup) 
- [Running the Application](#running-the-application) 
- [Features](#features) 
- [License](#license) 

## Installation Follow these steps to install and set up the project locally: 
### 1. Clone the Repository First, clone this GitLab repository to your local machine:
 `bash git clone https://gitlab.com/your-username/todo-app.git cd todo-app ` 
 ### 2. Install Dependencies Make sure you have [Composer](https://getcomposer.org/) and [Node.js](https://nodejs.org/) installed. 
     1. Install PHP dependencies: `bash composer install ` 
     2. Install JavaScript dependencies: `bash npm install ` 
### 3. Environment Setup 
   1. Copy the `.env.example` file to `.env`: `bash cp .env.example .env ` 
   2. Generate the application key: `bash php artisan key:generate ` 
   3. Configure the `.env` file with your database details. Set the following values in the `.env` file: `bash DB_CONNECTION=mysql DB_HOST=127.0.0.1 DB_PORT=3306 DB_DATABASE=your_database_name DB_USERNAME=your_database_user DB_PASSWORD=your_database_password ` 
   4. Run the database migrations: `bash php artisan migrate ` 
   
### 4. Build Assets You need to compile the front-end assets using the following command: 
`bash npm run build ` For local development, you can use: 
`bash npm run dev ` 

### 5. Running the Application Start the development server using: `bash php artisan serve ` By default, the app will be accessible at `http://localhost:8000`. 

## Features - Create, update, and delete tasks - Mark tasks as finished or pending - Filter tasks based on their status ## License This project is open-source and licensed under the [MIT License](LICENSE).
