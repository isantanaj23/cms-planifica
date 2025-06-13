/**
 * PLANIFICA+ - MAIN JAVASCRIPT FILE
 * Advanced interactions, animations, and functionality
 */

// ================================
// GLOBAL VARIABLES & CONFIG
// ================================

let progress = 0;
let mouseTrails = [];
const config = {
    particles: {
        number: { value: 80, density: { enable: true, value_area: 800 } },
        color: { value: ['#964ef9', '#472eff', '#3001ff'] },
        shape: { type: 'circle' },
        opacity: { value: 0.5, random: false },
        size: { value: 3, random: true },
        line_linked: {
            enable: true,
            distance: 150,
            color: '#964ef9',
            opacity: 0.4,
            width: 1
        },
        move: {
            enable: true,
            speed: 2,
            direction: 'none',
            random: false,
            straight: false,
            out_mode: 'out',
            bounce: false
        }
    },
    interactivity: {
        detect_on: 'canvas',
        events: {
            onhover: { enable: true, mode: 'repulse' },
            onclick: { enable: true, mode: 'push' },
            resize: true
        },
        modes: {
            grab: { distance: 400, line_linked: { opacity: 1 } },
            bubble: { distance: 400, size: 40, duration: 2, opacity: 8, speed: 3 },
            repulse: { distance: 200, duration: 0.4 },
            push: { particles_nb: 4 },
            remove: { particles_nb: 2 }
        }
    },
    retina_detect: true
};

// ================================
// PRELOADER FUNCTIONALITY
// ================================

function initPreloader() {
    const preloader = document.getElementById('preloader');
    const progressBar = document.getElementById('progressBar');
    const progressText = document.getElementById('progressText');

    function updateProgress() {
        progress += Math.random() * 15;
        if (progress > 100) progress = 100;
        
        progressBar.style.width = progress + '%';
        progressText.textContent = `Cargando... ${Math.floor(progress)}%`;
        
        if (progress < 100) {
            setTimeout(updateProgress, 100 + Math.random() * 200);
        } else {
            setTimeout(() => {
                preloader.classList.add('hidden');
                setTimeout(() => {
                    preloader.style.display = 'none';
                    initializeAnimations();
                }, 800);
            }, 500);
        }
    }

    updateProgress();
}

// ================================
// PARTICLES.JS INITIALIZATION
// ================================

function initParticles() {
    if (typeof particlesJS !== 'undefined') {
        particlesJS('particles-js', config);
    }
}

// ================================
// MOUSE TRAIL EFFECTS
// ================================

function initMouseTrail() {
    document.addEventListener('mousemove', (e) => {
        // Throttle mouse trail creation for performance
        if (Math.random() > 0.7) return;
        
        const trail = document.createElement('div');
        trail.classList.add('mouse-trail');
        trail.style.left = e.clientX - 10 + 'px';
        trail.style.top = e.clientY - 10 + 'px';
        document.body.appendChild(trail);
        
        mouseTrails.push(trail);
        
        setTimeout(() => {
            if (trail.parentNode) {
                trail.parentNode.removeChild(trail);
            }
            mouseTrails = mouseTrails.filter(t => t !== trail);
        }, 800);
        
        // Limit trails for performance
        if (mouseTrails.length > 10) {
            const oldTrail = mouseTrails.shift();
            if (oldTrail.parentNode) {
                oldTrail.parentNode.removeChild(oldTrail);
            }
        }
    });
}

// ================================
// COUNTER ANIMATIONS
// ================================

function initCounterAnimations() {
    const counters = document.querySelectorAll('.counter');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounter(entry.target);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });
    
    counters.forEach(counter => observer.observe(counter));
}

function animateCounter(counter) {
    const target = parseInt(counter.getAttribute('data-target'));
    const increment = target / 50;
    let current = 0;
    
    const updateCounter = () => {
        if (current < target) {
            current += increment;
            const displayValue = Math.ceil(current);
            const suffix = target === 98 ? '%' : target > 99 ? '+' : '+';
            counter.textContent = displayValue + suffix;
            requestAnimationFrame(updateCounter);
        } else {
            counter.textContent = target + (target === 98 ? '%' : '+');
        }
    };
    
    updateCounter();
}

// ================================
// PARALLAX EFFECTS
// ================================

function initParallax() {
    const parallaxElements = document.querySelectorAll('.parallax-bg');
    
    const handleScroll = debounce(() => {
        const scrolled = window.pageYOffset;
        
        parallaxElements.forEach((element, index) => {
            const speed = 0.5 + (index * 0.1);
            const yPos = -(scrolled * speed);
            element.style.transform = `translateY(${yPos}px)`;
        });

        // Hero parallax
        const hero = document.querySelector('.hero');
        const floatingShapes = document.querySelectorAll('.floating-shape');
        
        if (hero) {
            hero.style.transform = `translateY(${scrolled * 0.3}px)`;
        }
        
        // Animate floating shapes at different speeds
        floatingShapes.forEach((shape, index) => {
            const speed = 0.2 + (index * 0.1);
            shape.style.transform = `translateY(${scrolled * speed}px) rotate(${scrolled * 0.05}deg)`;
        });
    }, 10);

    window.addEventListener('scroll', handleScroll);
}

