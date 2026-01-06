//
// PAGES
//

const content = document.getElementById("content");
const sound = document.getElementById("clickSound");
const sound2 = document.getElementById("clickSound2");

async function loadPage(url, push = true) {
  const res = await fetch(url);
  if (!res.ok) {
    loadPage("/backend/includes/404.php", false);
    return;
  }

  content.innerHTML = await res.text();
  if (push) history.pushState(null, "", "/");
}

// initial load
if (location.pathname === "/" || location.pathname === "/index.php") {
  loadPage("/pages/home.php", false);
} else {
  loadPage(location.pathname, false);
}

//
// CLICK SOUND
//

document.addEventListener("click", e => {
  const link = e.target.closest("[data-page]");
  if (!link) return;

  e.preventDefault();
  sound.currentTime = 0;
  sound.play();

  loadPage(link.getAttribute("href"));
});

document.addEventListener("click", e => {
  const button = e.target.closest("[data-sound2]");
  if (!button) return;

  e.preventDefault();
  sound2.currentTime = 0;
  sound2.play();
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

// SPIN ICON

const settingsIcon = document.querySelector('.settings-icon');

settingsIcon.addEventListener('click', () => {
  settingsIcon.classList.toggle('is-open');
});

// Settings controls: background (black or a few images), transparency, volume
(function() {
  const bgOption = document.getElementById('backgroundOption');
  const transparencySlider = document.getElementById('transparencySlider');
  const volumeSlider = document.getElementById('volumeSlider');
  if (!bgOption && !transparencySlider && !volumeSlider) return;

  const imageMap = {
    'banner': '/assets/images/banner.png',
    'confused-owl': '/assets/images/confused-owl.png',
    'owl-body': '/assets/images/owl-body.png'
  };

  function applyBackground(key) {
    if (!key || key === 'black') {
      document.body.style.backgroundImage = '';
      document.body.style.backgroundColor = '#000';
    } else if (imageMap[key]) {
      document.body.style.backgroundImage = `url('${imageMap[key]}')`;
      document.body.style.backgroundSize = 'cover';
      document.body.style.backgroundPosition = 'center';
    }
  }

  function save(obj) { localStorage.setItem('riotchaSettings', JSON.stringify(obj)); }
  function load() { try { return JSON.parse(localStorage.getItem('riotchaSettings')) || {}; } catch (e) { return {}; } }

  const s = load();
  if (bgOption && s.background) bgOption.value = s.background;
  if (transparencySlider && s.transparency !== undefined) transparencySlider.value = s.transparency;
  if (volumeSlider && s.volume !== undefined) volumeSlider.value = s.volume;

  applyBackground((bgOption && bgOption.value) || (s.background) || 'black');
  if (transparencySlider) document.documentElement.style.setProperty('--main-element-alpha', transparencySlider.value);
  if (volumeSlider) { const vol = parseFloat(volumeSlider.value); sound.volume = vol; sound2.volume = vol; }

  if (bgOption) bgOption.addEventListener('change', () => {
    applyBackground(bgOption.value);
    const cur = load(); cur.background = bgOption.value; save(cur);
  });

  if (transparencySlider) transparencySlider.addEventListener('input', () => {
    document.documentElement.style.setProperty('--main-element-alpha', transparencySlider.value);
    const cur = load(); cur.transparency = transparencySlider.value; save(cur);
  });

  if (volumeSlider) volumeSlider.addEventListener('input', () => {
    const vol = parseFloat(volumeSlider.value);
    sound.volume = vol; sound2.volume = vol;
    const cur = load(); cur.volume = volumeSlider.value; save(cur);
  });

})();
