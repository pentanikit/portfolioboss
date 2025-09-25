// Portfolio Website JavaScript

// State Management
let isMenuOpen = false;
let currentTheme = localStorage.getItem('theme') || 'light';
let selectedBudget = '';
let selectedTimeline = '';

// Project Data
const projectsData = {
  1: {
    title: 'FinanceFlow - Mobile Banking App',
    category: 'Mobile App',
    status: 'Live',
    metrics: '$2M+ ARR, 100k+ users',
    image: 'attached_assets/generated_images/Mobile_app_project_mockup_8a9c8f89.png',
    description: 'Revolutionary mobile banking application with AI-powered financial insights and seamless user experience.',
    longDescription: 'FinanceFlow revolutionizes personal banking with AI-driven insights, real-time expense tracking, and automated savings recommendations. The app features a beautiful, intuitive interface that makes complex financial data accessible to everyday users.',
    technologies: ['React Native', 'Node.js', 'MongoDB', 'AI/ML'],
    achievements: [
      'Featured in App Store',
      'Winner of FinTech Innovation Award 2023',
      'Achieved 4.8/5 star rating'
    ]
  },
  2: {
    title: 'EcoMarket - Sustainable E-commerce',
    category: 'E-commerce',
    status: 'Live',
    metrics: '$5M+ GMV, 50k+ customers',
    image: 'attached_assets/generated_images/E-commerce_website_project_085ede49.png',
    description: 'Marketplace connecting conscious consumers with sustainable brands and eco-friendly products.',
    longDescription: 'EcoMarket creates a curated marketplace for sustainable products, featuring carbon footprint tracking, impact metrics, and community-driven reviews. The platform helps conscious consumers make informed purchasing decisions.',
    technologies: ['Next.js', 'Shopify', 'Stripe', 'GraphQL'],
    achievements: [
      'B-Corp Certified',
      '500% growth in first year',
      'Partnership with 200+ eco brands'
    ]
  },
  3: {
    title: 'DataPro - Analytics Dashboard',
    category: 'SaaS Platform',
    status: 'Live',
    metrics: '$10M+ ARR, 500+ enterprises',
    image: 'attached_assets/generated_images/SaaS_dashboard_project_c03fc97c.png',
    description: 'Enterprise-grade analytics platform providing real-time business intelligence and automated reporting.',
    longDescription: 'DataPro transforms complex business data into actionable insights through advanced analytics, machine learning predictions, and customizable dashboards. Trusted by Fortune 500 companies for mission-critical decisions.',
    technologies: ['React', 'Python', 'PostgreSQL', 'Docker'],
    achievements: [
      'Enterprise security certified',
      '99.9% uptime SLA',
      'Fortune 500 adoption'
    ]
  },
  4: {
    title: 'BrandCraft - Identity Design Suite',
    category: 'Design Platform',
    status: 'Beta',
    metrics: '10k+ brands created',
    image: 'attached_assets/generated_images/Brand_identity_project_74bdbc3d.png',
    description: 'Complete brand identity design and management platform for modern businesses.',
    longDescription: 'BrandCraft empowers businesses to create professional brand identities through AI-assisted design tools, brand guidelines generation, and collaborative design workflows. Perfect for startups and growing companies.',
    technologies: ['Vue.js', 'Canvas API', 'AWS', 'Redis'],
    achievements: [
      'Design community of 50k+',
      'AI design patents filed',
      'Used by Y Combinator startups'
    ]
  }
};

// Initialize
document.addEventListener('DOMContentLoaded', function() {
  initializeTheme();
  initializeNavigation();
  initializeForm();
  initializeAnimations();
  initializeBudgetAndTimeline();
});

// Theme Management
function initializeTheme() {
  const themeToggle = document.getElementById('theme-toggle');
  const themeIcon = document.getElementById('theme-icon');
  
  // Set initial theme
  document.documentElement.setAttribute('data-theme', currentTheme);
  updateThemeIcon();
  
  themeToggle.addEventListener('click', toggleTheme);
}

function toggleTheme() {
  currentTheme = currentTheme === 'light' ? 'dark' : 'light';
  document.documentElement.setAttribute('data-theme', currentTheme);
  localStorage.setItem('theme', currentTheme);
  updateThemeIcon();
  console.log('Theme toggled to:', currentTheme);
}

function updateThemeIcon() {
  const themeIcon = document.getElementById('theme-icon');
  themeIcon.className = currentTheme === 'light' ? 'fas fa-moon' : 'fas fa-sun';
}

// Navigation
function initializeNavigation() {
  const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
  const navMenu = document.getElementById('nav-menu');
  const menuIcon = document.getElementById('menu-icon');
  const navLinks = document.querySelectorAll('.nav-link');
  
  mobileMenuToggle.addEventListener('click', toggleMobileMenu);
  
  // Close mobile menu when clicking nav links
  navLinks.forEach(link => {
    link.addEventListener('click', (e) => {
      e.preventDefault();
      const href = link.getAttribute('href');
      scrollToSection(href.substring(1));
      closeMobileMenu();
    });
  });
  
  // Close mobile menu when clicking outside
  document.addEventListener('click', (e) => {
    if (!navMenu.contains(e.target) && !mobileMenuToggle.contains(e.target)) {
      closeMobileMenu();
    }
  });
}

