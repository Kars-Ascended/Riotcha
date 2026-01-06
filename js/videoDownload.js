        // IMPORTANT: Replace this with your actual server URL
        const API_URL = 'https://armor-crimes-edmonton-alleged.trycloudflare.com';
        
        function showStatus(elementId, message, type) {
            const status = document.getElementById(elementId);
            status.textContent = message;
            status.className = `status ${type}`;
            status.style.display = 'block';
        }
        
        function hideStatus(elementId) {
            const status = document.getElementById(elementId);
            status.style.display = 'none';
        }
        
        async function downloadVideo() {
            const urlInput = document.getElementById('videoUrl');
            const downloadBtn = document.getElementById('downloadBtn');
            const url = urlInput.value.trim();
            
            if (!url) {
                showStatus('status', 'Please enter a video URL', 'error');
                return;
            }
            
            downloadBtn.disabled = true;
            downloadBtn.textContent = 'Downloading...';
            showStatus('status', 'Fetching video... This may take a moment', 'info');
            
            try {
                const response = await fetch(`${API_URL}/download`, {
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
                
                const blob = await response.blob();
                const contentDisposition = response.headers.get('Content-Disposition');
                let filename = 'video.mp4';
                if (contentDisposition) {
                    const matches = /filename="(.+)"/.exec(contentDisposition);
                    if (matches && matches[1]) {
                        filename = matches[1];
                    }
                }
                
                const downloadUrl = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = downloadUrl;
                a.download = filename;
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                window.URL.revokeObjectURL(downloadUrl);
                
                showStatus('status', '✓ Video downloaded successfully!', 'success');
                urlInput.value = '';
                
            } catch (error) {
                showStatus('status', `Error: ${error.message}`, 'error');
            } finally {
                downloadBtn.disabled = false;
                downloadBtn.textContent = 'Download Video';
            }
        }
        
        async function downloadAudio() {
            const urlInput = document.getElementById('audioUrl');
            const downloadBtn = document.getElementById('downloadAudioBtn');
            const url = urlInput.value.trim();
            
            if (!url) {
                showStatus('audioStatus', 'Please enter a URL', 'error');
                return;
            }
            
            downloadBtn.disabled = true;
            downloadBtn.textContent = 'Downloading...';
            showStatus('audioStatus', 'Fetching audio... This may take a moment', 'info');
            
            try {
                const response = await fetch(`${API_URL}/download-audio`, {
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
                
                const blob = await response.blob();
                const contentDisposition = response.headers.get('Content-Disposition');
                let filename = 'audio.mp3';
                if (contentDisposition) {
                    const matches = /filename="(.+)"/.exec(contentDisposition);
                    if (matches && matches[1]) {
                        filename = matches[1];
                    }
                }
                
                const downloadUrl = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = downloadUrl;
                a.download = filename;
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                window.URL.revokeObjectURL(downloadUrl);
                
                showStatus('audioStatus', '✓ Audio downloaded successfully!', 'success');
                urlInput.value = '';
                
            } catch (error) {
                showStatus('audioStatus', `Error: ${error.message}`, 'error');
            } finally {
                downloadBtn.disabled = false;
                downloadBtn.textContent = 'Download MP3';
            }
        }
        
        document.getElementById('videoUrl').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                downloadVideo();
            }
        });
        
        document.getElementById('audioUrl').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                downloadAudio();
            }
        });