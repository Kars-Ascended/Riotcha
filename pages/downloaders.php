<div class="redirect-prompt">
    <h1>IF YOU CAN SEE THIS YOU ARE NOT LOADING THE PAGE CORRECTLY, PLEASE <a href="/">RETURN</a></h1>
</div>

<main-element class="welcome">
    <h1>Downloaders</h1>
</main-element>

<!-- Video Downloader -->
<main-element>
    <div class="container">
        <h1>🎬 Video Downloader</h1>
        
        <div class="input-group">
            <input 
                type="text" 
                id="videoUrl" 
                placeholder="Paste video URL here..."
                autocomplete="off">
        </div>
        
        <button id="downloadBtn" onclick="downloadVideo()"> Download Video </button>
        <div id="status" class="status"></div>
    </div>
</main-element>

<!-- Audio Downloader -->
<main-element>
    <div class="container">
        <h1>🎵 Audio Downloader</h1>
        
        <div class="input-group">
            <input 
                type="text" 
                id="audioUrl" 
                placeholder="Paste YouTube or Spotify URL here..."
                autocomplete="off">
        </div>
        <div class="align">
            <button class="audio-btn" id="downloadAudioBtn" onclick="downloadAudio()"> Download MP3 </button>
            <p style="padding-left: 0.5em;">- Downloads from most sites except spotify. Will add a workaround soon.</p>
        </div>
        <div id="audioStatus" class="status"></div>
    </div>

</main-element>


<script src="../js/videoDownload.js"></script>

<!--?php include '../backend/meta/footer.php'; ?>-->