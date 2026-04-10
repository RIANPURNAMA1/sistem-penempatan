const THEME_KEY = "theme"

/**
 * Set theme ke light secara permanen
 * @param {"light"} theme
 */
function setTheme(theme = "light") {
  // Hapus class dark jika ada, tambahkan light
  document.body.classList.remove("dark")
  document.body.classList.add("light")
  
  // Set atribut bootstrap ke light
  document.documentElement.setAttribute('data-bs-theme', 'light')
  
  // Bersihkan localStorage agar tidak ada sisa 'dark'
  localStorage.removeItem(THEME_KEY)
}

/**
 * Inisialisasi tema (Selalu Light)
 */
function initTheme() {
  return setTheme("light")
}

// Jalankan saat halaman dimuat
window.addEventListener('DOMContentLoaded', () => {
  const toggler = document.getElementById("toggle-dark")
  
  // Jika ada tombol switch dark mode di UI, kita sembunyikan atau matikan fungsinya
  if(toggler) {
    toggler.checked = false
    toggler.disabled = true // Opsional: buat tombol tidak bisa diklik
    // Atau sembunyikan containernya
    // toggler.parentElement.style.display = 'none'
  }
  
  // Pastikan tema diset ke light
  setTheme("light")
});

// Panggil fungsi init
initTheme()