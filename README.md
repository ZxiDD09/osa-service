# Office of Student Affairs

This Laravel application is for the Office Of Student Affairs.

## Setup Instructions

Follow these steps to set up the project locally:

## Setup Instructions

Follow these steps to set up the project locally:

1. **Database Setup:**

    - Create a MySQL database named `osa_service`.
    - Update the `.env` file with your database credentials:
        ```
        DB_DATABASE=osa_service
        ```

2. **Environment Configuration:**

    - Copy the `.env.example` file:
        ```bash
        cp .env.example .env
        ```
    - Update `.env` with your configuration.

3. **Install Composer Dependencies:**

    ```bash
    composer install --ignore-platform-reqs

    ```

4. **Run Migrations and Seed Data:**

    ```bash
    php artisan migrate:fresh --seed

    ```

5. **Scout Setup**:

    ```bash
     php artisan flush:indices
     php artisan index:tables

    ```

6. **Passport Client**:

    ```bash
    php artisan passport:client --personal

    ```

7. **Enjoy!**:
   `bash
 php artisan serve
 `
   `
