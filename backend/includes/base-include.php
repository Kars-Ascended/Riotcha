<link rel="stylesheet" href="../css/base.css">
<link rel="stylesheet" href="../css/main.css">
<link rel="stylesheet" href="../css/nav.css">

<title>Riotcha</title>

<nav>
    <div class="vertical-center">
        <a class="button click-sound" href="/pages/home.php" data-page>Home</a>
        <a class="button click-sound" href="/pages/downloaders.php" data-page>Downloaders</a>
        <a class="button click-sound" href="/pages/formatConversion.php" data-page>Format Converter</a>
        <a class="button click-sound" href="/pages/extras.php" data-page>Extras</a>
        <a class="button click-sound" data-page>Test</a>
    </div>

    <div class="settings-button">
        <img id="trigger" class="settings-icon" src="/assets/images/settings.png" data-sound2>
    </div>
</nav>

<div class="slide-panel" id="panel">
    <main-element class="welcome">
        <h1>test</h1>
    </main-element>
    <main-element>
        <h2>Settings</h2>

        <label>Background: [EXPERIMENTAL]
            <select id="backgroundOption">
                <option value="black">Solid black</option>
                <option value="banner">Banner</option>
                <option value="confused-owl">Confused Owl</option>
                <option value="owl-body">Owl Body</option>
            </select>
        </label>

        <div style="margin-top:0.5em;">
            <label>Transparency: <input type="range" id="transparencySlider" min="0" max="1" step="0.01" value="1"></label>
        </div>

        <div style="margin-top:0.5em;">
            <label>Volume: <input type="range" id="volumeSlider" min="0" max="1" step="0.01" value="1"></label>
        </div>
    </main-element>
</div>

<div class="redirect-prompt">
    <h1>IF YOU CAN SEE THIS YOU ARE NOT LOADING THE PAGE CORRECTLY, PLEASE <a href="/">RETURN HERE</a></h1>
</div>