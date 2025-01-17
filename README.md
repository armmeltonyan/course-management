# Test task

The application is dockerized. To run the API, you will need run the following commands:

```bash
# Copy .env.example to .env and change vars
cp .env.example .env
cp project/.env.example project/.env

# Run docker-compose
docker-compose up -d

# Then install dependencies and run migrations
docker-compose exec api composer install
docker-compose exec api php artisan migrate

# Then your project should be available at http://localhost:${DOCKER_API_PORT}

# another way is to deploy with make file

make reset-project
```

