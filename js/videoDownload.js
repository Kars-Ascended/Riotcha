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