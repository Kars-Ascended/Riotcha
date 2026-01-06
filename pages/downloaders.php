<main-element class="welcome">
    <h1>Downloaders</h1>
</main-element>

<main-element>
    <!-- Video Downloader -->
    <div class="container">
        <h1>🎬 Video Downloader</h1>
        
        <div class="input-group">
            <input 
                type="text" 
                id="videoUrl" 
                placeholder="Paste video URL here..."
                autocomplete="off"
            >
        </div>
        
        <button id="downloadBtn" onclick="downloadVideo()">
            Download Video
        </button>
        
        <div id="status" class="status"></div>
        
        <div class="supported">
            <div class="platforms">
                <p class="platform">YouTube</p>
                <span class="platform">TikTok</span>
                <span class="platform">Instagram</span>
                <span class="platform">Twitter/X</span>
                <span class="platform">Facebook</span>
                <span class="platform">Vimeo</span>
                <span class="platform">+ 1000s more</span>
            </div>
        </div>
    </div>
</main-element>
<main-element>

    <!-- Audio Downloader -->
    <div class="container">
        <h1>🎵 Audio Downloader</h1>
        
        <div class="input-group">
            <input 
                type="text" 
                id="audioUrl" 
                placeholder="Paste YouTube or Spotify URL here..."
                autocomplete="off"
            >
        </div>
        
        <button class="audio-btn" id="downloadAudioBtn" onclick="downloadAudio()">
            Download MP3
        </button>
        
        <div id="audioStatus" class="status"></div>
        
        <div class="supported">
            <h3>Supported Platforms:</h3>
            <div class="platforms">
                <span class="platform">Spotify</span>
                <span class="platform">YouTube</span>
                <span class="platform">SoundCloud</span>
                <span class="platform">Apple Music</span>
                <span class="platform">Deezer</span>
                <span class="platform">+ many more</span>
            </div>
        </div>
    </div>

</main-element>


<script src="../js/videoDownload.js"></script>

<!--?php include '../backend/meta/footer.php'; ?>-->