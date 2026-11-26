const animeSearch = document.querySelector("#anime-search");
const animeGrid = document.querySelector("#anime-grid");
const animeStatus = document.querySelector("#anime-status");
const animeRetry = document.querySelector("#anime-retry");
const animeMore = document.querySelector("#anime-more");
const auraButtons = document.querySelectorAll("[data-aura]");
const menuToggle = document.querySelector("#menu-toggle");
const mobileMenu = document.querySelector("#mobile-menu");

let animeData = [];
let activeAura = "all";
let searchKeyword = "";
let visibleLimit = 8;

// KATEGORY FILM
const auraRules = {
  energy: (anime) => ["TV", "Movie", "ONA"].includes(anime.type),
  melancholy: (anime) => ["TV", "Movie", "Special"].includes(anime.type),
  action: (anime) => anime.episodes === null || Number(anime.episodes) >= 12,
};

// Mengambil data anime dari Jikan Edge API.
async function loadAnime() {
  animeStatus.textContent = "Mencari anime...";
  animeGrid.innerHTML = "";
  animeRetry.classList.add("hidden");
  animeMore.classList.add("hidden");

  try {
    const response = await fetch("http://127.0.0.1:8000/api/media", {
      headers: {
        Accept: "application/json"
      }
    });

    if (!response.ok) {
      throw new Error(`HTTP Error: ${response.status}`);
    }

    const result = await response.json();

    animeData = (result.data || []).map((media) => ({
      title: media.title,
      type: media.type,
      episodes: media.episodes,
      genre: media.genre,
      description: media.description,
      imageUrl: "",
      score: "N/A",
      malId: media.id
    }));

    if (!animeData.length) {
      animeStatus.textContent = "Belum ada anime di database.";
      return;
    }

    visibleLimit = 8;
    renderAnime();
  } catch (error) {
    console.error("Fetch Laravel API gagal:", error);
    animeStatus.textContent = "Backend tidak dapat dihubungi.";
    animeRetry.classList.remove("hidden");
  }
}


// cari anime pake judul (k,v) show api html
// Memfilter data, membatasi jumlah kartu, lalu membuat HTML kartu anime.
function renderAnime() {
  const filtered = animeData.filter((anime) => {
    const matchesSearch = (anime.title || "")
      .toLowerCase()
      .includes(searchKeyword.toLowerCase());
    const matchesAura = activeAura === "all" || auraRules[activeAura](anime);
    return matchesSearch && matchesAura;
  });

  // (key value) map
  const visible = filtered.slice(0, visibleLimit);
  animeGrid.innerHTML = visible
    .map((anime) => {
      const title = anime.title || "Untitled story";
      const poster = anime.imageUrl || "";
      const score = anime.score ?? "N/A";
      const episodes = anime.episodes ?? "?";
      const detailUrl =
        anime.url || `https://myanimelist.net/anime/${anime.malId}`;
      return `<article class="anime-card">
      <div class="anime-poster">
        <img src="${escapeHTML(poster)}" alt="Poster ${escapeHTML(title)}" loading="lazy">
        <div class="poster-fallback hidden" aria-hidden="true">${escapeHTML(title)}<span>FLIPPLAY ARCHIVE</span></div>
        <span class="score">✦ ${escapeHTML(score)}</span>
      </div>
      <div class="anime-info"><p class="anime-type">${escapeHTML(anime.type || "Anime")}</p>
      <h3>${escapeHTML(title)}</h3><p>${escapeHTML(episodes)} episodes${anime.startDate ? ` · ${escapeHTML(anime.startDate)}` : ""}</p>
      <a class="anime-link" href="${escapeHTML(detailUrl)}" target="_blank" rel="noopener noreferrer">View details ↗</a></div>
    </article>`;
    })
    .join("");
    
  // load poster berdasarkan judul
  animeGrid.querySelectorAll(".anime-poster img").forEach((img) => {
    img.addEventListener(
      "error",
      () => {
        img.classList.add("image-failed");
        img.parentElement
          .querySelector(".poster-fallback")
          ?.classList.remove("hidden");
      },
      { once: true },
    );
  });
  animeStatus.textContent = filtered.length
    ? `${filtered.length} stories found · showing ${visible.length}`
    : "No stories match that search. Try another title or vibe.";
  animeMore.classList.toggle("hidden", visible.length >= filtered.length);
}

function escapeHTML(value) {
  return String(value).replace(
    /[&<>"']/g,
    (char) =>
      ({
        "&": "&amp;",
        "<": "&lt;",
        ">": "&gt;",
        '"': "&quot;",
        "'": "&#39;",
      })[char],
  );
}

// event input
animeSearch.addEventListener("input", (event) => {
  searchKeyword = event.target.value.trim();
  visibleLimit = 8;
  renderAnime();
});

// kategory
auraButtons.forEach((button) =>
  button.addEventListener("click", () => {
    activeAura = button.dataset.aura;
    visibleLimit = 8;
    auraButtons.forEach((item) => {
      const selected = item === button;
      item.classList.toggle("selected", selected);
      item.setAttribute("aria-pressed", String(selected));
    });
    renderAnime();
  }),
);

// hidden card
animeMore.addEventListener("click", () => {
  visibleLimit += 8;
  renderAnime();
});

animeRetry.addEventListener("click", loadAnime);

menuToggle.addEventListener("click", () => {
  const open = mobileMenu.classList.toggle("open");
  menuToggle.setAttribute("aria-expanded", String(open));
  menuToggle.textContent = open ? "×" : "☰";
});

mobileMenu.querySelectorAll("a").forEach((link) =>
  link.addEventListener("click", () => {
    mobileMenu.classList.remove("open");
    menuToggle.setAttribute("aria-expanded", "false");
    menuToggle.textContent = "☰";
  }),
);

window.addEventListener("scroll", () =>
  document.querySelector("#header").classList.toggle("scrolled", scrollY > 24),
);

document.querySelector("#year").textContent = new Date().getFullYear();
loadAnime();
