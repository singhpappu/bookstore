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


Admin Book managment
<video src="admin1.mp4" controls title="Title"></video>


https://github.com/singhpappu/bookstore/assets/25156691/7cf8077a-5a00-4ddd-908b-3f14422bb369



Queue and Horizon
<video src="queue-and-horizon.mp4" controls title="Title"></video>
The button *Import books from FackerAPI* run Job to get the data from API and store it into database in background.

Run the import command to sync the data with meilisearch
```bash
$  sail php artisan scout:import "App\Models\Book"
```
