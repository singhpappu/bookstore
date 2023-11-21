# Book Store [Packt+ Assessment]
Laravel VueJs Assessment

#### Development platform used
- Microsoft Windows OS 11
- WSL2
- Docker Desktop for windows

# Getting started
#### Clone the repository
```
git clone https://github.com/singhpappu/bookstore.git
```
#### Install dependencies
```
Login to the WSL terminal

$ cd bookstore

configure the environment variable, copy content of .env.example to .env and modify the variable

$ ./vendor/bin/sail up
OR 
$ docker compose up -d --build

```
#### Using sail command
```bash
$ sail composer update
$ sail php artisan migrate --seed
$ sail npm install
$ sail npm run dev
```
Now the app will run on http://localhost:8801/


Search result

https://github.com/singhpappu/bookstore/assets/25156691/17d032eb-fbad-4f74-873d-61cf44eea261



Admin Book managment

Default admin credentials

user: admin@bookstore.com <br/>
password: Secret@2023

https://github.com/singhpappu/bookstore/assets/25156691/7cf8077a-5a00-4ddd-908b-3f14422bb369

Queue and Horizon

https://github.com/singhpappu/bookstore/assets/25156691/03a9bee8-477e-42ea-90e4-51419d14280c

The button *Import books from FackerAPI* run Job to get the data from API and store it into database in background.

Run the import command to sync the data with meilisearch
```bash
$  sail php artisan scout:import "App\Models\Book"
```
