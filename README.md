### 🍲 Food Management System
#### Develope Tools
* PHP, MySQL
#### How to Deploy
```bash
docker volume create food_data
```
```bash
docker run --name food \
-p 80:80 -p 3306:3306 \
--restart=always \
-v food_data:/var/lib/mysql \
-d ghcr.io/ezynook/food/food:latest
```
