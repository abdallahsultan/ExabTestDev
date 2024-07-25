
# Laravel Project Setup Guide

This guide will help you set up the Laravel project on your local machine using Docker. Just follow these straightforward steps to get started.

## Prerequisites

Before proceeding, ensure you have Docker installed on your machine. If not, download and install Docker from [https://www.docker.com/get-started](https://www.docker.com/get-started).

## Getting Started

1. **Clone the repository**

   Start by cloning the repository to your desired location on your computer.

   ```
   git clone  https://github.com/abdallahsultan/ExabTestDev.git
   ```

2. **Setup Environment File**

   After cloning the repository, you need to create an environment file from the provided example. This file contains various settings needed to run the application.

   ```
   cp .env.example .env
   ```

3. **Launch Docker Containers**

   Run the following command to start all the required Docker containers using Docker Compose. This will set up the application's environment, including the web server, database, and any other services defined in `docker-compose.yml`.

   ```
   docker-compose up -d
   ```

4. **Access the Application**

   Once the Docker containers are up and running, you can access your Laravel application by going to:

   ```
   http://localhost
   ```

   This URL will bring you to the Laravel application landing page.

5. **Access MailHog**

   MailHog is a mock SMTP server for testing email sending in development environments. You can access the MailHof web interface to view and test emails sent by the application by going to:

   ```
   http://localhost:8025
   ```
