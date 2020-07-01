# Use the official image as a parent image.
FROM httpd:latest

# Set the working directory.
WORKDIR /var/www/

# Copy the file from your host to your current location.

# Run the command inside your image filesystem.
RUN composer dump-autoload -o

# Inform Docker that the container is listening on the specified port at runtime.
EXPOSE 8080

# Run the specified command within the container.
CMD [ "systemctl", "start", "apache2" ]
# Copy the rest of your app's source code from your host to your image filesystem.
COPY . .