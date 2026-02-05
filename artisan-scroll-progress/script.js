document.addEventListener('DOMContentLoaded', () => {
    const button = document.getElementById('artisan-scroll-top');
    const circle = document.querySelector('.progress-ring__circle');
    if (!button || !circle) return;

    const radius = circle.r.baseVal.value;
    const circumference = radius * 2 * Math.PI;

    circle.style.strokeDasharray = `${circumference} ${circumference}`;
    circle.style.stroke = artisanVars.color;

    const updateScroll = () => {
        const scrolled = window.scrollY;
        const totalHeight = document.documentElement.scrollHeight - window.innerHeight;
        
        // Smart Visibility Logic (400px threshold) [cite: 9]
        if (scrolled > 400) {
            button.classList.remove('artisan-hidden');
        } else {
            button.classList.add('artisan-hidden');
        }

        // Circular filling logic (0% to 100%) [cite: 8, 26]
        const progress = scrolled / totalHeight;
        circle.style.strokeDashoffset = circumference - (progress * circumference);
    };

    window.addEventListener('scroll', updateScroll, { passive: true });
    
    // Smooth scroll back to top [cite: 24]
    button.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
});