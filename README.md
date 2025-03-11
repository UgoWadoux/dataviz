# Data Visualization for Carburants

**OLFA FUEL is a Data Visualization for Carburants** is a project designed to analyze and visualize fuel (carburant) data using PHP and Chart.js. This project is my first foray into data visualization and combines interactive charts with a robust backend powered by a PostgreSQL database.

## Overview

This project visualizes data for various types of carburants by dynamically generating charts. The PHP backend processes the data while Chart.js renders the interactive charts on the frontend. Multiple PHP scripts generate graphs for different fuel types such as:
- **E10**
- **E85**
- **GPLC**
- **Gazole**
- **SP95**
- **SP98**

Additionally, a mapping component (using Leaflet) complements the visual data presentation.

## Features

- **Dynamic Charts:** Interactive visualizations that update based on fuel data.
- **Multiple Fuel Types:** Separate graphs for different fuel categories.
- **Database Integration:** Uses a PostgreSQL database to store and manage carburant data.
- **Dockerized Database:** Easy setup with Docker Compose.
- **Responsive Design:** Optimized display for various devices.
- **Map Integration:** Utilizes Leaflet for geographical data visualization.

## Technologies Used

- **PHP:** Handles backend data processing.
- **Chart.js:** Renders interactive charts for data visualization.
- **PostgreSQL:** Database system to store fuel data.
- **Docker Compose:** Manages and deploys the PostgreSQL database container.
- **HTML & CSS:** Structures and styles the web pages.
- **JavaScript:** Custom scripts for interactivity and data handling.
- **Leaflet:** Provides interactive mapping capabilities.

## Installation

### 1. Clone the Repository

Clone the project repository using Git:

```bash
git clone https://github.com/UgoWadoux/dataviz.git
```

## 3. Database Setup

This project uses a PostgreSQL database to store carburant data, which is set up using Docker Compose.
Using Docker Compose
Ensure Docker is installed on your system.

Locate the Docker Compose file:
The repository includes a Docker Compose file that sets up a PostgreSQL container.

Start the PostgreSQL Container:

Run the following command in the root of your project directory:
```bash
docker-compose up -d
```
This command will start the PostgreSQL container in detached mode.

Importing Data

SQL Script:
A SQL script is provided in the repository that contains all the carburant data.

Import the SQL Script:

Once the PostgreSQL container is running, execute the SQL script to populate the database. You can do this using a tool like psql:
```bash
docker exec -i $(docker-compose ps -q database) psql -U postgres -d fuel-dataviz < fuel-dataviz.dump
```
Replace <container_name_or_id>, <username>, <database_name>, and path/to/your/script.sql with the actual values from your setup.

## 4. Access the Project

```bash
php -S localhost:8000
```

Open your browser and navigate to:
http://localhost:8000
 