const content = document.getElementById("content");
const sound = document.getElementById("clickSound");

async function loadPage(url) {
  const res = await fetch(url);
  if (!res.ok) {
    content.innerHTML = "<h1>404</h1>";
    return;
  }
  content.innerHTML = await res.text();
  history.pushState(null, "", url);
}

document.addEventListener("click", e => {
  const link = e.target.closest("[data-page]");
  if (!link) return;

  e.preventDefault();

  sound.currentTime = 0;
  sound.play();

  loadPage(link.getAttribute("href"));
});

// initial load
loadPage(location.pathname === "/" ? "/pages/home.html" : location.pathname);

// back / forward
window.addEventListener("popstate", () => {
  loadPage(location.pathname);
});
