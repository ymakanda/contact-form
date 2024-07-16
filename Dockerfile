# Use the official PHP image with Apache
FROM php:7.4-apache

# Install required PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Set the working directory
WORKDIR /var/www/html

# Copy the source files to the container
COPY src/ /var/www/html/

# Copy the SQL initialization script to the container
COPY db/contacts.sql /docker-entrypoint-initdb.d/

# Expose port 80
EXPOSE 80
