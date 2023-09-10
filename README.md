
| -----------------------------------------------------
| PROJECT NAME: 	Remote Medical Consultation System 
|                   ( RMCS ) 
| -----------------------------------------------------
| CLIENT NAME:		Julie  
| -----------------------------------------------------
| PROJECT TYPE: 	Student
| -----------------------------------------------------
| DATE: 	August 2023
| -----------------------------------------------------
| PROJECT LINK:    https://rmcs.mogahenze.com
| Admin UserName :: Admin
| Admin Password :: Admin
| -----------------------------------------------------
| DEVELOPER:		MogaHenze
|                   +256 701 243 139  
|                   +256 771 977 854
| -----------------------------------------------------
| EMAIL:			henryatubuntu@gmail.com
| -----------------------------------------------------
| COPYRIGHT BY:		mogahenze.com
| -----------------------------------------------------
| WEBSITE:			https://mogahenze.com
| -----------------------------------------------------

=================
Frame Works Used
================
    Laravel 10
    Bootstrap 5
    Jquery
    CSS / HTML5
    Javascript
    MySql

==============
Project Set Up
==============
    
    1. Controllers
        php artisan make:controller UserAuthenticationController

    2. Tables Models Controller
        Admin
            php artisan make:migration create_admin_table --create=admin_table
            php artisan make:model AdminModel -m 
            php artisan make:controller AdminController --resource
        Doctor
            php artisan make:migration create_doctor_table --create=doctor_table
            php artisan make:model DoctorModel -m (model)
            php artisan make:controller DoctorController --resource (controller)
            
        Patients
            php artisan make:migration create_patients_table --create=patients_table
            php artisan make:model PatientsModel -m (model)
            php artisan make:controller PatientsController --resource (controller)

        Services
            php artisan make:migration create_services_table --create=services_table
            php artisan make:model ServicesModel -m (model)
            php artisan make:controller ServicesController --resource (controller)
                
        Consultations
            php artisan make:migration create_consultations_table --create=consultations_table
            php artisan make:model ConsultationsModel -m (model)
            php artisan make:controller ConsultationsController --resource (controller)
		



================
Important routes
================
    Migrate db tables:
        /migrate

    Clear route cache:
        /cache-clear

    Clear config cache:
        /config-cache

    Clear application cache:
        /clear-cache

    Clear view cache:
        /view-clear

    Clear route cache:
        /route-cache

    Clear config cache:
        /config-cache

====================
Create Default Admin
====================
    In phpmyadmin in SQL run
        Select Admin table
            INSERT INTO `admin_table`(`id`, `FName`, `LName`, `Contact`, `UserName`, `PassWord`, `created_at`, `updated_at`) VALUES ('1','Admin','Admin','0000000','Admin','Admin','2023-08-31 02:37:33','2023-08-31 02:37:33')



=======
Git Hub
========
1 => git add .
2 => git commit -m 'Initial RMCS Uploads'
3 => git branch -M main
4 => git push -u origin main