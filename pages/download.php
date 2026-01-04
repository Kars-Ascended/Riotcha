<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Downloader</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .container {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            max-width: 600px;
            width: 100%;
        }
        
        h1 {
            color: #333;
            margin-bottom: 10px;
            font-size: 32px;
        }
        
        .subtitle {
            color: #666;
            margin-bottom: 30px;
            font-size: 14px;
        }
        
        .input-group {
            margin-bottom: 20px;
        }
        
        input[type="text"] {
            width: 100%;
            padding: 15px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 16px;
            transition: border 0.3s;
        }
        
        input[type="text"]:focus {
            outline: none;
            border-color: #667eea;
        }
        
        button {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        
        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.4);
        }
        
        button:active {
            transform: translateY(0);
        }
        
        button:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }
        
        .status {
            margin-top: 20px;
            padding: 15px;
            border-radius: 10px;
            font-size: 14px;
            display: none;
        }
        
        .status.success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .status.error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .status.info {
            background: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
        }
        
        .supported {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
        }
        
        .supported h3 {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
        }
        
        .platforms {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        
        .platform {
            background: #f5f5f5;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
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

    <script>
        // IMPORTANT: Replace this with your actual server URL
        const API_URL = 'https://armor-crimes-edmonton-alleged.trycloudflare.com/download';
        
        function showStatus(message, type) {
            const status = document.getElementById('status');
            status.textContent = message;
            status.className = `status ${type}`;
            status.style.display = 'block';
        }
        
        function hideStatus() {
            const status = document.getElementById('status');
            status.style.display = 'none';
        }
        
        async function downloadVideo() {
            const urlInput = document.getElementById('videoUrl');
            const downloadBtn = document.getElementById('downloadBtn');
            const url = urlInput.value.trim();
            
            if (!url) {
                showStatus('Please enter a video URL', 'error');
                return;
            }
            
            // Disable button and show loading
            downloadBtn.disabled = true;
            downloadBtn.textContent = 'Downloading...';
            showStatus('Fetching video... This may take a moment', 'info');
            
            try {
                const response = await fetch(API_URL, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ url: url })
                });
                
                if (!response.ok) {
                    const error = await response.json();
                    throw new Error(error.error || 'Download failed');
                }
                
                // Get the blob from response
                const blob = await response.blob();
                
                // Extract filename from Content-Disposition header
                const contentDisposition = response.headers.get('Content-Disposition');
                let filename = 'video.mp4';
                if (contentDisposition) {
                    const matches = /filename="(.+)"/.exec(contentDisposition);
                    if (matches && matches[1]) {
                        filename = matches[1];
                    }
                }
                
                // Create download link
                const downloadUrl = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = downloadUrl;
                a.download = filename;
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                window.URL.revokeObjectURL(downloadUrl);
                
                showStatus('✓ Video downloaded successfully!', 'success');
                urlInput.value = '';
                
            } catch (error) {
                showStatus(`Error: ${error.message}`, 'error');
            } finally {
                downloadBtn.disabled = false;
                downloadBtn.textContent = 'Download Video';
            }
        }
        
        // Allow Enter key to trigger download
        document.getElementById('videoUrl').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                downloadVideo();
            }
        });
    </script>
</body>
</html>