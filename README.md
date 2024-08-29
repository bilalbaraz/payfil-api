# PayFil - API

Welcome to the Payfil API Project, a robust solution designed to streamline payment processing for e-commerce platforms. Developed using the powerful Laravel framework, this API enables seamless payment transactions through multiple banks, providing a secure and efficient way to handle online sales.

## Installation

To get started with the Payfil API Project, follow these steps to set up your development environment.

### Prerequisites

Ensure you have the following installed on your system:

- **Docker**: Used to create a consistent development environment.
- **Docker Compose**: To manage multi-container Docker applications.

### Steps

1. **Clone the Repository**: Begin by cloning the repository to your local machine:

    ```bash
   git clone https://github.com/bilalbaraz/payfil-api.git
   cd payfil-api
   ```
2. **Install Dependencies**: Install the necessary PHP dependencies using Composer:

    ```bash
    composer install
    ```
3. **Set Up Environment Variables**: Copy the example environment file and update it with your local settings:

    ```bash
    cp .env.example .env
    ```

## Contributing

We welcome contributions from the community! Whether you're fixing a bug, adding a new feature, or improving documentation, your help is greatly appreciated. Please follow the guidelines below to ensure a smooth contribution process.

### How to Contribute

1. **Fork the Repository**: Start by forking the repository to your own GitHub account.

2. **Create a Branch**: Create a new branch for your feature or bug fix.

   ```bash
   git checkout -b feature/your-feature-name
   ```
3. **Make Your Changes**: Make your code changes in your branch. Please ensure your code adheres to the project's coding standards and passes all tests.

4. **Run Tests**: Run the existing tests to ensure that your changes do not break anything.

    ```bash
    ./vendor/bin/phpunit
    ```

5. **Commit Your Changes**: Write clear, concise commit messages explaining your changes.

    ```bash
    git commit -m "Add a descriptive commit message"
    ```

6. **Push to GitHub**: Push your changes to your forked repository.

    ```bash
    git push origin feature/your-feature-name
    ```
7. **Open a Pull Request**: Open a pull request on the main repository. Provide a detailed description of your changes and any relevant issue numbers.

Thank you for contributing!

## Coding Standards

This project adheres to the PSR-12 coding standard.

## Credits

This project was made possible through the collaborative efforts of several individuals and organizations. We would like to extend our sincere gratitude to everyone who contributed to the development and success of this project.

- [**Bilal Baraz**](https://github.com/bilalbaraz) - Computer Engineer.

A special thank you to the open-source community and the developers behind the frameworks, libraries, and tools that made this project possible, including:

- [**Laravel**](https://laravel.com/) - for providing an elegant and robust PHP framework.
- [**PHP**](https://www.php.net/) - for being the backbone of our server-side development.
- [**MySQL**](https://www.mysql.com/) - for a reliable and powerful database solution.
- [**Docker**](https://www.docker.com/) - for simplifying our development and deployment processes.
- [**GitHub**](https://github.com/) - for offering an excellent platform for version control and collaboration.

## Troubleshooting

If you encounter any issues while setting up or running the Payfil API Project, this section will help you diagnose and resolve common problems.

### 1. Docker Containers Not Starting

**Issue**: Docker containers fail to start or keep restarting.

**Solution**:
- Ensure Docker is properly installed and running on your machine.
- Check if the ports required by the containers (e.g., MySQL on port 3306) are already in use by another application. You may need to stop the other application or configure Docker to use different ports.
- Review the Docker logs for more detailed error messages:

    ```bash
    docker logs <container_name>
    ```

## Support

If you need assistance with the Payfil API Project, we're here to help! Below are the various ways you can get support.

### Report Issues

If you've found a bug or would like to request a new feature, please submit an issue on our [GitHub Issues](https://github.com/bilalbaraz/payfil-api/issues) page. When reporting issues, please include as much detail as possible to help us resolve the problem quickly.

Thank you for using Payfil! We're committed to ensuring you have a smooth experience with our API.