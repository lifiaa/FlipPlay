# FlipPlay Ocean / Diamond Blue Redesign

Open `index.html` using VS Code Live Server.

Files:
- `index.html`: page structure
- `main.css`: oceanic cinematic layout, pastel/diamond blue accents, rounded 20px cards, responsive layout
- `script.js`: Fetch API, live search, aura filters, show-more button, mobile navigation

The existing API endpoint is preserved exactly:
`https://jikan.lucashdo.com/v1/top/anime?page=1`

The compact API response does not include full synopsis or genre data, so the UI avoids pretending those details exist. Local showcase cards reference `assets/anime.jpg`, `assets/drama.jpg`, and `assets/manga.jpg`; add your own images to an `assets` folder or replace those image paths.
