  <div class="d-flex flex-column flex-shrink-0 bg-body-light bg-light w-100 pt-3">
      <ul class="nav nav-pills flex-column mb-auto">
          <li class="nav-item mb-2">
              <a href="/dashboard"
                  class="nav-link {{ request()->is('dashboard*') ? 'bg-primary text-white' : 'bg-white text-dark' }}"
                  aria-current="page">
                  <i class="bi bi-activity"></i>
                  Dashboard
              </a>
          </li>
          <li class="nav-item mb-2">
              <a href="/communities"
                  class="nav-link {{ request()->is('communities*') ? 'bg-primary text-white' : 'bg-white text-dark' }}"
                  aria-current="page">
                  <i class="bi bi-chat-left-dots"></i>
                  Komunitas
              </a>
          </li>
          <li class="nav-item mb-2">
              <a href="/food-plannings"
                  class="nav-link {{ request()->is('food-plannings*') ? 'bg-primary text-white' : 'bg-white text-dark' }}"
                  aria-current="page">
                  <i class="bi bi-calendar-check"></i>
                  Rencana Makanan
              </a>
          </li>
          <li class="nav-item mb-2">
              <a href="/taboo-foods"
                  class="nav-link {{ request()->is('taboo-foods*') ? 'bg-primary text-white' : 'bg-white text-dark' }}"
                  aria-current="page">
                  <i class="bi bi-exclamation-triangle"></i>
                  Pantangan Makanan
              </a>
          </li>
          <li class="nav-item mb-2">
              <a href="/suplemens"
                  class="nav-link {{ request()->is('suplemens*') ? 'bg-primary text-white' : 'bg-white text-dark' }}"
                  aria-current="page">
                  <i class="bi bi-capsule-pill"></i>
                  Manajemen Suplemen
              </a>
          </li>
          <li class="nav-item mb-2">
              <a href="/activities"
                  class="nav-link link-body-emphasis {{ request()->is('activities*') ? 'bg-primary text-white' : 'bg-white text-dark' }}">
                  <i class="bi bi-fire"></i>
                  Aktivitas Fisik
              </a>
          </li>
          <li class="nav-item mb-2">
              <a href="/simulations"
                  class="nav-link link-body-emphasis {{ request()->is('simulations*') ? 'bg-primary text-white' : 'bg-white text-dark' }}">
                  <i class="bi bi-calculator-fill"></i>
                  Simulasi Defisit
              </a>
          </li>
          <li class="nav-item mb-2">
              <a href="/calculations"
                  class="nav-link link-body-emphasis {{ request()->is('calculations*') ? 'bg-primary text-white' : 'bg-white text-dark' }}">
                  <i class="bi bi-calculator-fill"></i>
                  Perhitungan Kalori
              </a>
          </li>
          <li class="nav-item mb-2">
              <a href="/intake-histories"
                  class="nav-link link-body-emphasis {{ request()->is('intake-histories*') ? 'bg-primary text-white' : 'bg-white text-dark' }}">
                  <i class="bi bi-archive-fill"></i>
                  Riwayat Asupan
              </a>
          </li>
          <li class="nav-item mb-2">
              <a href="/recipes"
                  class="nav-link link-body-emphasis {{ request()->is('recipes*') ? 'bg-primary text-white' : 'bg-white text-dark' }}">
                  <i class="bi bi-backpack-fill"></i>
                  Resep Makanan
              </a>
          </li>
          <li class="nav-item mb-2">
              <a href="/user-profiles"
                  class="nav-link link-body-emphasis {{ request()->is('user-profiles*') ? 'bg-primary text-white' : 'bg-white text-dark' }}">
                  <i class="bi bi-person"></i>
                  Pengaturan
              </a>
          </li>
      </ul>
  </div>
