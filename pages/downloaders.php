<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../backend/includes/base-include.php'; ?>
    <title>Riotcha</title>
</head>
<body>
    <main-element class="welcome">
        <h1>Downloaders</h1>
    </main-element>

    <main-element>
        <div class="container">
            <h1>🎬 Video Downloader</h1>
            <p class="subtitle">Download videos from YouTube, TikTok, and more in maximum quality</p>
            
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
                <h3>Supported Platforms:</h3>
                <div class="platforms">
                    <span class="platform">YouTube</span>
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

    

    <script src="../js/videoDownload.js"></script>
    
    <!--?php include '../backend/meta/footer.php'; ?>-->
</body>
</html>