function toggleMobileMenu() {
  isMenuOpen = !isMenuOpen;
  const navMenu = document.getElementById('nav-menu');
  const menuIcon = document.getElementById('menu-icon');
  
  navMenu.classList.toggle('active', isMenuOpen);
  menuIcon.className = isMenuOpen ? 'fas fa-times' : 'fas fa-bars';
  
  console.log('Mobile menu toggled:', isMenuOpen);
}

function closeMobileMenu() {
  isMenuOpen = false;
  const navMenu = document.getElementById('nav-menu');
  const menuIcon = document.getElementById('menu-icon');
  
  navMenu.classList.remove('active');
  menuIcon.className = 'fas fa-bars';
}

// Smooth Scrolling
function scrollToSection(sectionId) {
  const element = document.getElementById(sectionId);
  if (element) {
    const offsetTop = element.offsetTop - 70; // Account for fixed navbar
    window.scrollTo({
      top: offsetTop,
      behavior: 'smooth'
    });
    console.log('Scrolled to section:', sectionId);
  }
}

function scrollToTop() {
  window.scrollTo({
    top: 0,
    behavior: 'smooth'
  });
  console.log('Scrolled to top');
}

// Animations
function initializeAnimations() {
  const animatedElements = document.querySelectorAll('.animate-fade-in-up');
  
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.style.animationPlayState = 'running';
      }
    });
  });
  
  animatedElements.forEach(el => {
    el.style.animationPlayState = 'paused';
    observer.observe(el);
  });
}

// Budget and Timeline Selection
function initializeBudgetAndTimeline() {
  const budgetOptions = document.querySelectorAll('.budget-option');
  const timelineOptions = document.querySelectorAll('.timeline-option');
  
  budgetOptions.forEach(option => {
    option.addEventListener('click', () => selectBudget(option));
  });
  
  timelineOptions.forEach(option => {
    option.addEventListener('click', () => selectTimeline(option));
  });
}

function selectBudget(option) {
  // Remove selected class from all budget options
  document.querySelectorAll('.budget-option').forEach(opt => {
    opt.classList.remove('selected');
  });
  
  // Add selected class to clicked option
  option.classList.add('selected');
  selectedBudget = option.getAttribute('data-budget');
  console.log('Budget selected:', selectedBudget);
}

function selectTimeline(option) {
  // Remove selected class from all timeline options
  document.querySelectorAll('.timeline-option').forEach(opt => {
    opt.classList.remove('selected');
  });
  
  // Add selected class to clicked option
  option.classList.add('selected');
  selectedTimeline = option.getAttribute('data-timeline');
  console.log('Timeline selected:', selectedTimeline);
}

// Contact Form
function initializeForm() {
  const form = document.getElementById('contact-form');
  form.addEventListener('submit', handleFormSubmit);
}

async function handleFormSubmit(e) {
  e.preventDefault();
  
  const submitBtn = document.querySelector('.form-submit');
  const submitText = document.querySelector('.submit-text');
  const submitLoading = document.querySelector('.submit-loading');
  
  // Show loading state
  submitText.style.display = 'none';
  submitLoading.style.display = 'flex';
  submitBtn.disabled = true;
  
  // Get form data
  const formData = new FormData(e.target);
  const data = {
    name: formData.get('name'),
    email: formData.get('email'),
    company: formData.get('company'),
    subject: formData.get('subject'),
    message: formData.get('message'),
    budget: selectedBudget,
    timeline: selectedTimeline
  };
  
  console.log('Form submission:', data);
  
  try {
    // Simulate API call
    await new Promise(resolve => setTimeout(resolve, 2000));
    
    // Show success message
    showToast('Message sent successfully! I\'ll get back to you within 24 hours.');
    
    // Reset form
    e.target.reset();
    selectedBudget = '';
    selectedTimeline = '';
    document.querySelectorAll('.budget-option, .timeline-option').forEach(opt => {
      opt.classList.remove('selected');
    });
    
  } catch (error) {
    console.error('Form submission error:', error);
    showToast('Error sending message. Please try again.', 'error');
  } finally {
    // Hide loading state
    submitText.style.display = 'block';
    submitLoading.style.display = 'none';
    submitBtn.disabled = false;
  }
}

// Toast Notifications
function showToast(message, type = 'success') {
  const toast = document.getElementById('toast');
  const toastMessage = document.getElementById('toast-message');
  
  toastMessage.textContent = message;
  toast.classList.add('show');
  
  setTimeout(() => {
    toast.classList.remove('show');
  }, 4000);
  
  console.log('Toast shown:', message);
}

