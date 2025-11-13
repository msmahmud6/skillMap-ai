# skillMap‑AI  
An AI‑powered recruitment mapping platform built with PHP, HTML, CSS and JavaScript, aimed at streamlining the screening and job‑matching process which perform SDG-8 goals.

## Table of Contents  
- [About](#about)  
- [Features](#features)  
- [Architecture & Tech Stack](#architecture--tech‑stack)  
- [Getting Started](#getting‑started)  
  - [Prerequisites](#prerequisites)  
  - [Installation](#installation)  
  - [Database Setup](#database‑setup)  
- [Usage](#usage)  
  - [Authentication & Dashboard](#authentication‑&‑dashboard)  
  - [Core Modules](#core‑modules)  
- [Configuration](#configuration)  
- [Folder Structure](#folder‑structure)  
- [Contributing](#contributing)   
- [Future Roadmap](#future‑roadmap)  

## About  
skillMap‑AI is a recruitment tooling system that helps organisations manage job listings, candidate profiles and automated screening/matching — saving time in frontline hiring and improving alignment between candidate skills and job requirements.  
Built by the contributors: @msmahmud6, @SMEK2020, and @Md‑Hasibul‑Hasan.  

## Features  
- Admin login and user management.  
- Job listings creation and management.  
- Candidate profile capture (skills, experience, education).  
- Automated matching engine (AI/logic placeholder) to map candidates to jobs.  
- Dashboard for analytics and status tracking.  
- Responsive UI built with CSS and JavaScript for seamless experience.  

## Architecture & Tech Stack  
- **Backend**: PHP  — core app logic, routing.  
- **Frontend**: HTML5, CSS3, JavaScript.  
- **Database**: MySQL (SQL schema provided: `skillmap.sql`).  
- **Folder Modules**:  
  - `db/` — database connection and schema files  
  - `includes/` — shared PHP includes (header, footer, utilities)  
  - `jobs/`, `courses/`, `profile/` etc — functional modules  
  - `css/`, `js/`, `img/` — static assets  

## Getting Started  

### Prerequisites  
- PHP 7.4+ (or PHP 8.x)  
- MySQL 5.7+ or MariaDB equivalent  
- Web server (Apache, Nginx) configured with document root pointing to project folder  
- Composer (optional if dependencies are used)  

### Installation  
1. Clone the repository  
   ```bash  
   git clone https://github.com/msmahmud6/skillMap‑ai.git  
   cd skillMap‑ai  
   ```  
2. Copy or rename `db/skillmap.sql` into your MySQL environment (see next section).  
3. Configure database credentials in `includes/db_connect.php`.  
4. Ensure your web server’s document root is set to the project base (so that `index.php` loads).  
5. Access the application via your browser: `http://localhost/skillMap‑ai`  

### Database Setup  
- Import the SQL schema:  
  ```sql  
  mysql ‑u username ‑p databasename < db/skillmap.sql  
  ```  
- The `skillmap.sql` includes tables for `admins`, `users`, `jobs`, `candidates`, `skills`, etc.  
- After import, seed an user manually (or via UI if implemented) to start using the dashboard.  

## Usage  

### Authentication & Dashboard  
- Login as an user → redirected to dashboard.  
- Dashboard gives high‑level stats: jobs, resources, match stats.  
- Manage your profile easily.  

### Core Modules  
- **Jobs**: Create, edit, delete job postings; list required skills, experience level, location.  
- **Candidates**: Manage candidate profiles, upload CV (if supported), tag skills/education/experience.  
- **Matching**: Use the built‑in logic (or future AI module) to match candidates to jobs based on skill overlap, experience, etc.  
- **Reports/Analytics**: View metrics such as number of matches, job status, candidate activity.  

## Configuration  
- Database connection: `includes/db_connect.php`  
- Site settings: Possibly in `includes/config.php`  
- Static asset paths: Adjust in `base.php` if needed when deployed into a sub‑directory  
- Error and debug mode: For production, disable display errors and log to file  

## Folder Structure  
```
skillMap‑ai/  
│  
├─ css/  
├─ js/  
├─ img/  
├─ db/  
│   └─ skillmap.sql  
├─ includes/  
│   ├─ header.php  
│   ├─ footer.php  
│   ├─ db_connect.php  
│   └─ config.php (optional)  
├─ jobs/  
├─ courses/  
├─ profile/  
├─ dashboard.php  
├─ index.php  
└─ base.php  
```  

## Contributing  
Thanks for your interest in contributing!  
- Fork this repository and create a new branch: `feature/your‑feature`.  
- Make changes and ensure everything is working locally.  
- Submit a pull request describing your changes.  
- Please follow PSR‑2 or your preferred coding standard, include comments and document new features.



## Future Roadmap  
Here are some planned enhancements:  
- Integrate a proper AI/machine‑learning engine for more accurate candidate‑job matching.  
- Add candidate self‑service portal (profile creation, job application).  
- Add email notifications for job posting, candidate matches.  
- Add role‑based access control (Recruiter, HR, Admin).  
- Improve UI/UX (responsive design, better dashboards).  
- Add REST API endpoints for mobile/web integrations.  
