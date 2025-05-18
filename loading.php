<!-- loading.php -->
<style>
  #loader-overlay {
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    backdrop-filter: blur(5px);
    background: rgba(255,255,255,0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
  }

  .loader {
    border: 8px solid #f3f3f3;
    border-top: 8px solid #3498db;
    border-radius: 50%;
    width: 60px;
    height: 60px;
    animation: spin 1s linear infinite;
  }

  @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }

  .blurred {
    filter: blur(5px);
    transition: filter 0.3s ease;
  }
</style>

<div id="loader-overlay">
  <div class="loader"></div>
</div>

<script>
  window.addEventListener('load', () => {
    setTimeout(() => {
      document.getElementById('loader-overlay').style.display = 'none';
      document.getElementById('main-content')?.classList.remove('blurred');
    }, 1500); // Adjust delay if needed
  });
</script>