// Project Modal
function openProjectModal(projectId) {
  const modal = document.getElementById('project-modal');
  const project = projectsData[projectId];
  
  if (!project) return;
  
  // Populate modal content
  document.getElementById('modal-title').textContent = project.title;
  document.getElementById('modal-image').src = project.image;
  document.getElementById('modal-image').alt = project.title;
  document.getElementById('modal-long-description').textContent = project.longDescription;
  document.getElementById('modal-category').textContent = project.category;
  document.getElementById('modal-status').textContent = project.status;
  document.getElementById('modal-metrics').textContent = project.metrics;
  
  // Populate technologies
  const techList = document.getElementById('modal-tech-list');
  techList.innerHTML = '';
  project.technologies.forEach(tech => {
    const techTag = document.createElement('span');
    techTag.className = 'tech-tag';
    techTag.textContent = tech;
    techList.appendChild(techTag);
  });
  
  // Populate achievements
  const achievementsList = document.getElementById('modal-achievements');
  achievementsList.innerHTML = '';
  project.achievements.forEach(achievement => {
    const li = document.createElement('li');
    li.textContent = achievement;
    achievementsList.appendChild(li);
  });
  
  // Show modal
  modal.classList.add('active');
  document.body.style.overflow = 'hidden';
  
  console.log('Opened project modal for:', project.title);
}

function closeProjectModal() {
  const modal = document.getElementById('project-modal');
  modal.classList.remove('active');
  document.body.style.overflow = 'auto';
  
  console.log('Closed project modal');
}

// Modal click outside to close
document.getElementById('project-modal').addEventListener('click', (e) => {
  if (e.target.id === 'project-modal') {
    closeProjectModal();
  }
});

// Action Handlers
function downloadResume() {
  console.log('Resume download initiated');
  alert('Resume download would start here. In a real implementation, this would download the actual resume file.');
}

function scheduleCall() {
  console.log('Schedule call clicked');
  alert('Would redirect to scheduling platform (like Calendly) in a real implementation.');
}

function viewLive() {
  console.log('View live project clicked');
  alert('Would open live project in new tab in a real implementation.');
}

function viewCode() {
  console.log('View code clicked');
  alert('Would open GitHub repository in new tab in a real implementation.');
}

function handleSocialClick(platform) {
  console.log(`${platform} social link clicked`);
  alert(`Would open ${platform} profile in a real implementation.`);
}

function showPrivacyPolicy() {
  console.log('Privacy policy clicked');
  alert('Would open privacy policy page in a real implementation.');
}

function showTerms() {
  console.log('Terms of service clicked');
  alert('Would open terms of service page in a real implementation.');
}

// // Scroll Effects
// window.addEventListener('scroll', () => {
//   const navbar = document.getElementById('navbar');
  
//   if (window.scrollY > 100) {
//     navbar.style.backgroundColor = 'hsla(240, 20%, 98%, 0.9)';
//     if (currentTheme === 'dark') {
//       navbar.style.backgroundColor = 'hsla(240, 15%, 12%, 0.9)';
//     }
//   } else {
//     navbar.style.backgroundColor = 'hsla(240, 20%, 98%, 0.8)';
//     if (currentTheme === 'dark') {
//       navbar.style.backgroundColor = 'hsla(240, 15%, 12%, 0.8)';
//     }
//   }
// });

// Keyboard Navigation
document.addEventListener('keydown', (e) => {
  // Close modal with Escape key
  if (e.key === 'Escape') {
    const modal = document.getElementById('project-modal');
    if (modal.classList.contains('active')) {
      closeProjectModal();
    }
  }
});

// Performance Optimization
if ('IntersectionObserver' in window) {
  // Lazy load images
  const imageObserver = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const img = entry.target;
        img.src = img.dataset.src;
        img.classList.remove('lazy');
        observer.unobserve(img);
      }
    });
  });
  
  document.querySelectorAll('img[data-src]').forEach(img => {
    imageObserver.observe(img);
  });
}

// Error Handling
window.addEventListener('error', (e) => {
  console.error('JavaScript error:', e.error);
});

// Accessibility Improvements
document.addEventListener('keydown', (e) => {
  if (e.key === 'Tab') {
    document.body.classList.add('using-keyboard');
  }
});

document.addEventListener('mousedown', () => {
  document.body.classList.remove('using-keyboard');
});

// Analytics (Mock)
function trackEvent(eventName, properties = {}) {
  console.log('Analytics event:', eventName, properties);
  // In a real implementation, this would send data to analytics service
}

// Track important interactions
document.addEventListener('click', (e) => {
  if (e.target.matches('button, a, .project-card')) {
    trackEvent('click', {
      element: e.target.tagName,
      text: e.target.textContent.trim().substring(0, 50),
      href: e.target.href || ''
    });
  }
});

console.log('Portfolio website JavaScript loaded successfully');


