### 🍲 Food Management System
#### Develope Tools
* PHP, MySQL
#### How to Deploy
```bash
vim docker-compose.yml
```
```yaml
version: '3'
services:
  food:
    image: ghcr.io/ezynook/food/food:latest
    container_name: food
    ports:
      - 80:80
      - 3306:3306
    restart: always
    volumes:
      - food_data:/var/lib/mysql
    healthcheck:
      test: curl --fail http://localhost || exit 1
      interval: 1m30s
      timeout: 30s
      retries: 3
      start_period: 30s

volumes:
  food_data:
```
```bash
docker-compose up -d
```
