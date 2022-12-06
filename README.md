## My - Blog

Welcome to the blog project.

For running the project you need to use Docker:

---

### Server urls (when docker is running)

Frontend url: http://localhost:8080

Backend url: http://localhost:8000

---

<strong>Initializing backend:</strong>

```
make backend-init
```

---

<strong>Starting server:</strong>

```
docker-compose up or docker compose up
```

If you want to start docker in background:

```
docker-compose up -d or docker compose up -d
```

---

<strong>Running migrations</strong>

```
make migrate-seed
```

Which translates to

```
docker-compose exec backend php artisan migrate
```

---

<strong>Stopping docker project:</strong>

```
docker-compose down or docker compose down
```

<strong>Install frontend packages</strong>

```
docker-compose exec frontend npm i <package>
```

---
