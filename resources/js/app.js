// Animaciones al hacer scroll
document.addEventListener("DOMContentLoaded", function () {
    const elements = document.querySelectorAll("section > *:not(:first-child)");

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("animate-fade-in");
                }
            });
        },
        { threshold: 0.1 }
    );

    elements.forEach((el) => {
        el.classList.add("opacity-0", "transform", "translate-y-4");
        observer.observe(el);
    });

    // Añadir clase para animación
    const style = document.createElement("style");
    style.textContent = `
        .animate-fade-in {
            animation: fadeInUp 0.6s ease forwards;
        }
        @keyframes fadeInUp {
            to { opacity: 1; transform: translateY(0); }
        }
    `;
    document.head.appendChild(style);
});