// ================================
// SCROLL INDICATOR
// ================================

function initScrollIndicator() {
    const indicator = document.getElementById('scrollIndicator');
    
    window.addEventListener('scroll', () => {
        const scrollTop = document.documentElement.scrollTop;
        const scrollHeight = document.documentElement.scrollHeight - window.innerHeight;
        const progress = (scrollTop / scrollHeight) * 100;
        indicator.style.transform = `scaleX(${progress / 100})`;
    });
}

// ================================
// NAVIGATION FUNCTIONALITY
// ================================

function initNavigation() {
    // Navbar scroll effect
    window.addEventListener('scroll', () => {
        const navbar = document.querySelector('.navbar');
        if (window.scrollY > 50) {
            navbar.style.background = 'rgba(255, 255, 255, 0.98)';
            navbar.style.boxShadow = '0 4px 30px rgba(0, 0, 0, 0.1)';
        } else {
            navbar.style.background = 'rgba(255, 255, 255, 0.95)';
            navbar.style.boxShadow = '0 2px 20px rgba(0, 0, 0, 0.1)';
        }
    });

    // Active navigation highlighting
    window.addEventListener('scroll', () => {
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('.nav-link');
        
        let current = '';
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            if (window.scrollY >= sectionTop - 200) {
                current = section.getAttribute('id');
            }
        });

        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href') === '#' + current) {
                link.classList.add('active');
            }
        });
    });

    // Smooth scrolling for navigation links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Mobile menu close on link click
    document.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('click', function() {
            const navbarCollapse = document.querySelector('.navbar-collapse');
            if (navbarCollapse.classList.contains('show')) {
                const bsCollapse = new bootstrap.Collapse(navbarCollapse);
                bsCollapse.hide();
            }
        });
    });
}

// ================================
// FORM VALIDATION & HANDLING
// ================================

function initFormValidation() {
    const form = document.getElementById('contactForm');
    const submitBtn = document.getElementById('submitBtn');
    
    if (!form) return;
    
    // Real-time validation
    const inputs = form.querySelectorAll('input, select, textarea');
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            validateField(this);
        });
        
        input.addEventListener('blur', function() {
            validateField(this);
        });

        input.addEventListener('focus', function() {
            this.style.borderColor = 'var(--primary-color)';
            this.style.boxShadow = '0 0 0 0.2rem rgba(150, 78, 249, 0.25)';
        });
    });
    
    // Form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        let isValid = true;
        inputs.forEach(input => {
            if (!validateField(input) && input.hasAttribute('required')) {
                isValid = false;
            }
        });
        
        if (isValid) {
            handleFormSubmission(submitBtn, form, inputs);
        }
    });
}

function validateField(field) {
    const value = field.value.trim();
    const isRequired = field.hasAttribute('required');
    let isValid = true;
    
    // Reset classes
    field.classList.remove('is-valid', 'is-invalid');
    
    if (isRequired && !value) {
        isValid = false;
    } else if (field.type === 'email' && value) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        isValid = emailRegex.test(value);
    } else if (field.type === 'tel' && value) {
        const phoneRegex = /^[\+]?[1-9][\d]{0,15}$/;
        isValid = phoneRegex.test(value.replace(/\s/g, ''));
    }
    
    if (value && isValid) {
        field.classList.add('is-valid');
    } else if (isRequired || (value && !isValid)) {
        field.classList.add('is-invalid');
        isValid = false;
    }
    
    return isValid;
}

function handleFormSubmission(submitBtn, form, inputs) {
    // Button loading state
    submitBtn.classList.add('btn-loading');
    submitBtn.querySelector('.btn-text').style.opacity = '0';
    
    // Simulate form submission
    setTimeout(() => {
        submitBtn.classList.remove('btn-loading');
        submitBtn.querySelector('.btn-text').style.opacity = '1';
        submitBtn.querySelector('.btn-text').textContent = '¡Enviado!';
        submitBtn.style.background = '#28a745';
        
        // Show success notification
        showNotification('¡Mensaje enviado exitosamente! Te contactaremos pronto.', 'success');
        
        setTimeout(() => {
            form.reset();
            inputs.forEach(input => {
                input.classList.remove('is-valid', 'is-invalid');
            });
            submitBtn.querySelector('.btn-text').textContent = 'Enviar Mensaje';
            submitBtn.style.background = '';
        }, 3000);
    }, 2000);
}

// ================================
// NOTIFICATION SYSTEM
// ================================

