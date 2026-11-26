# FlipPlay — Modern Entertainment Landing Page

## Konsep
- Modern tech / cinematic entertainment, terinspirasi pola browsing platform streaming tetapi dengan identitas visual FlipPlay sendiri.
- Palet Lunaria: ink `#111019`, panel `#1d1b29`, lilac `#b8b5d9`, violet `#827be8`.
- Contact form dihapus; kontak dipindahkan ke footer.
- HTML semantik, responsive layout, Tailwind CSS v4 CLI, dan animasi JavaScript.

## Struktur
- `index.html`
- `src/main.css`
- `src/script.js`
- `src/output.css` dibuat oleh Tailwind CLI saat build.

## Menjalankan
Pastikan proyek memakai Tailwind CSS v4 CLI. Dari folder proyek, jalankan:

```bash
npx @tailwindcss/cli -i ./src/main.css -o ./src/output.css --watch
```

Lalu buka `index.html` dengan Live Server.

## Catatan aset
Poster memakai gambar remote dari Unsplash untuk demo. Ganti `src` pada tag `<img>` dengan aset milikmu di folder `resource/` bila sudah siap. Email footer `hello@flipplay.example` dan tautan sosial adalah placeholder; ubah ke kontak milikmu.
