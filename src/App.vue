<template>
  <div id="app">
    <nav class="navbar navbar-expand-lg navbar-dark bg-orange fixed-top shadow-sm">
      <div class="container">

        <router-link class="navbar-brand fw-bold d-flex align-items-center" to="/">
          <i class="fas fa-graduation-cap text-warning me-2"></i>
          <span class="brand-text">Student Management</span>
        </router-link>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <router-link class="nav-link px-3" to="/">
                <i class="fas fa-home me-1"></i>Home
              </router-link>
            </li>

            <!-- Student Dropdown -->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle px-3" href="#" data-bs-toggle="dropdown">
                <i class="fas fa-users me-1"></i>Students
              </a>
              <ul class="dropdown-menu border-0 shadow-lg">
                <li>
                  <router-link class="dropdown-item py-2" to="/show_student">
                    <i class="fas fa-list me-2"></i>Show Students
                  </router-link>
                </li>
                <li>
                  <router-link class="dropdown-item py-2" to="/add_student">
                    <i class="fas fa-plus me-2"></i>Add Student
                  </router-link>
                </li>
              </ul>
            </li>

            <li class="nav-item">
              <router-link class="nav-link px-3" to="/about">
                <i class="fas fa-info-circle me-1"></i>About
              </router-link>
            </li>

            <li class="nav-item">
              <router-link class="nav-link px-3" to="/contact">
                <i class="fas fa-envelope me-1"></i>Contact
              </router-link>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <router-view/>
  </div>
</template>

<style>
/* Import Google Fonts */
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

body {
  font-family: 'Inter', sans-serif;
  padding-top: 76px;
  background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
  min-height: 100vh;
  margin: 0;
}

.navbar {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
  backdrop-filter: blur(20px);
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
  height: 76px;
  padding: 0;
}

.navbar-brand {
  font-size: 1.5rem;
  font-weight: 700;
  letter-spacing: 0.5px;
  transition: all 0.3s ease;
  color: white !important;
  text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

.navbar-brand:hover {
  transform: translateY(-2px);
  color: #ffd700 !important;
}

.brand-text {
  background: linear-gradient(45deg, #ffffff, #ffd700);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.navbar-nav {
  align-items: center;
}

.nav-link {
  font-weight: 500;
  font-size: 0.95rem;
  padding: 0.75rem 1.25rem !important;
  margin: 0 0.25rem;
  border-radius: 8px;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  color: rgba(255, 255, 255, 0.9) !important;
  position: relative;
  overflow: hidden;
}

.nav-link::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
  transition: left 0.5s ease;
}

.nav-link:hover::before {
  left: 100%;
}

.nav-link:hover {
  color: white !important;
  background: rgba(255, 255, 255, 0.1);
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.nav-link.router-link-exact-active {
  background: rgba(255, 255, 255, 0.15);
  color: white !important;
  border: 1px solid rgba(255, 255, 255, 0.3);
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.dropdown-menu {
  border: none;
  border-radius: 12px;
  box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
  backdrop-filter: blur(20px);
  background: rgba(255, 255, 255, 0.95);
  margin-top: 8px;
  padding: 0.5rem 0;
  animation: slideDown 0.3s ease-out;
}

.dropdown-item {
  padding: 0.75rem 1.5rem;
  font-weight: 500;
  transition: all 0.3s ease;
  border-radius: 6px;
  margin: 0.125rem 0.5rem;
  color: #495057;
}

.dropdown-item:hover {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  color: white;
  transform: translateX(4px);
  box-shadow: 0 2px 8px rgba(102, 126, 234, 0.3);
}

.dropdown-item i {
  width: 16px;
  text-align: center;
}

.navbar-toggler {
  border: none;
  background: rgba(255, 255, 255, 0.1);
  backdrop-filter: blur(10px);
  border-radius: 8px;
  padding: 0.5rem;
  transition: all 0.3s ease;
  margin-right: 1rem;
}

.navbar-toggler:focus {
  box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.25);
}

.navbar-toggler:hover {
  background: rgba(255, 255, 255, 0.2);
  transform: scale(1.05);
}

.navbar-toggler-icon {
  background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.9%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='m4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
}

/* Animations */
@keyframes slideDown {
  from {
    opacity: 0;
    transform: translateY(-10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes fadeIn {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}

/* Responsive Design */
@media (max-width: 991.98px) {
  .navbar-collapse {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border-radius: 12px;
    margin-top: 1rem;
    padding: 1rem;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
  }

  .navbar-nav {
    margin: 0;
  }

  .nav-link {
    margin: 0.25rem 0;
    padding: 0.75rem 1rem !important;
    text-align: center;
    border-radius: 8px;
  }

  .nav-link:hover {
    transform: none;
    background: rgba(102, 126, 234, 0.1);
  }

  .dropdown-menu {
    background: rgba(255, 255, 255, 0.95);
    border: 1px solid rgba(0, 0, 0, 0.1);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
  }

  .brand-text {
    font-size: 1.25rem;
  }
}

@media (max-width: 576px) {
  .navbar-brand {
    font-size: 1.25rem;
  }

  .brand-text {
    display: none;
  }

  .navbar-toggler {
    margin-right: 0.5rem;
  }
}

/* Custom scrollbar for dropdown */
.dropdown-menu::-webkit-scrollbar {
  width: 6px;
}

.dropdown-menu::-webkit-scrollbar-track {
  background: transparent;
}

.dropdown-menu::-webkit-scrollbar-thumb {
  background: rgba(102, 126, 234, 0.3);
  border-radius: 3px;
}

.dropdown-menu::-webkit-scrollbar-thumb:hover {
  background: rgba(102, 126, 234, 0.5);
}

/* Icon animations */
.fas {
  transition: all 0.3s ease;
}

.nav-link:hover .fas,
.dropdown-item:hover .fas {
  transform: scale(1.1);
}

/* Loading state */
.navbar[aria-expanded="true"] {
  box-shadow: 0 6px 25px rgba(0, 0, 0, 0.15);
}

/* Focus states */
.nav-link:focus,
.dropdown-item:focus {
  outline: none;
  box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}
</style>