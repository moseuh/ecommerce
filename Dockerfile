# Use an official Nginx image from Docker Hub as the base image
FROM nginx:alpine

# Copy the local HTML file into the Nginx container's default web directory
COPY ./index.html /usr/share/nginx/html/index.html

# Expose port 80 so the app is accessible
EXPOSE 80