function showNotification(message, type) {
    const notification = document.createElement('div');
    notification.className = `alert alert-${type} alert-dismissible fade show`;
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 10001;
        min-width: 300px;
        animation: slideInRight 0.3s ease;
    `;
    notification.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        if (notification.parentNode) {
            notification.classList.remove('show');
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.parentNode.removeChild(notification);
                }
            }, 150);
        }
    }, 5000);
}

// ================================
// SCROLL REVEAL ANIMATIONS
// ================================

function initScrollReveal() {
    // Section visibility observer
    const sectionObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('section-visible');
                
                // Add specific animations for different sections
                if (entry.target.id === 'pricing') {
                    const featuredCard = entry.target.querySelector('.pricing-card.featured');
                    if (featuredCard) {
                        setTimeout(() => {
                            featuredCard.classList.add('pulse');
                        }, 1000);
                    }
                }
            }
        });
    }, { threshold: 0.2 });
    
    document.querySelectorAll('section').forEach(section => {
        sectionObserver.observe(section);
    });
}

// ================================
// ENHANCED ANIMATIONS
// ================================

function initEnhancedAnimations() {
    // Staggered animations for cards
    const animatedSections = document.querySelectorAll('.services, .benefits, .pricing, .blog');
    
    animatedSections.forEach(section => {
        const cards = section.querySelectorAll('.service-card, .benefit-card, .pricing-card, .blog-card');
        cards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
        });
    });

    // Hover effects for service cards
    document.querySelectorAll('.service-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            const icon = this.querySelector('.service-icon');
            if (icon) {
                icon.style.animation = 'pulse 1.5s infinite';
            }
        });

        card.addEventListener('mouseleave', function() {
            const icon = this.querySelector('.service-icon');
            if (icon) {
                icon.style.animation = '';
            }
        });
    });
}

// ================================
// PERFORMANCE OPTIMIZATIONS
// ================================

function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

function throttle(func, limit) {
    let inThrottle;
    return function() {
        const args = arguments;
        const context = this;
        if (!inThrottle) {
            func.apply(context, args);
            inThrottle = true;
            setTimeout(() => inThrottle = false, limit);
        }
    }
}

// ================================
// STRUCTURED DATA & SEO
// ================================

function addStructuredData() {
    const structuredData = {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "Planifica+",
        "url": "https://planificamas.com.mx",
        "logo": "https://planificamas.com.mx/logo.png",
        "description": "Planificación estratégica empresarial, consultoría y crecimiento empresarial",
        "address": {
            "@type": "PostalAddress",
            "addressCountry": "MX",
            "addressLocality": "Ciudad de México"
        },
        "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "+52-55-1234-5678",
            "contactType": "customer service",
            "email": "info@planificamas.com.mx"
        },
        "sameAs": [
            "https://facebook.com/planificamas",
            "https://linkedin.com/company/planificamas",
            "https://twitter.com/planificamas"
        ]
    };

    const script = document.createElement('script');
    script.type = 'application/ld+json';
    script.text = JSON.stringify(structuredData);
    document.head.appendChild(script);
}

function addMetaTags() {
    const metaTags = [
        { name: 'robots', content: 'index, follow' },
        { name: 'googlebot', content: 'index, follow' },
        { name: 'theme-color', content: '#964ef9' },
        { name: 'msapplication-TileColor', content: '#964ef9' },
        { property: 'og:site_name', content: 'Planifica+' },
        { property: 'og:locale', content: 'es_MX' },
        { property: 'twitter:card', content: 'summary_large_image' },
        { property: 'twitter:site', content: '@planificamas' }
    ];

    metaTags.forEach(tag => {
        const meta = document.createElement('meta');
        if (tag.name) meta.name = tag.name;
        if (tag.property) meta.setAttribute('property', tag.property);
        meta.content = tag.content;
        document.head.appendChild(meta);
    });
}

// ================================
// AOS INITIALIZATION
// ================================

function initAOS() {
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 1000,
            easing: 'ease-out-cubic',
            once: true,
            offset: 100,
            disable: function() {
                return window.innerWidth < 768;
            }
        });
    }
}

// ================================
// MAIN INITIALIZATION
// ================================

function initializeAnimations() {
    // Initialize all components
    initAOS();
    initParticles();
    initMouseTrail();
    initCounterAnimations();
    initParallax();
    initScrollIndicator();
    initNavigation();
    initFormValidation();
    initScrollReveal();
    initEnhancedAnimations();
    
    // SEO enhancements
    addStructuredData();
    addMetaTags();
    
    console.log('✅ Planifica+ - All animations and interactions initialized');
}

// ================================
// EVENT LISTENERS
// ================================

// Start the application
document.addEventListener('DOMContentLoaded', function() {
    initPreloader();
    
    // Initialize tooltips if Bootstrap is available
    if (typeof bootstrap !== 'undefined') {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }
    
    // Lazy loading for images
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                    img.classList.add('loaded');
                    observer.unobserve(img);
                }
            });
        });

        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    }
});