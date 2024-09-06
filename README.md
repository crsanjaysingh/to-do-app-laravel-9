# To-Do App 

This is a simple To-Do application built using Laravel, Vue.js, and Inertia.js. It allows users to create, manage, and mark tasks as completed. 

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
     1. Install PHP dependencies: 
       composer install
     2. Install JavaScript dependencies: 
       npm install
### 3. Environment Setup 
   1. Copy the .env.example file to .env: cp .env.example .env
   2. Generate the application key: php artisan key:generate
   3. Configure the .env file with your database details.
   4. Set the following values in the `.env` file:

   #### Set Vite URL
   VITE_API_URL=http://127.0.0.1:8000 
   
   #### Mysql
   DB_CONNECTION=mysql 
   
   DB_HOST=127.0.0.1
   
   DB_PORT=3306
   
   DB_DATABASE=your_database_name
   
   DB_USERNAME=your_database_user
   
   DB_PASSWORD=your_database_password
   
### 4. Build Assets You need to compile the front-end assets using the following command: 
npm run build  
For local development, you can use: 
npm run dev

### 5. Running the Application 
Start the development server using:  
Run the database migrations: php artisan migrate or php artisan migrate --seed to seed data or php artisan migrate:fresh --seed for if tables exists
php artisan serve 
By default, the app will be accessible at `http://localhost:8000`. Please use 8000 port or update the vite url if you use another port in.env  

## Features 
- Create, update, and delete tasks
- Mark tasks as finished or pending
- Filter tasks based on their status
  
## License 
This project is open-source and licensed under the [MIT License](LICENSE).
