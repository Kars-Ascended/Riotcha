//
// CLICK SOUND
//

const content = document.getElementById("content");
const sound = document.getElementById("clickSound");

async function loadPage(url, push = true) {
  const res = await fetch(url);
  if (!res.ok) {
    content.innerHTML = "<h1>404</h1>";
    return;
  }

  content.innerHTML = await res.text();
  if (push) history.pushState(null, "", url);
}

// initial load
if (location.pathname === "/" || location.pathname === "/index.php") {
  loadPage("/pages/home.php", false);
} else {
  loadPage(location.pathname, false);
}

// nav clicks
document.addEventListener("click", e => {
  const link = e.target.closest("[data-page]");
  if (!link) return;

  e.preventDefault();
  sound.currentTime = 0;
  sound.play();

  loadPage(link.getAttribute("href"));
});

// back / forward
window.addEventListener("popstate", () => {
  loadPage(location.pathname, false);
});

//
// SETTINGS
//

document.getElementById('trigger').addEventListener('click', function() {
  document.getElementById('panel').classList.toggle('active');
});